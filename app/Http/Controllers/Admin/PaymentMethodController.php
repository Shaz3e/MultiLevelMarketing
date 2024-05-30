<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethod\StorePaymentMethodRequest;
use App\Models\PaymentMethod;
use App\Trait\Admin\FormHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PaymentMethodController extends Controller
{
    use FormHelper;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check Authorize
        Gate::authorize('viewAny', PaymentMethod::class);

        return view('admin.payment-method.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check Authorize
        Gate::authorize('create', PaymentMethod::class);

        return view('admin.payment-method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentMethodRequest $request)
    {
        // Check Authorize
        Gate::authorize('create', PaymentMethod::class);

        // Validated request
        $validated = $request->validated();

        // Create record in database
        $paymentMethod = PaymentMethod::create($validated);

        // Upload icon
        if ($request->hasFile('icon')) {
            $filename = time() . '-icon.' . $request->file('icon')->extension();
            $path = $request->file('icon')->storeAs('payment-methods/icons', $filename, 'public');
            $validated['icon'] = $path;
            $paymentMethod->update($validated);
        }

        session()->flash('success', 'Pin Code has been created successfully!');

        return $this->saveAndRedirect($request, 'payment-methods', $paymentMethod->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        // Check Authorize
        Gate::authorize('read', $paymentMethod);

        return view('admin.payment-method.show', [
            'paymentMethod' => $paymentMethod,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        // Check Authorize
        Gate::authorize('update', $paymentMethod);

        return view('admin.payment-method.edit', [
            'paymentMethod' => $paymentMethod,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        // Check Authorize
        Gate::authorize('update', $paymentMethod);

        // Validate data
        $validated = $request->validated();

        // Update record in database
        $paymentMethod->update($validated);

        // Upload icon
        if ($request->hasFile('icon')) {
            File::delete('storage/' . $paymentMethod->icon);
            $filename = time() . '-icon.' . $request->file('icon')->extension();
            $path = $request->file('icon')->storeAs('payment-methods/icons', $filename, 'public');
            $validated['icon'] = $path;
            $paymentMethod->update($validated);
        }

        // Flash message
        session()->flash('success', 'Payment Method has been updated successfully!');

        return $this->saveAndRedirect($request, 'payment-methods', $paymentMethod->id);
    }
}
