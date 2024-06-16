@extends('components.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">My Level 3 Referral(s)</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">My Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Direct Referrals</a></li>
                        <li class="breadcrumb-item active">Level 3 Referrals</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Level 3 --}}
    <div class="row">
        <div class="col-12">
            <h3 class="card-title">My Level 3 Referral(s)</h3>
            <div class="row mb-3 d-flex flex-nowrap" style="overflow-x: auto">
                @foreach ($user->referrals as $direct)
                    @if ($direct->referrals->count())
                        @foreach ($direct->referrals as $level1)
                            @if ($level1->referrals->count())
                                @foreach ($level1->referrals as $level2)
                                    @if ($level2->referrals->count())
                                        @foreach ($level2->referrals as $level3)
                                            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                                <x-referral-card :direct="$level3" />
                                            </div>
                                            {{-- /.col --}}
                                        @endforeach
                                    @endif
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
