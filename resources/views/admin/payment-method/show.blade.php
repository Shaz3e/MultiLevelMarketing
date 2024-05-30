@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'View Payment Method',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => route('admin.payment-methods.index')],
            ['text' => 'View', 'link' => null],
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
                                    @if ($paymentMethod->icon)
                                        <a class="payment-method-icon-lightbox"
                                            href="{{ asset('storage/' . $paymentMethod->icon) }}">
                                            <img src="{{ asset('storage/' . $paymentMethod->icon) }}"
                                                class="img-fluid" loading="lazy" decoding="async" />
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Payment Method Name</td>
                                <td>{{ $paymentMethod->name }}</td>
                            </tr>
                            <tr>
                                <td>Payment Method Details</td>
                                <td>{{ $paymentMethod->payment_detail }}</td>
                            </tr>
                            <tr>
                                <td>Created On</td>
                                <td>{{ $paymentMethod->created_at->format('l, F j, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <td>Updated On</td>
                                <td>{{ $paymentMethod->updated_at->format('l, F j, Y h:i A') }}</td>
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

    {{-- Edit Button --}}
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.payment-methods.edit', $paymentMethod->id) }}" class="btn btn-primary btn-sm">
                <i class="ri-pencil-line align-middle me-1"></i> Edit
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $(".payment-method-icon-lightbox").magnificPopup({
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
        })
    </script>
@endpush