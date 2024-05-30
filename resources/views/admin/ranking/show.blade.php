@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'View Ranking',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => route('admin.rankings.index')],
            ['text' => 'Edit', 'link' => null],
        ],
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td>Icon</td>
                                <td>
                                    @if ($ranking->icon)
                                        <a class="rank-icon-lightbox" href="{{ asset('storage/' . $ranking->icon) }}">
                                            <img src="{{ asset('storage/' . $ranking->icon) }}" class="img-fluid"
                                                loading="lazy" decoding="async" />
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Level</td>
                                <td>{{ $ranking->level }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $ranking->name }}</td>
                            </tr>
                            <tr>
                                <td>Bonus Point</td>
                                <td>{{ currencyFormat($ranking->bonus_point, 0) }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if ($ranking->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Reward</td>
                                <td>{{ $ranking->reward }}</td>
                            </tr>
                            <tr>
                                <td>Reward Image</td>
                                <td>
                                    @if ($ranking->reward_image)
                                        <a class="rank-icon-lightbox" href="{{ asset('storage/' . $ranking->reward_image) }}">
                                            <img src="{{ asset('storage/' . $ranking->reward_image) }}" class="img-fluid"
                                                loading="lazy" decoding="async" />
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    {{-- /.table-responsive --}}
                </div>
                {{-- /.card-body --}}
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
