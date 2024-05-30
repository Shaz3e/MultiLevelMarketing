@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Edit Ranking',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => route('admin.rankings.index')],
            ['text' => 'Edit', 'link' => null],
        ],
    ])

    {{-- Edit Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.rankings.update', $ranking->id) }}" method="POST" class="needs-validation"
                    novalidate enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label for="icon">
                                        Icon
                                        @if ($ranking->icon)
                                            <a class="rank-icon-lightbox" href="{{ asset('storage/' . $ranking->icon) }}">
                                                <img src="{{ asset('storage/' . $ranking->icon) }}" style="height: 20px;"
                                                    class="img-fluid" loading="lazy" decoding="async" />
                                            </a>
                                        @endif
                                    </label>
                                    <input type="file" name="icon" id="icon" class="form-control"
                                        value="{{ old('icon') }}">
                                </div>
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-1 col-sm-12">
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <input type="number" name="level" id="level" class="form-control"
                                        value="{{ old('level', $ranking->level) }}" min="1" max="99" required>
                                </div>
                                @error('level')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $ranking->name) }}" maxlength="255" required>
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="bonus_point">Bonus Points</label>
                                    <input type="number" name="bonus_point" id="bonus_point" class="form-control"
                                        value="{{ old('bonus_point', $ranking->bonus_point) }}" maxlength="7" required>
                                </div>
                                @error('bonus_point')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select id="is_active" name="is_active" class="form-control">
                                        <option value="1"
                                            {{ old('is_active', $ranking->is_active) == 1 ? 'selected' : '' }}>Enable
                                        </option>
                                        <option value="0"
                                            {{ old('is_active', $ranking->is_active) == 0 ? 'selected' : '' }}>Disabled
                                        </option>
                                    </select>
                                </div>
                                @error('is_active')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}

                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label for="reward">Reward</label>
                                    <input type="text" name="reward" id="reward" class="form-control"
                                        value="{{ old('reward', $ranking->reward) }}" maxlength="255">
                                </div>
                                @error('reward')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="reward_image">Reward Image

                                        @if ($ranking->reward_image)
                                            <a class="rank-reward-image-lightbox" href="{{ asset('storage/' . $ranking->reward_image) }}">
                                                <img src="{{ asset('storage/' . $ranking->reward_image) }}" style="height: 20px;"
                                                    class="img-fluid" loading="lazy" decoding="async" />
                                            </a>
                                        @endif
                                    </label>
                                    <input type="file" name="reward_image" id="reward_image" class="form-control"
                                        value="{{ old('reward_image') }}">
                                </div>
                                @error('reward_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer">
                        <x-form.button />
                        <x-form.button-save-view />
                        <x-form.button-save-create-new />
                    </div>
                    {{-- /.card-footer --}}
                </form>
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
@endsection

@push('styles')
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- lightbox init js-->
    <script>
        $(".rank-icon-lightbox").magnificPopup({
            type: "image",
            closeOnContentClick: !0,
            closeBtnInside: !1,
            fixedContentPos: !0,
            mainClass: "mfp-no-margins mfp-with-zoom",
            image: {
                verticalFit: !0
            },
            zoom: {
                enabled: !0,
                duration: 300
            }
        });
        $(".rank-reward-image-lightbox").magnificPopup({
            type: "image",
            closeOnContentClick: !0,
            closeBtnInside: !1,
            fixedContentPos: !0,
            mainClass: "mfp-no-margins mfp-with-zoom",
            image: {
                verticalFit: !0
            },
            zoom: {
                enabled: !0,
                duration: 300
            }
        });
    </script>
@endpush
