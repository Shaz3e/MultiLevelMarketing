@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'My Profile',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'My Profile', 'link' => null],
        ],
    ])

    {{-- My details --}}
    @include('admin.profile.information')

    {{-- Change Avatar --}}
    @include('admin.profile.avatar')

    {{-- Change Password --}}
    @include('admin.profile.password')
@endsection

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        // Input mask
        $(document).ready(function() {
            $(".input-mask").inputmask()
        });
    </script>
@endpush
