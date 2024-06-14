{{-- Direct --}}
<div class="row">
    <div class="col-12">
        <h3 class="card-title">My Direct Referral(s)</h3>
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

{{-- Level 1 --}}
<!--
<div class="row">
    <div class="col-12">
        <h3 class="card-title">My Level 1 Referral(s)</h3>
        <div class="row mb-3 d-flex flex-nowrap" style="overflow-x: auto">
            @foreach ($user->referrals as $direct)
                @if ($direct->referrals->count())
                    @foreach ($direct->referrals as $level1)
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                            <a href="{{ route('referrals.level1', $level1->id) }}">
                                <div class="card card-primary">
                                    <div class="card-body pb-0 px-0">
                                        <div class="px-4">
                                            @if ($level1->avatar)
                                                <img src="{{ asset('storage/' . $level1->avatar) }}"
                                                    class="rounded-circle d-blok w-100 mx-auto"
                                                    alt="{{ $level1->name }}" />
                                            @else
                                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                    class="rounded-circle d-blok w-100 mx-auto"
                                                    alt="{{ $level1->name }}" />
                                            @endif
                                        </div>
                                        <p class="my-2 text-center">
                                            {{ $level1->name }}
                                            <br>
                                            <span class="badge bg-primary">User ID: {{ $level1->id }}</span>
                                            <br>
                                            <span class="badge bg-success">Ref Code: {{ $level1->referral_code }}</span>
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
        </div>
    </div>
    {{-- /.col --}}
</div>
-->
{{-- /.row --}}

{{-- Level 2 --}}
<!--
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
                                                    <span class="badge bg-success">Ref Code: {{ $level2->referral_code }}</span>
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
-->
{{-- /.row --}}

{{-- Level 3 --}}
<!--
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
                                        <a href="{{ route('referrals.level3', $level3->id) }}">
                                            <div class="card card-primary">
                                                <div class="card-body pb-0 px-0">
                                                    <div class="px-4">
                                                        @if ($level3->avatar)
                                                            <img src="{{ asset('storage/' . $level3->avatar) }}"
                                                                class="rounded-circle d-blok w-100 mx-auto"
                                                                alt="{{ $level3->name }}" />
                                                        @else
                                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                                class="rounded-circle d-blok w-100 mx-auto"
                                                                alt="{{ $level3->name }}" />
                                                        @endif
                                                    </div>
                                                    <p class="my-2 text-center">
                                                        {{ $level3->name }}
                                                        <br>
                                                        <span class="badge bg-primary">User ID: {{ $level3->id }}</span>
                                                        <br>
                                                        <span class="badge bg-success">Ref Code: {{ $level3->referral_code }}</span>
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
                @endif
            @endforeach
        </div>
    </div>
    {{-- /.col --}}
</div>
-->
{{-- /.row --}}

<!--
<div class="row">
    <div class="col-12">
        <h1>Referral Hierarchy for {{ $user->name }}</h1>
        <ul>
            @foreach ($user->referrals as $referral)
                <li>{{ $referral->name }}
                    @if ($referral->referrals->count())
                        <ul>
                            @foreach ($referral->referrals as $subReferral)
                                <li>{{ $subReferral->name }}
                                    @if ($subReferral->referrals->count())
                                        <ul>
                                            @foreach ($subReferral->referrals as $subSubReferral)
                                                <li>{{ $subSubReferral->name }}</li>
                                                <ul>
                                                    @foreach ($subSubReferral->referrals as $subSubSubReferral)
                                                        <li>{{ $subSubSubReferral->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    {{-- /.col --}}
</div>
-->


@push('styles')
@endpush

@push('scripts')
@endpush
