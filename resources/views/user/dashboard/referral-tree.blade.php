{{-- Direct --}}
<div class="row">
    <div class="col-12">
        <h3 class="card-title">My Direct Referral(s)</h3>
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

{{-- Level 1 --}}
<div class="row">
    <div class="col-12">
        <h3 class="card-title">My Level 1 Referral(s)</h3>
        <div class="row mb-3 d-flex flex-nowrap" style="overflow-x: auto">
            @foreach ($user->referrals as $direct)
                @if ($direct->referrals->count())
                    @foreach ($direct->referrals as $level1)
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                            <x-referral-card :direct="$level1" />
                        </div>
                        {{-- /.col --}}
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
    {{-- /.col --}}
</div>
{{-- /.row --}}

{{-- Level 2 --}}
<div class="row">
    <div class="col-12">
        <h3 class="card-title">My Level 2 Referral(s)</h3>
        <div class="row mb-3 d-flex flex-nowrap" style="overflow-x: auto">
            @foreach ($user->referrals as $direct)
                @if ($direct->referrals->count())
                    @foreach ($direct->referrals as $level1)
                        @if ($level1->referrals->count())
                            @foreach ($level1->referrals as $level2)
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                    <x-referral-card :direct="$level2" />
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

@push('styles')
@endpush

@push('scripts')
@endpush
