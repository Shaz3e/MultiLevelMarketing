<?php

namespace App\Livewire\Admin\PaymentMethod;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentMethodList extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    public $perPage = 10;

    public $id;

    // record to delete
    public $recordToDelete;

    // Show active Promotions
    public $showActive = false;

    // Show deleted records
    public $showDeleted = false;

    /**
     * Main Blade Render
     */
    public function render()
    {
        $query = PaymentMethod::query();

        // Get all columns in the required table
        $columns = Schema::getColumnListing('payment_methods');

        // Filter records based on search query
        if ($this->search !== '') {
            $query->where(function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $this->search . '%');
                }
            });
        }

        // Apply filter for active records if the option is selected
        if ($this->showActive) {
            $query->where('is_active', 1);
        }

        // Apply filter for deleted records if the option is selected
        if ($this->showDeleted) {
            $query->onlyTrashed();
        }

        $paymentMethods = $query->orderBy('id', 'asc')->paginate($this->perPage);

        return view('livewire.admin.payment-method.payment-method-list', [
            'paymentMethods' => $paymentMethods
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
     * Toggle Status
     */
    public function toggleStatus($id)
    {
        // Get data
        $paymentMethod = PaymentMethod::find($id);

        // Check user exists
        if (!$paymentMethod) {
            $this->dispatch('error', 'Payment Method not found!');
            return;
        }

        // Change Status
        $paymentMethod->update(['is_active' => !$paymentMethod->is_active]);
        $this->dispatch('statusChanged');
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
        $paymentMethod = PaymentMethod::find($this->recordToDelete);

        // Check record exists
        if (!$paymentMethod) {
            $this->dispatch('error');
            return;
        }

        // Delete record
        $paymentMethod->delete();

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
        PaymentMethod::withTrashed()->find($this->recordToDelete)->restore();
    }

    /**
     * Confirm force delete
     */
    public function confirmForceDelete($id)
    {
        $this->recordToDelete = $id;
        $this->dispatch('confirmForceDelete');
    }

    /**
     * Force delete record
     */
    #[On('forceDeleted')]
    public function forceDelete()
    {
        // Check if a record to delete is set delete image
        if (!$this->recordToDelete) {
            $this->dispatch('error');
            return;
        }

        $ranking = PaymentMethod::withTrashed()->find($this->recordToDelete);
    }
}
