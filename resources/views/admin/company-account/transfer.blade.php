@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Account Transfer',
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
                <form action="{{ route('admin.company-account.transfer.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="from_account">Transfer From Account</label>
                                    <select name="from_account" id="from_account" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($companyAccounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('from_account')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- /.form-group --}}
                            </div>
                            {{-- /.col --}}
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="to_account">Transfer To Account</label>
                                    <select name="to_account" id="to_account" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($companyAccounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('to_account')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- /.form-group --}}
                            </div>
                            {{-- /.col --}}
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="transfer_balance">Transfer Balance</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="amount-prepend">
                                                {{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}
                                            </span>
                                        </div>
                                        <input type="number" name="transfer_balance" id="transfer_balance" class="form-control"
                                            value="{{ old('transfer_balance') }}" placeholder="Enter Amount" aria-label="Amount"
                                            aria-describedby="transfer_balance" step="1" minlength="1" maxlength="12">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="amount-append">
                                                {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                                            </span>
                                        </div>
                                    </div>
                                    @error('transfer_balance')
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
