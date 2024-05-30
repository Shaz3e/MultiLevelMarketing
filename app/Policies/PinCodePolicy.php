<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\PinCode;

class PinCodePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        if($admin->can('pin-code.list')){
            return true;
        }
    }
    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, PinCode $pinCode)
    {
        if ($admin->can('pin-code.read')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        if ($admin->can('pin-code.create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, PinCode $pinCode)
    {
        if ($admin->can('pin-code.update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, PinCode $pinCode)
    {
        if ($admin->can('pin-code.delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, PinCode $pinCode)
    {
        if ($admin->can('pin-code.restore')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, PinCode $pinCode)
    {
        if ($admin->can('pin-code.force.delete')) {
            return true;
        }
    }
}
