@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Pins',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => null],
        ],
    ])

    @livewire('admin.promotion.promotion-list')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
