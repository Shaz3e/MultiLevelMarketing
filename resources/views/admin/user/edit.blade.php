@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Edit User',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'Users', 'link' => route('admin.users.index')],
            ['text' => 'Create', 'link' => null],
        ],
    ])

    {{-- Create Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" id="email" class="form-control input-mask"
                                        data-inputmask="'alias': 'email'" value="{{ old('email', $user->email) }}" required>
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password"
                                            value="{{ old('password') }}" minlength="8" maxlength="64" />
                                        <div class="input-group-append">
                                            <button type="button" id="generatePasswordBtn"
                                                class="btn btn-outline-primary">Generate</button>
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="pin_code">Pin Code</label>
                                    <div class="input-group">
                                        <input type="text" id="pin_code" name="pin_code" class="form-control"
                                            placeholder="Check Pin" aria-label="Check Pin" aria-describedby="check_pin"
                                            value="{{ old('pin_code', $user->pin_code) }}">
                                        <button class="btn btn-outline-primary" type="button" id="check_pin">Check</button>
                                    </div>
                                    <span id="pinStatus"></span>
                                </div>
                                @error('pin_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="company_id">Company
                                        <small><a href="{{ route('admin.companies.create') }}">
                                                Create New</a></small>
                                    </label>
                                    <select name="company_id" id="company_id" class="form-control">
                                        <option value="">Select</option>
                                        @if ($user->company_id)
                                            <option value="{{ $user->company_id }}" selected>{{ $user->company->name }}</option>
                                        @endif
                                    </select>
                                </div>
                                @error('company_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        value="{{ old('phone', $user->phone) }}" required>
                                </div>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        value="{{ old('address', $user->address) }}" required>
                                </div>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            {{-- <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" id="country" class="form-control"
                                        value="{{ old('country', $user->country) }}" required>
                                </div>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            {{-- /.col --}}
                            {{-- <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" name="state" id="state" class="form-control"
                                        value="{{ old('state', $user->state) }}" required>
                                </div>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            {{-- /.col --}}
                            {{-- <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" class="form-control"
                                        value="{{ old('city', $user->city) }}" required>
                                </div>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="zip_code">Zip Code</label>
                                    <input type="text" name="zip_code" id="zip_code" class="form-control"
                                        value="{{ old('zip_code', $user->zip_code) }}" required>
                                </div>
                                @error('zip_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="is_email_verified">Email Verified?</label>
                                    <select name="is_email_verified" id="is_email_verified" class="form-control"
                                        value="{{ old('is_email_verified') }}" required>
                                        <option value="1" {{ old('is_email_verified', $user->is_email_verified) == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_email_verified', $user->is_email_verified) == 0 ? 'selected' : '' }} selected>No</option>
                                    </select>
                                </div>
                                @error('is_email_verified')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="is_phone_verified">Phone Verified?</label>
                                    <select name="is_phone_verified" id="is_phone_verified" class="form-control"
                                        value="{{ old('is_phone_verified') }}" required>
                                        <option value="1" {{ old('is_phone_verified', $user->is_phone_verified) == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_phone_verified', $user->is_phone_verified) == 1 ? 'selected' : '' }} selected>No</option>
                                    </select>
                                </div>
                                @error('is_phone_verified')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="is_kyc_verified">KYC Verified?</label>
                                    <select name="is_kyc_verified" id="is_kyc_verified" class="form-control"
                                        value="{{ old('is_kyc_verified') }}" required>
                                        <option value="1" {{ old('is_kyc_verified', $user->is_kyc_verified) == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_kyc_verified', $user->is_kyc_verified) == 1 ? 'selected' : '' }} selected>No</option>
                                    </select>
                                </div>
                                @error('is_kyc_verified')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="is_active">Can Login?</label>
                                    <select name="is_active" id="is_active" class="form-control"
                                        value="{{ old('is_active') }}" required>
                                        <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }} selected>No</option>
                                    </select>
                                </div>
                                @error('is_active')
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
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        // Input mask
        $(document).ready(function() {
            $('.select2').select2();
            $(".input-mask").inputmask();

            // Search Companies
            $('#company_id').select2({
                ajax: {
                    url: '{{ route('admin.search.companies') }}',
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: function(params) {
                        return {
                            term: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results
                        };
                    }
                },
                minimumInputLength: 3
            });

            // Check Pin Code via Ajax
            $('#check_pin').on('click', function(e) {
                e.preventDefault();
                let pinCode = $('#pin_code').val();
                $.ajax({
                    url: `{{ route('admin.check-pin') }}`,
                    type: 'GET',
                    data: {
                        pin_code: pinCode
                    },
                    success: function(result) {
                        // Update success message #pinStatus
                        // $('#pinStatus').html(result.message);
                        if (result.success) {
                            $('#pinStatus').html('<span style="color: green;">' + result
                                .message + '</span>');
                        } else {
                            $('#pinStatus').html('<span style="color: red;">' + result.message +
                                '</span>');
                        }
                    }
                });
            });


            // Generate Password
            $('#generatePasswordBtn').click(function(e) {
                let characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                let result = '';
                for (let i = 0; i < 8; i++) {
                    result += characters.charAt(Math.floor(Math.random() * characters.length));
                }
                $("#password").val(result);
            });
        });
    </script>
@endpush
