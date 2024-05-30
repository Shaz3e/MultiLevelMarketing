<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Ranking;
use Illuminate\Auth\Access\Response;

class RankingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        if($admin->can('ranking.list')){
            return true;
        }
    }
    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Ranking $ranking)
    {
        if ($admin->can('ranking.read')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        if ($admin->can('ranking.create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Ranking $ranking)
    {
        if ($admin->can('ranking.update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Ranking $ranking)
    {
        if ($admin->can('ranking.delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Ranking $ranking)
    {
        if ($admin->can('ranking.restore')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Ranking $ranking)
    {
        if ($admin->can('ranking.force.delete')) {
            return true;
        }
    }
}
