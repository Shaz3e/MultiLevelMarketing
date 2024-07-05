<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyAccount\StoreCompanyAccountRequest;
use App\Models\CompanyAccount;
use App\Models\Ledger;
use App\Trait\Admin\FormHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CompanyAccountController extends Controller
{
    use FormHelper;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check Authorize
        Gate::authorize('viewAny', CompanyAccount::class);

        $companyAccounts = CompanyAccount::paginate(10);

        $startingBalance = CompanyAccount::pluck('starting_balance')->sum();
        $totalIn = CompanyAccount::pluck('total_in')->sum();
        $totalOut = CompanyAccount::pluck('total_out')->sum();

        $netWorth = $startingBalance + $totalIn - $totalOut;

        return view('admin.company-account.index', [
            'companyAccounts' => $companyAccounts,
            'netWorth' => $netWorth,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check Authorize
        Gate::authorize('create', CompanyAccount::class);

        return view('admin.company-account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyAccountRequest $request)
    {
        // Check Authorize
        Gate::authorize('create', CompanyAccount::class);

        // Validate data
        $validated = $request->validated();

        // Update record in database
        $companyAccount = CompanyAccount::create($validated);


        session()->flash('success', 'Company Account Created successfully!');

        return $this->saveAndRedirect($request, 'company-accounts', $companyAccount->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyAccount $companyAccount)
    {
        // Check Authorize
        Gate::authorize('view', $companyAccount);

        if (!$companyAccount) {
            return redirect()->route('admin.company-accunts.index');
        }

        return to_route('admin.company-accounts.edit', $companyAccount);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyAccount $companyAccount)
    {
        // Check Authorize
        Gate::authorize('update', $companyAccount);

        return view('admin.company-account.edit', [
            'companyAccount' => $companyAccount,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCompanyAccountRequest $request, CompanyAccount $companyAccount)
    {
        // Check Authorize
        Gate::authorize('update', $companyAccount);

        // Validate data
        $validated = $request->validated();

        // Update record in database
        $companyAccount->update($validated);

        // Flash message
        session()->flash('success', 'Company Account updated successfully!');

        return $this->saveAndRedirect($request, 'company-accounts', $companyAccount->id);
    }

    /**
     * Delete the specified resources in storage.
     */
    public function destroy(CompanyAccount $companyAccount)
    {
        // Check Authorize
        Gate::authorize('delete', $companyAccount);

        return redirect()->route('admin.company-accunts.index');
    }

    /**
     * Restore Deleted resource in storage.
     */
    public function restore(CompanyAccount $companyAccount)
    {
        // Check Authorize
        Gate::authorize('restore', $companyAccount);

        return redirect()->route('admin.company-accunts.index');
    }

    /**
     * Force Delete the specified resouce in storage.
     */
    public function forceDelete(CompanyAccount $companyAccount)
    {
        // Check Authorize
        Gate::authorize('forceDelete', $companyAccount);

        return redirect()->route('admin.company-accunts.index');
    }

    /**
     * Transfer Amount from One Account to Account
     */
    public function transfer(CompanyAccount $companyAccount)
    {
        // Check Authorize
        Gate::authorize('create', $companyAccount);

        $companyAccounts = CompanyAccount::all();

        return view('admin.company-account.transfer', [
            'companyAccounts' => $companyAccounts,
        ]);
    }
    public function transferStore(Request $request, CompanyAccount $companyAccount)
    {
        // Check Authorize
        Gate::authorize('update', $companyAccount);

        // Validate data
        $validated = $request->validate([
            'from_account' => 'required|exists:company_accounts,id',
            'to_account' => 'required|exists:company_accounts,id',
            'transfer_balance' => 'required|numeric|min:0.01' // Ensure positive transfer balance
        ]);

        // Prevent self-transfer
        if ($validated['from_account'] == $validated['to_account']) {
            session()->flash('error', 'Both accounts are the same!');
            return back();
        }

        // Use a transaction for safe balance updates
        DB::transaction(function () use ($validated) {
            $fromAccount = CompanyAccount::find($validated['from_account']);
            $toAccount = CompanyAccount::find($validated['to_account']);

            // Calculate current balance (ensure you include all relevant fields)
            $currentBalance = $fromAccount->starting_balance + $fromAccount->total_in - $fromAccount->total_out;

            // Check if there is enough balance
            if ($validated['transfer_balance'] > $currentBalance) {
                session()->flash('error', 'Insufficient Balance!');
                return back();
            }

            // Decrement from the source account
            $fromAccount->update([
                'starting_balance' => $fromAccount->starting_balance - $validated['transfer_balance']
            ]);

            $user = Auth::guard('admin')->user();

            Ledger::create([
                'transaction_number' => Str::uuid(),
                'withdraw' => $validated['transfer_balance'],
                'status' => Ledger::STATUS_PAID,
                'note' => "Balance transferred by " . $user->name . " from account: " . $fromAccount->name . " to account: " . $toAccount->name,
            ]);

            // Increment to the destination account
            $toAccount->update([
                'starting_balance' => $toAccount->starting_balance + $validated['transfer_balance']
            ]);

            Ledger::create([
                'transaction_number' => Str::uuid(),
                'deposit' => $validated['transfer_balance'],
                'status' => Ledger::STATUS_PAID,
                'note' => "Balance transferred by " . $user->name . " to account: " . $toAccount->name . " from account: " . $fromAccount->name,
            ]);
        });

        session()->flash('success', 'Amount transferred successfully!');
        
        return redirect()->route('admin.company-accounts.index');
    }
}
