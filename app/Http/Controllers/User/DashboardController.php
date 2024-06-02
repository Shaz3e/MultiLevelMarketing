<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Ranking;
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

        // $userPoints = $user->wallet->points; // Get the user's current points
        $userPoints = UserWallet::where('user_id', $user->id)
            ->where('created_at', '>', now()->subDays(60))
            ->sum('points'); // Get the user's 60 days points

        // Join rankings table with user_wallets on bonus_point column
        $nextRanking = Ranking::where('bonus_point', '>', $userPoints)
            ->first();

        // Calculate progress percentage
        $progress = ($userPoints / $nextRanking->bonus_point) * 100;

        return view('user.dashboard', [
            'user' => $user,
            'promotions' => $promotions,
            'progress' => $progress,
            'userPoints' => $userPoints,
            'nextRanking' => $nextRanking,
        ]);
    }
}
