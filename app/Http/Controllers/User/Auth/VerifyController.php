<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Mail\User\Auth\RegistrationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::where([
            'email' => $request->email,
            'remember_token' => $request->token
        ])->first();

        if ($user) {
            $user->update([
                'email_verified_at' => now(),
                'is_email_verified' => 1,
                'is_active' => 1,
            ]);
            return redirect()->route('login')->with('success', 'Your account has been activated. Please login now');
        }

        return redirect()->route('register')->with('error', 'Account information is invalid. Please contact support with the email which you used to register.');
    }
}
