<?php

namespace App\Observers;

use App\Models\PinCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PinCodeObserver
{
    /**
     * Handle the PinCode "created" event.
     */
    public function created(PinCode $pinCode): void
    {
        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $pinCode->admin_id = $admin->id;
        } else {
            $user = Auth::user();
            if ($user) {
                $pinCode->user_id = $user->id;
            }
        }
        $pinCode->save();
    }

    /**
     * Handle the PinCode "updated" event.
     */
    public function updated(PinCode $pinCode): void
    {
        //
    }

    /**
     * Handle the PinCode "deleted" event.
     */
    public function deleted(PinCode $pinCode): void
    {
        //
    }

    /**
     * Handle the PinCode "restored" event.
     */
    public function restored(PinCode $pinCode): void
    {
        //
    }

    /**
     * Handle the PinCode "force deleted" event.
     */
    public function forceDeleted(PinCode $pinCode): void
    {
        //
    }
}
