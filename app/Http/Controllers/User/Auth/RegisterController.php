<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Models\ReferralTree;
use App\Models\User;
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

        // Create User and Save to DB
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->remember_token = bin2hex(random_bytes(32));
        $user->password = Hash::make($validated['password']);
        $user->save();

         // Create Referral
         $referralData = new ReferralTree();
         $referralData->parent_id = $validated['referral_code'];         
         $referralData->user_id = $user->id;
         $referralData->save();
         startLevel();

        // Login
        // auth()->login($user); // development

        session()->flash('success', 'Your account created successfully. Please check your email and confirm your account.');

        return redirect()->route('register');
    }
}
