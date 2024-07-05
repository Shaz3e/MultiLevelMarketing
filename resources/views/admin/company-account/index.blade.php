@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Company Accounts',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => null],
        ],
    ])

    @can('company-account.create')
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-2">
                <a href="{{ route('admin.company-accounts.create') }}" class="btn btn-success btn-sm waves-effect waves-light">
                    <i class="ri-add-fill align-middle me-2"></i> Create New Account
                </a>
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
    @endcan

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Account</th>
                                    <th style="width: 60%">Balance</th>
                                    <th style="width: 20%">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companyAccounts as $account)
                                    <tr>
                                        <td>
                                            <h5 class="card-title">{{ $account->name }}</h5>
                                        </td>
                                        <td>
                                            <p class="card-text">Equity (Initial balance):
                                                <strong>{{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}{{ number_format($account->starting_balance, 2) }}
                                                    {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                                                </strong>
                                            </p>
                                            <p class="card-text">
                                                Total in:
                                                <strong>{{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}{{ number_format($account->total_in, 2) }}
                                                    {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                                                </strong>
                                                <br>
                                                Total out:
                                                <strong>{{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}{{ number_format($account->total_out, 2) }}
                                                    {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                                                </strong>
                                            </p>

                                            <p class="card-text">
                                                Last Deposit:
                                                <strong>{{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}{{ number_format($account->last_deposit, 2) }}
                                                    {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                                                </strong>
                                                on <strong>
                                                    @if ($account->last_deposit_date)
                                                        {{ $account->last_deposit_date->format('F j Y, g:i A') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </strong>
                                                <br>
                                                Last Withdraw:
                                                <strong>{{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}{{ number_format($account->last_withdraw, 2) }}
                                                    {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                                                </strong>
                                                on
                                                <strong>
                                                    @if ($account->last_withdraw_date)
                                                        {{ $account->last_withdraw_date->format('F j Y, g:i A') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </strong>
                                            <p class="card-text">
                                                <strong>Balance:
                                                    {{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}{{ number_format($account->starting_balance + $account->total_in - $account->total_out, 2) }}
                                                    {{ currency(DiligentCreators('currency'), ['name'])['name'] }}</strong>
                                            </p>
                                        </td>
                                        <td>
                                            @can('company-account.update')
                                                <a href="{{ route('admin.company-accounts.edit', $account->id) }}"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- /.table-responsive --}}

                    {{ $companyAccounts->links('pagination::bootstrap-5') }}
                </div>
                {{-- /.card-body --}}

                <div class="card-body">
                    <h2 class="card-title">Net Worth
                        {{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}{{ number_format($netWorth, 2) }}
                        {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                    </h2>
                </div>
            </div>
            {{-- /.card --}}
        </div>
        {{-- .col --}}
    </div>
    {{-- /.row --}}

    <div class="row">
        <div class="col-12">
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
