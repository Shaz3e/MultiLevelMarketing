<?php

namespace App\Observers;

use App\Models\PinCode;
use Illuminate\Support\Facades\Auth;

class PinCodeObserver
{
    /**
     * Handle the PinCode "created" event.
     */
    public function created(PinCode $pinCode): void
    {
        // check auth is admin
        if (auth()->guard('admin')) {
            $pinCode->admin_id = auth()->guard('admin')->user()->id;
        } else {
            $pinCode->user_id = auth()->user()->id;
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
