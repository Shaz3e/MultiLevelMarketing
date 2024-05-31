<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ledger\StoreWithdrawLedgerRequest;
use App\Models\Ledger;
use App\Trait\Admin\FormHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class LedgerWithdrawController extends Controller
{
    use FormHelper;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check Authorize
        Gate::authorize('viewAny', Ledger::class);

        return view('admin.ledger.withdraw.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check Authorize
        Gate::authorize('create', Ledger::class);

        $ledgerStatuses = Ledger::getStatuses();

        return view('admin.ledger.withdraw.create',[
            'ledgerStatuses' => $ledgerStatuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWithdrawLedgerRequest $request)
    {
        // Check Authorize
        Gate::authorize('create', Ledger::class);

        // Validated request
        $validated = $request->validated();

        // Create Transaction Number
        $validated['transaction_number'] = $this->generateTransactionNumber();
        $validated['created_by'] = auth()->user()->id;

        // Create record in database
        $withdraw = Ledger::create($validated);

        session()->flash('success', 'Withdraw has been created successfully!');

        return $this->saveAndRedirect($request, 'ledger.withdraws', $withdraw->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ledger $withdraw)
    {
        // Check Authorize
        Gate::authorize('read', $withdraw);

        return view('admin.ledger.withdraw.show', [
            'withdraw' => $withdraw,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ledger $withdraw)
    {
        // Check Authorize
        Gate::authorize('update', $withdraw);

        $ledgerStatuses = Ledger::getStatuses();

        return view('admin.ledger.withdraw.edit', [
            'withdraw' => $withdraw,
            'ledgerStatuses' => $ledgerStatuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreWithdrawLedgerRequest $request, Ledger $withdraw)
    {
        // Check Authorize
        Gate::authorize('update', $withdraw);

        // Validate data
        $validated = $request->validated();

        // Update record in database
        $withdraw->update($validated);

        // Flash message
        session()->flash('success', 'Withdraw has been updated successfully!');

        return $this->saveAndRedirect($request, 'ledger.withdraws', $withdraw->id);
    }

    /**
     * Generate Transactions Number
     */
    private function generateTransactionNumber()
    {
        // Generate Transaction Number
        $transactionNumber = Str::uuid();
        return $transactionNumber;
    }
}

