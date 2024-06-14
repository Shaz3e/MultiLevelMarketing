<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
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
}
