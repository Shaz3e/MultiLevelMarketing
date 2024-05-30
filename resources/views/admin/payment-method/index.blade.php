@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Payment Methods',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => null],
        ],
    ])

    @livewire('admin.payment-method.payment-method-list')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
