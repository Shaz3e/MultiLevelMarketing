@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Pins',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'Pin Code List', 'link' => null],
        ],
    ])

    @livewire('user.pin-code.pin-code-list')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
