<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\PaymentMethod;
use Illuminate\Auth\Access\Response;

class PaymentMethodPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        if($admin->can('payment-method.list')){
            return true;
        }
    }
    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, PaymentMethod $paymentMethod)
    {
        if ($admin->can('payment-method.read')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        if ($admin->can('payment-method.create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, PaymentMethod $paymentMethod)
    {
        if ($admin->can('payment-method.update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, PaymentMethod $paymentMethod)
    {
        if ($admin->can('payment-method.delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, PaymentMethod $paymentMethod)
    {
        if ($admin->can('payment-method.restore')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, PaymentMethod $paymentMethod)
    {
        if ($admin->can('payment-method.force.delete')) {
            return true;
        }
    }
}

