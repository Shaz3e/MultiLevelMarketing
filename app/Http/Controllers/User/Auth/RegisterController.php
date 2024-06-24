<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Models\User;
use App\Services\ReferralService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function view(Request $request)
    {
        Cookie::queue('ref', $request->ref, 90);
        // Try to get the referral code from the URL
        $referralCode = $request->query('ref');

        // If not present in the URL, try to get it from the cookie
        if (!$referralCode) {
            $referralCode = Cookie::get('ref');
        }

        return view('user.auth.register', [
            'referralCode' => $referralCode,
        ]);
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

        // Remove Cookie
        Cookie::queue(Cookie::forget('ref'));

        session()->flash('success', 'Your account created successfully. Please check your email and confirm your account.');

        return redirect()->route('register');
    }
}
