<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index($userId)
    {
        $user = User::with('referrals.referrals.referrals')->findOrFail($userId);

        return view('user.referrals.direct', ['user' => $user]);
    }
    public function direct($userId)
    {
        $user = User::with('referrals.referrals.referrals')->findOrFail($userId);

        return view('user.referrals.direct', ['user' => $user]);
    }
    public function levelOne($userId)
    {
        $user = User::with('referrals.referrals.referrals')->findOrFail($userId);

        return view('user.referrals.one', ['user' => $user]);
    }
    public function levelTwo($userId)
    {
        $user = User::with('referrals.referrals.referrals')->findOrFail($userId);

        return view('user.referrals.two', ['user' => $user]);
    }
    public function levelThree($userId)
    {
        $user = User::with('referrals.referrals.referrals')->findOrFail($userId);

        return view('user.referrals.three', ['user' => $user]);
    }


    /**
     * Get User by Referral Code
     */
    public function getUserData(Request $request)
    {
        // Validate the referral code
        $request->validate([
            'referral_code' => 'required|string|max:255',
        ]);

        // Retrieve the user with the given referral code
        $user = User::where('referral_code', $request->referral_code)->first();

        if (!$user) {
            // Return JSON response with status and message for invalid referral code
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Referral Code'
            ]);
        }

        // Return user data in JSON format
        return response()->json([
            'status' => 'success',
            'user' => $user
        ]);
    }
}
