@extends('components.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">
                    {{ $user->name }}
                    <small>Referred the following users</small>
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">My Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Direct --}}
    <div class="row">
        <div class="col-12">
            <div class="row mb-3 d-flex flex-nowrap" style="overflow-x: auto">
                @foreach ($user->referrals as $direct)
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                        <x-referral-card :direct="$direct" />
                    </div>
                    {{-- /.col --}}
                @endforeach
            </div>
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
