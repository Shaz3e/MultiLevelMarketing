@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Create Payment Method',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => route('admin.payment-methods.index')],
            ['text' => 'Create', 'link' => null],
        ],
    ])

    {{-- Create Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.payment-methods.update', $paymentMethod->id) }}" method="POST"
                    class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="icon">Payment Icon
                                        @if ($paymentMethod->icon)
                                            <a class="payment-method-icon-lightbox"
                                                href="{{ asset('storage/' . $paymentMethod->icon) }}">
                                                <img src="{{ asset('storage/' . $paymentMethod->icon) }}"
                                                    style="height: 20px;" class="img-fluid" loading="lazy"
                                                    decoding="async" />
                                            </a>
                                        @endif
                                    </label>
                                    <input type="file" id="icon" name="icon" class="form-control">
                                </div>
                                @error('icon')
                                    <div><span class="text-danger">{{ $message }}</span></div>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Payment Method</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ old('name', $paymentMethod->name) }}" required>
                                </div>
                                @error('name')
                                    <div><span class="text-danger">{{ $message }}</span></div>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="payment_detail">Payment Details</label>
                                    <input type="text" id="payment_detail" name="payment_detail" class="form-control"
                                        value="{{ old('payment_detail', $paymentMethod->payment_detail) }}" required>
                                </div>
                                @error('payment_detail')
                                    <div><span class="text-danger">{{ $message }}</span></div>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="1" {{ old('is_active', $paymentMethod->is_active) == 1 ? 'selected' : '' }}>Enable</option>
                                        <option value="0" {{ old('is_active', $paymentMethod->is_active) == 0 ? 'selected' : '' }}>Disable
                                        </option>
                                    </select>
                                </div>
                                @error('is_active')
                                    <div><span class="text-danger">{{ $message }}</span></div>
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
