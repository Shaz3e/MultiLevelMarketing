<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ledger\StoreDepositLedgerRequest;
use App\Models\Ledger;
use App\Trait\Admin\FormHelper;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class LedgerDepositController extends Controller
{
    use FormHelper;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check Authorize
        Gate::authorize('viewAny', Ledger::class);

        return view('admin.ledger.deposit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check Authorize
        Gate::authorize('create', Ledger::class);

        $ledgerStatuses = Ledger::getStatuses();

        return view('admin.ledger.deposit.create',[
            'ledgerStatuses' => $ledgerStatuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepositLedgerRequest $request)
    {
        // Check Authorize
        Gate::authorize('create', Ledger::class);

        // Validated request
        $validated = $request->validated();

        // Create Transaction Number
        $validated['transaction_number'] = $this->generateTransactionNumber();
        $validated['created_by'] = auth()->user()->id;

        // Create record in database
        $deposit = Ledger::create($validated);

        session()->flash('success', 'Deposit has been created successfully!');

        return $this->saveAndRedirect($request, 'ledger.deposits', $deposit->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ledger $deposit)
    {
        // Check Authorize
        Gate::authorize('read', $deposit);

        return view('admin.ledger.deposit.show', [
            'deposit' => $deposit,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ledger $deposit)
    {
        // Check Authorize
        Gate::authorize('update', $deposit);

        $ledgerStatuses = Ledger::getStatuses();

        return view('admin.ledger.deposit.edit', [
            'deposit' => $deposit,
            'ledgerStatuses' => $ledgerStatuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepositLedgerRequest $request, Ledger $deposit)
    {
        // Check Authorize
        Gate::authorize('update', $deposit);

        // Validate data
        $validated = $request->validated();

        // Update record in database
        $deposit->update($validated);

        // Flash message
        session()->flash('success', 'Deposit has been updated successfully!');

        return $this->saveAndRedirect($request, 'ledger.deposits', $deposit->id);
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

