<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserKyc;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserKycList extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    public $perPage = 10;

    public $id;

    /**
     * Main Blade Render
     */
    public function render()
    {
        $query = User::query();

        // Get all columns in the required table
        $columns = Schema::getColumnListing('users');

        // Filter records based on search query
        if ($this->search !== '') {
            $query->where(function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $this->search . '%');
                }
            });
        }

        $users = $query->orderBy('id', 'desc')->paginate($this->perPage);

        return view('livewire.admin.user.user-kyc-list', [
            'users' => $users
        ]);
    }

    /**
     * Reset Search
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Update perPage records
     */
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    /**
     * Toggle User Status
     */
    public function toggleStatus($id)
    {
        // Get user data
        $user = User::find($id);

        // Check user exists
        if (!$user) {
            $this->dispatch('error', 'User not found!');
            return;
        }

        // Change Status
        $user->update(['is_kyc_verified' => !$user->is_kyc_verified]);
        // 'success', 'User status has been updated successfully!'
        $this->dispatch('statusChanged');
    }
}