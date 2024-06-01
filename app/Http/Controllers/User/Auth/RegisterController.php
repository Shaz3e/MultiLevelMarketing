<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
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
        $user->remember_token = bin2hex(random_bytes(32));
        $user->password = Hash::make($validated['password']);
        $user->save();

        session()->flash('success', 'Your account created successfully. Please check your email and confirm your account.');

        return redirect()->route('login');
    }
}
