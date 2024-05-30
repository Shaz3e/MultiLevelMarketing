<?php

namespace App\Livewire\Admin\PinCode;

use App\Models\PinCode;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PinCodeList extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    public $perPage = 10;

    public $id;

    public $createdBy;

    public $isUsed;

    // record to delete
    public $recordToDelete;

    // Show deleted records
    public $showDeleted = false;

    /**
     * Main Blade Render
     */
    public function render()
    {
        $query = PinCode::query();

        // Get all columns in the required table
        $columns = Schema::getColumnListing('pin_codes');

        // Filter records based on search query
        if ($this->search !== '') {
            $query->where(function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $this->search . '%');
                }
            });
        }
        // Filter records based on created by as user_id or admin_id
        if ($this->createdBy) {
            if ($this->createdBy == 'admin') {
                $query->whereNotNull('admin_id');
            } elseif ($this->createdBy == 'user') {
                $query->whereNotNull('user_id');
            }
        }
        // Filter records based on is_used
        if ($this->isUsed) {
            if ($this->isUsed == false) {
                $query->where('is_used', false);
            } elseif ($this->isUsed == true) {
                $query->where('is_used', true);
            }
        }

        // Apply filter for deleted records if the option is selected
        if ($this->showDeleted) {
            $query->onlyTrashed();
        }

        $pinCodes = $query->orderBy('id', 'desc')->paginate($this->perPage);

        return view('livewire.admin.pin-code.pin-code-list', [
            'pinCodes' => $pinCodes
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
     * Confirm Delete
     */
    public function confirmDelete($id)
    {
        $this->recordToDelete = $id;
        $this->dispatch('showDeleteConfirmation');
    }

    /**
     * Delete Record
     */
    #[On('deleteConfirmed')]
    public function delete()
    {
        // Check if a record to delete is set
        if (!$this->recordToDelete) {
            $this->dispatch('error');
            return;
        }

        // get id
        $pinCode = PinCode::find($this->recordToDelete);

        // Check record exists
        if (!$pinCode) {
            $this->dispatch('error');
            return;
        }

        // Delete record
        $pinCode->delete();

        // Reset the record to delete
        $this->recordToDelete = null;
    }

    /**
     * Confirm Restore
     */
    public function confirmRestore($id)
    {
        $this->recordToDelete = $id;
        $this->dispatch('confirmRestore');
    }

    /**
     * Restore record
     */
    #[On('restored')]
    public function restore()
    {
        PinCode::withTrashed()->find($this->recordToDelete)->restore();
    }

    /**
     * Confirm force delete
     */
    public function confirmForceDelete($userId)
    {
        $this->recordToDelete = $userId;
        $this->dispatch('confirmForceDelete');
    }

    /**
     * Force delete record
     */
    #[On('forceDeleted')]
    public function forceDelete()
    {
        PinCode::withTrashed()->find($this->recordToDelete)->forceDelete();
    }
}
