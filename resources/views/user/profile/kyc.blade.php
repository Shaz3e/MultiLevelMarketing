@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Update KYC',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('dashboard')],
            ['text' => 'My Profile', 'link' => route('profile')],
            ['text' => 'My KYC', 'link' => null],
        ],
    ])

    @if ($user->is_kyc_verified)
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    Your KYC is already approved.
                </div>
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
    @else
        <div class="row">
            <div class="col-4">
                <form action="{{ route('profile.store') }}" method="POST" class="needs-validation" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="id_number">ID Number</label>
                                        <input type="text" name="id_number" id="id_number" class="form-control"
                                            value="{{ old('id_number') }}" required>
                                    </div>
                                    @error('id_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="id_proof_front">ID Proof Front</label>
                                        <input type="file" name="id_proof_front" id="id_proof_front" class="form-control"
                                            value="{{ old('id_proof_front') }}" required>
                                    </div>
                                    @error('id_proof_front')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="id_proof_back">ID Proof Back</label>
                                        <input type="file" name="id_proof_back" id="id_proof_back" class="form-control"
                                            value="{{ old('id_proof_back') }}" required>
                                    </div>
                                    @error('id_proof_back')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="address_proof">Proof of Address</label>
                                        <input type="file" name="address_proof" id="address_proof" class="form-control"
                                            value="{{ old('address_proof') }}" required>
                                    </div>
                                    @error('address_proof')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                            </div>
                            {{-- /.row --}}
                        </div>
                        {{-- /.card-body --}}
                        <div class="card-footer">
                            <x-form.button name="updateKyc" text="Update KYC" icon="ri-save-line" />
                        </div>
                    </div>
                    {{-- /.card --}}
                </form>
            </div>
            {{-- /.col --}}
            <div class="col-8">
                <strong>Uploaded Document</strong>
                <p>Make sure the document shows your photo, full name, date of birth and date of issue</p>
                <p>Only JPG and PNG file formats are accepted with max filesize 2MB</p>
                <img src="{{ asset('assets/images/id-card-sample.jpg') }}" />
                <p>
                <ul>
                    <li>Photo should be clear</li>
                    <li>Good Photo Quality</li>
                    <li>All 4 corners are visible</li>
                </ul>
                </p>
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
    @endif
@endsection

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        // Input mask
        $(document).ready(function() {
            $(".input-mask").inputmask()
        });
    </script>
@endpush
