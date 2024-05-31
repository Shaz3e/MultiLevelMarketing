<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Ledger;

class LedgerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        if($admin->can('ledger.list')){
            return true;
        }
    }
    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Ledger $ledger)
    {
        if ($admin->can('ledger.read')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        if ($admin->can('ledger.create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Ledger $ledger)
    {
        if ($admin->can('ledger.update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Ledger $ledger)
    {
        if ($admin->can('ledger.delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Ledger $ledger)
    {
        if ($admin->can('ledger.restore')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Ledger $ledger)
    {
        if ($admin->can('ledger.force.delete')) {
            return true;
        }
    }
}
