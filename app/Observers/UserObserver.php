<?php

namespace App\Observers;

use App\Mail\User\Auth\RegistrationEmail;
use App\Models\Ledger;
use App\Models\PinCode;
use App\Models\ReferralTree;
use App\Models\User;
use App\Models\UserKyc;
use App\Models\UserPayoutWallet;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Create User Kyc
        UserKyc::create([
            'user_id' => $user->id
        ]);

        // Create User Payout Wallet
        UserPayoutWallet::create([
            'user_id' => $user->id
        ]);

        // Update Pin
        PinCode::where('pin_code', request()->pin_code)->update([
            'is_used' => 1,
            'used_by' => $user->id,
            'used_at' => now(),
        ]);

        // Update ledger
        $pincode = PinCode::where('pin_code', request()->pin_code)->first();
        Ledger::where('pin_code', $pincode->id)->update([
            'status' => Ledger::STATUS_PAID
        ]);

        // Send Registration Email
        Mail::to($user->email)
            ->queue(new RegistrationEmail($user));
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
