@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Rankings',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => null],
        ],
    ])

    @livewire('admin.ranking.ranking-list')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
