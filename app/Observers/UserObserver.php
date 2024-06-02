<?php

namespace App\Observers;

use App\Mail\User\Auth\RegistrationEmail;
use App\Models\User;
use App\Models\UserKyc;
use App\Models\UserPayoutWallet;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Create Wallet
        $wallet = UserWallet::create([
            'user_id' => $user->id,
            'amount' => DiligentCreators('default_price'),
            'points' => 25,
        ]);

        // Create User Kyc
        $UserKyc = UserKyc::create([
            'user_id' => $user->id
        ]);

        // Create User Payout Wallet
        $userPayoutWallet = UserPayoutWallet::create([
            'user_id' => $user->id
        ]);

        // Send Registration Email
        Mail::to($user->email)
            ->send(new RegistrationEmail($user));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
