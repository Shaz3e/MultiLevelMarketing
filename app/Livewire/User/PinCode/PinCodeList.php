<?php

namespace App\Livewire\User\PinCode;

use App\Models\PinCode;
use Illuminate\Support\Facades\Schema;
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

    public $isUsed;

    /**
     * Main Blade Render
     */
    public function render()
    {
        $user = auth()->user();
        // $query = PinCode::where('user_id', $user->id)->query();
        $query = PinCode::query()->where('user_id', $user->id);

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
        // Filter records based on is_used
        if ($this->isUsed) {
            if ($this->isUsed == false) {
                $query->where('is_used', false);
            } elseif ($this->isUsed == true) {
                $query->where('is_used', true);
            }
        }

        $pinCodes = $query->orderBy('id', 'desc')->paginate($this->perPage);

        return view('livewire.user.pin-code.pin-code-list', [
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
}
