<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Models\PinCode;
use App\Models\User;
use App\Services\ReferralService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function view(Request $request)
    {
        // Access the qr query parameter
        $qr = $request->query('qr');

        // Create the response instance with the view
        $response = response()->view('user.auth.register', [
            'qr' => $qr
        ]);

        // Define the domain to clear cookies for
        $domain = '.autotag.pk';

        // Clear cookies matching the domain
        foreach ($request->cookies as $cookieName => $cookieValue) {
            // Set the cookie to expire in the past
            $response->withCookie(cookie($cookieName, '', -2628000, '/', $domain));
        }

        return $response;
    }

    public function post(RegisterRequest $request)
    {

        // Validate Request
        $validated = $request->validated();

        // Get the qr_code from the request
        $qr_code = $request->input('qr');

        $referrer = User::where('referral_code', $validated['referral_code'])->first();
        $pin_code = PinCode::where([
            'pin_code' => $validated['pin_code'],
            'is_used' => 0
        ])->first();

        if (!$pin_code) {
            session()->flash('error', 'Invalid Pin Code');
            return redirect()->back();
        }

        // Create User and Save to DB
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->remember_token = bin2hex(random_bytes(32));
        $user->password = Hash::make($validated['password']);
        $user->referrer_id = $referrer ? $referrer->id : null;
        $user->qr_code = $qr_code; // Assuming you have a column named qr_code in your users table
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
