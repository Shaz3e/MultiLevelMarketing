<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Models\ReferralTree;
use App\Models\User;
use App\Services\ReferralService;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function view()
    {
        // $data = ReferralTree::all();
        // return $data;
        return view('user.auth.register');
    }

    public function post(RegisterRequest $request)
    {
        // Validate Request
        $validated = $request->validated();

        $referrer = User::where('referral_code', $validated['referral_code'])->first();

        // Create User and Save to DB
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->remember_token = bin2hex(random_bytes(32));
        $user->password = Hash::make($validated['password']);
        $user->referrer_id = $referrer ? $referrer->id : null;
        $user->save();

        if ($referrer) {
            $referralService = app(ReferralService::class);
            $referralService->allocateRewards($user);
        }

        // Login
        // auth()->login($user); // development

        session()->flash('success', 'Your account created successfully. Please check your email and confirm your account.');

        return redirect()->route('register');
    }
}
