<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\CompanyAccount;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyAccountPolicy

{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        if($admin->can('company-account.list')){
            return true;
        }
    }
    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, CompanyAccount $companyAccount)
    {
        if ($admin->can('company-account.read')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        if ($admin->can('company-account.create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, CompanyAccount $companyAccount)
    {
        if ($admin->can('company-account.update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, CompanyAccount $companyAccount)
    {
        if ($admin->can('company-account.delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, CompanyAccount $companyAccount)
    {
        if ($admin->can('company-account.restore')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, CompanyAccount $companyAccount)
    {
        if ($admin->can('company-account.force.delete')) {
            return true;
        }
    }
}