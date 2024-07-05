<?php

namespace App\Observers;

use App\Models\CompanyAccount;
use App\Models\Ledger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CompanyAccountObserver
{
    /**
     * Handle the CompanyAccount "created" event.
     */
    public function created(CompanyAccount $companyAccount): void
    {
        // Adding Starting Balance
        if (request()->starting_balance) {
            Ledger::create([
                'transaction_number' => Str::uuid(),
                'deposit' => request()->starting_balance,
                'status' => Ledger::STATUS_PAID,
                'note' => "Balance Added by " . Auth::guard('admin')->user()->name,
            ]);
        }
    }

    /**
     * Handle the CompanyAccount "updated" event.
     */
    public function updated(CompanyAccount $companyAccount): void
    {
        $user = Auth::guard('admin')->user();
        // Updating Starting Balance
        if (request()->starting_balance) {
            Ledger::create([
                'transaction_number' => Str::uuid(),
                'deposit' => request()->starting_balance,
                'status' => Ledger::STATUS_PAID,
                'note' => "Balance Updated by " . $user->name
            ]);
        }
    }

    /**
     * Handle the CompanyAccount "deleted" event.
     */
    public function deleted(CompanyAccount $companyAccount): void
    {
        //
    }

    /**
     * Handle the CompanyAccount "restored" event.
     */
    public function restored(CompanyAccount $companyAccount): void
    {
        //
    }

    /**
     * Handle the CompanyAccount "force deleted" event.
     */
    public function forceDeleted(CompanyAccount $companyAccount): void
    {
        //
    }
}
