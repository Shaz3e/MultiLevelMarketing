@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Deposit List',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'Deposit List', 'link' => null],
        ],
    ])

    @livewire('admin.ledger.deposit.ledger-deposit-list')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
