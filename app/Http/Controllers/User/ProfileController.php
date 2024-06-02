<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        return view('user.profile.profile', [
            'user' => $user,
        ]);
    }
    public function kyc()
    {
        $user = Auth::user();

        return view('user.profile.kyc', [
            'user' => $user,
        ]);
    }

    /**
     * Update profile
     *
     * @param  mixed $request
     * @return void
     */
    public function profileStore(Request $request)
    {
        if ($request->has('updatePassword')) {
            return $this->updatePassword($request);
        }

        if ($request->has('changeAvatar')) {
            return $this->changeAvatar($request);
        }

        if ($request->has('updateProfile')) {
            return $this->updateProfile($request);
        }

        if ($request->has('updateKyc')) {
            return $this->updateKyc($request);
        }
    }

    private function updateProfile(Request $request)
    {
        // validated data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . Auth::user()->id,
        ]);

        // Get current user
        $user = Auth::user();
        $user->update($validated);

        session()->flash('success', 'Profile updated successfully!');

        return back();
    }

    /**
     * Change password
     *
     * @param  mixed $request
     * @return void
     */
    private function updatePassword(Request $request)
    {
        // validate data and check if token session exists
        if (session()->has('token')) {
            $validated = $this->validatePassword($request, false);
        } else {
            $validated = $this->validatePassword($request);
        }

        // Get current user
        $user = Auth::user();

        // If token session exists
        if (!session()->has('token')) {
            // If current password is incorrect
            if (!password_verify($validated['current_password'], $user->password)) {
                session()->flash('error', 'Your current password is incorrect.');
                return back();
            }
            // If new password is same as old password
            if (password_verify($validated['password'], $user->password)) {
                session()->flash('error', 'Your new password should not be same as your old password.');
                return back();
            }
        }

        // clear temporarly token session
        session()->forget('token');

        $user->password = $validated['password'];
        $user->save();

        session()->flash('success', 'Your password has been changed');
        return back();
    }

    /**
     * Change Profile Avatar
     */
    private function changeAvatar(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:png,jpg|max:2048',
            'selected_avatar' => 'nullable|string'
        ]);

        $user = $request->user();

        // Check if a new avatar file has been uploaded
        if ($request->hasFile('avatar')) {
            $filename = time() . '.' . $request->file('avatar')->extension();
            $validated['avatar'] = $request->file('avatar')
                ->storeAs('avatars', $filename, 'public');
            $user->avatar = $validated['avatar'];
        } elseif ($request->filled('selected_avatar')) {
            // If no file is uploaded, use the selected avatar path
            $user->avatar = $request->input('selected_avatar');
        }

        // Save the updated user data
        $user->save();

        // Flash a success message to the session
        session()->flash('success', 'Your profile picture is updated');

        // Redirect back to the previous page
        return back();
    }

    /**
     * validatePassword
     *
     * @param  mixed $request
     * @param  mixed $requireCurrentPassword
     * @return void
     */
    private function validatePassword(Request $request, $requireCurrentPassword = true)
    {
        $rules = [
            'password' => 'required|min:8|max:64',
            'confirm_password' => 'required|same:password'
        ];

        if ($requireCurrentPassword) {
            $rules['current_password'] = 'required';
        }

        return $request->validate($rules);
    }

    /**
     * updateKyc
     */
    public function updateKyc(Request $request)
    {
        // Validated
        $validated = $request->validate([
            'id_number' => 'required|numeric|max_digits:50',
            'id_proof_front' => 'required|mimes:jpeg,png|max:2048',
            'id_proof_back' => 'required|mimes:jpeg,png|max:2048',
            'address_proof' => 'required|mimes:jpeg,png|max:2048',
        ]);

        // Get current user
        $user = Auth::user();

        // Upload ID Proof Front
        $id_proof_front = time() . '-id-proof-front' . $request->file('id_proof_front')->extension();
        $validated['id_proof_front'] = $request->file('id_proof_front')
            ->storeAs('user-kyc', $id_proof_front, 'public');

        // Upload ID Proof Back
        $id_proof_back = time() . '-id-proof-back' . $request->file('id_proof_back')->extension();
        $validated['id_proof_back'] = $request->file('id_proof_back')
            ->storeAs('user-kyc', $id_proof_back, 'public');

        // Upload Address Proof
        $address_proof = time() . '-address-proof' . $request->file('address_proof')->extension();
        $validated['address_proof'] = $request->file('address_proof')
            ->storeAs('user-kyc', $address_proof, 'public');

        // Update KYC
        $user->userKyc->update($validated);

        session()->flash('success', 'KYC updated successfully!');

        return back();
    }
}
