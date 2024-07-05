@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Create New Company',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'Company Account', 'link' => route('admin.company-accounts.index')],
            ['text' => 'Create', 'link' => null],
        ],
    ])

    {{-- Create Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.company-accounts.update', $companyAccount) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Account Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $companyAccount->name) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- /.form-group --}}
                            </div>
                            {{-- /.col --}}
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="starting_balance">Starting Balance</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="amount-prepend">
                                                {{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}
                                            </span>
                                        </div>
                                        <input type="number" name="starting_balance" id="starting_balance" class="form-control"
                                            value="{{ old('starting_balance', $companyAccount->starting_balance) }}" placeholder="Enter Amount" aria-label="Amount"
                                            aria-describedby="starting_balance" step="10" minlength="1" maxlength="12" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="amount-append">
                                                {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                                            </span>
                                        </div>
                                    </div>
                                    @error('starting_balance')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- /.form-group --}}
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer">
                        <x-form.button />
                        <x-form.button-save-create-new />
                    </div>
                    {{-- /.card-footer --}}
                </form>
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
