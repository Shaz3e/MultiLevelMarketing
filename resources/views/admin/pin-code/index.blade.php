@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Pins',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => null],
        ],
    ])

    @livewire('admin.pin-code.pin-code-list')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
