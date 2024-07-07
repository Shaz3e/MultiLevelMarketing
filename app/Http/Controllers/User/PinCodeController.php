<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PinCode\StorePinCodeRequest;
use App\Models\PinCode;
use Illuminate\Http\Request;

class PinCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.pin-code.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pinCode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 9);

        // check if the pin already exists in the database
        if (PinCode::where('pin_code', $pinCode)->exists()) {
            return $pinCode; // if the pin exists, generate a new one
        }

        // Retrieve values from app_settings table
        $defaultAmount = DiligentCreators('default_price');
        $percentage = DiligentCreators('sst');
        $amount = $defaultAmount * $percentage / 100 + $defaultAmount;

        return view('user.pin-code.create', [
            'pinCode' => $pinCode,
            'amount' => $amount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePinCodeRequest $request)
    {
        // Validated request
        $validated = $request->validated();

        // Create record in database
        $pinCode = PinCode::create($validated);

        session()->flash('success', 'Pin Code has been created successfully!');

        return redirect()->route('pins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PinCode $pin)
    {
        return view('user.pin-code.show', [
            'pin' => $pin,
        ]);
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
