@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Withdraw List',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'Withdraw List', 'link' => null],
        ],
    ])

    @livewire('admin.ledger.withdraw.ledger-withdraw-list')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
