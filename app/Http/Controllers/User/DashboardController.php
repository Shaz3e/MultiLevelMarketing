<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Ranking;
use App\Models\ReferralTree;
use App\Models\User;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $promotions = Promotion::where('is_active', 1)
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $user = Auth::user(); // Get the logged-in user

        
        $referralTree = User::with('referrals.referrals.referrals')->findOrFail($user->id);

        return view('user.dashboard', [
            'user' => $user,
            'referralTree' => $referralTree,
            'promotions' => $promotions,
        ]);
    }

    // private function showTree($userId)
    // {
    //     $user = User::findOrFail($userId);
    //     $referralTree = ReferralTree::where('parent_id', $userId)->get();

    //     foreach ($referralTree as $tree) {
    //         $tree->level_1 = $this->getUserWithReferralTree($tree->user_id);
    //         if ($tree->level_1) {
    //             $tree->level_2 = $this->getUserWithReferralTree($tree->level_1->id);
    //             if ($tree->level_2) {
    //                 $tree->level_3 = $this->getUserWithReferralTree($tree->level_2->id);
    //             }
    //         }
    //     }

    //     return $referralTree;
    // }

    // private function getUserWithReferralTree($userId)
    // {
    //     $user = User::find($userId);
    //     if ($user) {
    //         $user->referralTree = ReferralTree::where('parent_id', $userId)->first();
    //     }
    //     return $user;
    // }
}
