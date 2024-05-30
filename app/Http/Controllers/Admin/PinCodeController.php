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


        $pin = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 9);

        // check if the pin already exists in the database
        if (PinCode::where('pin', $pin)->exists()) {
            return $pin; // if the pin exists, generate a new one
        }

        return view('admin.pin-code.create', [
            'pin' => $pin
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePinCodeRequest $request)
    {
        Log::info("Store method called");
        // Check Authorize
        Gate::authorize('create', PinCode::class);
        
        // Validated request
        $validated = $request->validated();

        // Create record in database
        $pin = PinCode::create($validated);

        session()->flash('success', 'Pin Code has been created successfully!');

        return $this->saveAndRedirect($request, 'pins', $pin->id);
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
        // $pin = rand(100000000, 999999999); // generate a random 9-digit number
        // Generate a random 9-character string including number and alphabet
        $pin = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 9);

        // check if the pin already exists in the database
        if (PinCode::where('pin', $pin)->exists()) {
            return $this->generatePin(); // if the pin exists, generate a new one
        }
        return response()->json(['pin' => $pin]);
    }
}
