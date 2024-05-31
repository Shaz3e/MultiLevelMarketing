<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PinCode\StorePinCodeRequest;
use App\Models\PinCode;
use App\Trait\Admin\FormHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class PinCodeController extends Controller
{
    use FormHelper;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check Authorize
        Gate::authorize('viewAny', PinCode::class);

        return view('admin.pin-code.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check Authorize
        Gate::authorize('create', PinCode::class);


        $pinCode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 9);

        // check if the pin already exists in the database
        if (PinCode::where('pin_code', $pinCode)->exists()) {
            return $pinCode; // if the pin exists, generate a new one
        }

        return view('admin.pin-code.create', [
            'pinCode' => $pinCode
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePinCodeRequest $request)
    {
        // Check Authorize
        Gate::authorize('create', PinCode::class);

        // Validated request
        $validated = $request->validated();

        // Create record in database
        $pinCode = PinCode::create($validated);

        session()->flash('success', 'Pin Code has been created successfully!');

        return $this->saveAndRedirect($request, 'pins', $pinCode->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(PinCode $pin)
    {
        // Check Authorize
        Gate::authorize('read', $pin);

        return view('admin.pin-code.show', [
            'pin' => $pin,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PinCode $pin)
    {
        // Check Authorize
        Gate::authorize('update', $pin);

        return view('admin.pin-code.edit', [
            'pin' => $pin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePinCodeRequest $request, PinCode $pin)
    {
        // Check Authorize
        Gate::authorize('update', $pin);

        // Validate data
        $validated = $request->validated();

        // Update record in database
        $pin->update($validated);

        // Flash message
        session()->flash('success', 'Pin Code has been updated successfully!');

        return $this->saveAndRedirect($request, 'pins', $pin->id);
    }

    /**
     * Generate Pin Code
     */
    public function generatePin()
    {
        $attempts = 0;
        do {
            $pinCode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 9);
            $attempts++;
        } while (PinCode::where('pin_code', $pinCode)->exists() && $attempts < 10); // try up to 10 times

        if ($attempts >= 10) {
            // return an error message or take alternative action
            return response()->json(['error' => 'Unable to generate a unique pin code']);
        }

        return response()->json(['pin_code' => $pinCode, 'attempts' => $attempts]);
    }

    /**
     * Check Pin Code
     */
    public function checkPin(Request $request)
    {
        $pinCode = $request->pin_code;
        $pin = PinCode::where('pin_code', $pinCode)->first();
        if ($pin) {
            if ($pin->is_used) {
                return response()->json(['success' => false, 'message' => 'Pin code is already used']);
            } else {
                return response()->json(['success' => true, 'message' => 'Pin code is valid and unused']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Pin code is invalid']);
        }
    }
}
