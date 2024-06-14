@extends('components.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">My Level 2 Referral(s)</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">My Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Direct Referrals</a></li>
                        <li class="breadcrumb-item active">Level 1 Referrals</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Level 2 --}}
    <div class="row">
        <div class="col-12">
            <div class="row mb-3 d-flex flex-nowrap" style="overflow-x: auto">
                @foreach ($user->referrals as $direct)
                    @if ($direct->referrals->count())
                        @foreach ($direct->referrals as $level1)
                            @if ($level1->referrals->count())
                                @foreach ($level1->referrals as $level2)
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                        <a href="{{ route('referrals.level2', $level2->id) }}">
                                            <div class="card card-primary">
                                                <div class="card-body pb-0 px-0">
                                                    <div class="px-4">
                                                        @if ($level2->avatar)
                                                            <img src="{{ asset('storage/' . $level2->avatar) }}"
                                                                class="rounded-circle d-blok w-100 mx-auto"
                                                                alt="{{ $level2->name }}" />
                                                        @else
                                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                                class="rounded-circle d-blok w-100 mx-auto"
                                                                alt="{{ $level2->name }}" />
                                                        @endif
                                                    </div>
                                                    <p class="my-2 text-center">
                                                        {{ $level2->name }}
                                                        <br>
                                                        <span class="badge bg-primary">User ID: {{ $level2->id }}</span>
                                                        <br>
                                                        <span class="badge bg-success">Ref Code:
                                                            {{ $level2->referral_code }}</span>
                                                    </p>
                                                </div>
                                                {{-- /.card-body --}}
                                            </div>
                                            {{-- /.card --}}
                                        </a>
                                    </div>
                                    {{-- /.col --}}
                                @endforeach
                            @endif
                        @endforeach
                    @endif
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
