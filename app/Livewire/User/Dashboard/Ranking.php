<?php

namespace App\Livewire\User\Dashboard;

use App\Models\Ranking as ModelsRanking;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Ranking extends Component
{
    public function render()
    {
        $user = Auth::user(); // Get the logged-in user

        // $userPoints = $user->wallet->points; // Get the user's current points
        $userPoints = UserWallet::where('user_id', $user->id)
            ->where('created_at', '>', now()->subDays(60))
            ->sum('points'); // Get the user's 60 days points

        // Join rankings table with user_wallets on bonus_point column
        $nextRanking = ModelsRanking::where('bonus_point', '>', $userPoints)
            ->first();

        // Calculate progress percentage
        $progress = ($userPoints / $nextRanking->bonus_point) * 100;

        return view('livewire.user.dashboard.ranking',[
            'user' => $user,
            'progress' => $progress,
            'userPoints' => $userPoints,
            'nextRanking' => $nextRanking,
        ]);
    }
}
