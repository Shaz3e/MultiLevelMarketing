@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'View Transaction Details',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'Withdraw List', 'link' => route('admin.ledger.withdraws.index')],
            ['text' => 'View', 'link' => null],
        ],
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td>Payment Method</td>
                                <td>
                                    <a href="{{ route('admin.payment-methods.show', $withdraw->paymentMethod->id) }}">
                                        {{ $withdraw->paymentMethod->name }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Transaction Number</td>
                                <td>{{ $withdraw->transaction_number }}</td>
                            </tr>
                            <tr>
                                <td>Payment Type</td>
                                <td>Withdraw</td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td>{{ currencyFormat($withdraw->withdraw) }}</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $withdraw->user_id) }}">
                                        {{ $withdraw->user->name }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <span class="badge {{ $withdraw->getStatusColor() }}">
                                        {{ $withdraw->getStatus() }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Created By</td>
                                <td>
                                    @if ($withdraw->created_by)
                                        {{ $withdraw->createdBy->name }}
                                    @else
                                        User
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Created On</td>
                                <td>{{ $withdraw->created_at->format('l, F j, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <td>Updated On</td>
                                <td>{{ $withdraw->updated_at->format('l, F j, Y h:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                    {{-- /.table-responsive --}}
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}

    {{-- Edit Button --}}
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.ledger.deposits.edit', $withdraw->id) }}" class="btn btn-primary btn-sm">
                <i class="ri-pencil-line align-middle me-1"></i> Edit
            </a>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
