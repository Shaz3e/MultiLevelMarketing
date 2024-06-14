{{-- @if(count($referralTree) > 0) --}}
<div class="row">
    @for ($i = 1; $i <= 4; $i++)
        <h2 class="h4">
            @if ($i === 1)
                Direct
            @else
                {{-- {{ $referralTree[$i - 1] }} --}}
                {{ $referralTree[$i - 1]['commission_name'] }}
            @endif
        </h2>
        <div class="row mb-3 d-flex flex-nowrap" style="overflow-x: auto">
            @foreach (showLevel($i, Auth::user()->id) as $level)
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <div class="card card-primary">
                        <div class="card-body pb-0 px-0">
                            <div class="px-4">
                                @if ($level->user->avatar)
                                    <img src="{{ asset('storage/' . $level->user->avatar) }}"
                                        class="rounded-circle d-blok w-100 mx-auto" alt="" />
                                @else
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                        class="rounded-circle d-blok w-100 mx-auto" alt="" />
                                @endif
                            </div>
                            <p class="my-2 text-center">
                                {{ $level->name }}
                                <br>
                                <span class="badge bg-primary">
                                    Ref ID: {{ $level->id }}
                                </span>
                            </p>
                            <p class="bg-theme text-center m-0">
                                {{ $referralTree[$i - 1]['commission_name'] }}
                                {{-- {{ $referralTree[$i - 1] }} --}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr class="divider">
    @endfor
</div>
{{-- @endif --}}

@push('styles')
@endpush

@push('scripts')
@endpush
