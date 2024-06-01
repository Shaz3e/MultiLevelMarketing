<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Models\PinCode;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function view()
    {
        return view('user.auth.register');
    }

    public function post(RegisterRequest $request)
    {
        // Validate Request
        $validated = $request->validated();

        // Create User and Save to DB
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->pin_code = $validated['pin_code'];
        $user->save();

        /**
         * Update pin_codes Tables
         * @param is_used
         * @param used_by
         * @param used_at
         */
        PinCode::where('pin_code', $validated['pin_code'])->update([
            'is_used' => 1,
            'used_by' => $user->id,
            'used_at' => now(),
        ]);

        // Get Pin Code Data
        $pinCode = PinCode::where('pin_code', $validated['pin_code'])->first();

        $referral = new Referral();
        if (!is_null($pinCode->user_id)) {
            $referral->referrer_id = $pinCode->user_id;
        }
        if (!is_null($pinCode->admin_id)) {
            $referral->referrer_id = $pinCode->admin_id;
        }
        $referral->pin_code = $validated['pin_code'];
        $referral->used_by_id = $user->id;
        $referral->save();

        session()->flash('success', 'Your account created successfully!');

        return redirect()->route('login');
    }
}
