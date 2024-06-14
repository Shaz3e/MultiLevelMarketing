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
                        <a href="{{ route('referrals.direct', $direct->id) }}">
                            <div class="card card-primary">
                                <div class="card-body pb-0 px-0">
                                    <div class="px-4">
                                        @if ($direct->avatar)
                                            <img src="{{ asset('storage/' . $direct->avatar) }}"
                                                class="rounded-circle d-blok w-100 mx-auto" alt="{{ $direct->name }}" />
                                        @else
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                class="rounded-circle d-blok w-100 mx-auto" alt="{{ $direct->name }}" />
                                        @endif
                                    </div>
                                    <p class="my-2 text-center">
                                        {{ $direct->name }}
                                        <br>
                                        <span class="badge bg-primary">User ID: {{ $direct->id }}</span>
                                        <br>
                                        <span class="badge bg-success">Ref Code: {{ $direct->referral_code }}</span>
                                    </p>
                                </div>
                                {{-- /.card-body --}}
                            </div>
                            {{-- /.card --}}
                        </a>
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
