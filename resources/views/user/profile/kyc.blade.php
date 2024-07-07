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
                                        <label for="id_type">Select Verification Type</label>
                                        <select name="id_type" id="id_type" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="CNIC" {{ request()->get('type') == 'CNIC' ? 'selected' : '' }}>
                                                CNIC</option>
                                            <option value="Passport"
                                                {{ request()->get('type') == 'Passport' ? 'selected' : '' }}>Passport
                                            </option>
                                            <option value="Driving_License"
                                                {{ request()->get('type') == 'Driving_License' ? 'selected' : '' }}>Driving
                                                License Number</option>
                                        </select>
                                    </div>
                                    @error('id_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                                @if (request()->get('type') == 'CNIC')
                                    <div id="cnic_section">
                                        @include('user.profile.verification-type.cnic')
                                    </div>
                                @elseif (request()->get('type') == 'Passport')
                                    <div id="passport_section">
                                        @include('user.profile.verification-type.passport')
                                    </div>
                                @elseif (request()->get('type') == 'Driving_License')
                                    <div id="driving_license_section">
                                        @include('user.profile.verification-type.driving_license')
                                    </div>
                                @endif

                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="address_proof_type">Select Proof Type</label>
                                        <select name="address_proof_type" id="address_proof_type" class="form-control"
                                            required>
                                            <option value="Utility Bill">Utility Bill</option>
                                            <option value="Bank Statement">Bank Statement</option>
                                        </select>
                                    </div>
                                    @error('address_proof_type')
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
                <p>Only JPG, PNG, DOC, DOCX, PDF file formats are accepted with max filesize 5MB</p>
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
    <style>
        /* Optional: Basic styling to hide elements initially */
        #cnic,
        #passport,
        #driving_license {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        // Input mask
        $(document).ready(function() {
            $(".input-mask").inputmask()
        });
    </script>

    <script>
        $(document).ready(function() {
            // Show the correct form section based on the query parameter
            var type = new URLSearchParams(window.location.search).get('type');
            if (type) {
                $('#' + type.toLowerCase() + '_section').show();
            }

            // Reload the page with the selected option as a query parameter
            $('#id_type').change(function() {
                var selectedType = $(this).val();
                if (selectedType) {
                    window.location.href = '?type=' + selectedType;
                }
            });
        });
    </script>
@endpush
