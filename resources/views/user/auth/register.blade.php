@extends('components.layouts.auth')

@section('content')
    <div class="s3-container">
        <div class="s3-page">
            <div>
                @if (!is_null(DiligentCreators('register_page_heading')))
                    <h2 class="page-heading">{{ DiligentCreators('register_page_heading') }}</h2>
                @else
                    <h2>Welcome to {{ config('app.name') }}</h2>
                @endif

                @if (!is_null(DiligentCreators('register_page_text')))
                    <div>
                        <p class="page-text">{{ DiligentCreators('register_page_text') }}</p>
                    </div>
                @endif
            </div>
        </div>
        {{-- /.s3-page --}}

        <div class="s3-authbox">
            <div class="container">
                <div class="row m-2">
                    {{-- Logo --}}
                    <div class="col-12 text-center">
                        <a href="{{ route('dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('storage/' . DiligentCreators('site_logo_small')) }}"
                                    alt="{{ DiligentCreators('site_name') }}" height="100">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('storage/' . DiligentCreators('site_logo_dark')) }}"
                                    alt="{{ DiligentCreators('site_name') }}" height="100">
                            </span>
                        </a>
                    </div>
                    {{-- /.col --}}
                    <div class="col-12 text-center">
                        <h2>Register</h2>
                    </div>
                    {{-- /.col --}}

                    {{-- User --}}
                    <div class="col-12 text-center">
                        <div id="userDetails"></div>
                    </div>
                    {{-- /.col --}}

                </div>
                {{-- /.row --}}

                <div class="mx-5">
                    <x-alert-message />
                </div>

                <form action="{{ route('register.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row mx-5">

                        <div class="col-12 mb-2">
                            <input type="text" name="name" class="form-control" placeholder="Your Name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <input class="form-control input-mask" name="email" data-inputmask="'alias':'email'"
                                placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <input type="password" name="confirm_password" class="form-control"
                                placeholder="Confirm Password" required>
                            @error('confirm_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-6 mb-2">
                            <input type="text" name="referral_code" id="referral_code" class="form-control"
                                placeholder="Referral Code" value="{{ old('referral_code') }}"
                                required>
                            @error('referral_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-2">
                            <input type="text" name="pin_code" class="form-control" placeholder="Pin Code"
                                value="{{ old('pin_code') }}" required>
                            @error('pin_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="terms" id="agree" required>
                                <label class="form-check-label" for="agree">
                                    I Accept <a href="">Terms and Conditions</a>
                                </label>
                            </div>
                            @error('terms')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>

                        <div class="col-12 mb-">
                            Already registered <a href="{{ route('login') }}">Login</a> here.
                        </div>
                    </div>
                </form>
            </div>
            {{-- /.container --}}
        </div>
        {{-- /.s3-authbox --}}
    </div>
    {{-- /.s3-container --}}
@endsection

@push('styles')
    @if (
        !is_null(DiligentCreators('register_page_heading_color')) ||
            !is_null(DiligentCreators('register_page_heading_bg_color')))
        <style>
            .page-heading {
                padding: 5px 10px;
                display: inline-block;
                color: {{ DiligentCreators('register_page_heading_color') }};
                background-color: {{ DiligentCreators('register_page_heading_bg_color') }};
            }
        </style>
    @endif
    @if (!is_null(DiligentCreators('register_page_text_color')) || !is_null(DiligentCreators('register_page_text_bg_color')))
        <style>
            .page-text {
                padding: 5px 10px;
                display: inline-block;
                color: {{ DiligentCreators('register_page_text_color') }};
                background-color: {{ DiligentCreators('register_page_text_bg_color') }};
            }
        </style>
    @endif
    @if (!is_null(DiligentCreators('register_page_image')))
        <style>
            .s3-page {
                background-image: url("{{ asset('storage/' . DiligentCreators('register_page_image')) }}");
                background-repeat: no-repeat;
                background-position: center center;
                background-size: cover;
            }
        </style>
    @endif
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".input-mask").inputmask();
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to get query parameter value by name
            function getQueryParameter(name) {
                let urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(name);
            }

            // Function to get cookie value by name
            function getCookie(name) {
                let cookieArr = document.cookie.split(';');
                for (let i = 0; i < cookieArr.length; i++) {
                    let cookiePair = cookieArr[i].split('=');
                    if (name === cookiePair[0].trim()) {
                        return decodeURIComponent(cookiePair[1]);
                    }
                }
                return null;
            }

            // Function to set a cookie
            function setCookie(name, value, days) {
                let expires = "";
                if (days) {
                    let date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            // Function to fetch user details using AJAX
            function fetchUserDetails(referralCode) {
                $.ajax({
                    url: "{{ route('get.referrer-user-date') }}",
                    type: "GET",
                    data: {
                        _token: "{{ csrf_token() }}",
                        referral_code: referralCode
                    },
                    success: function(response) {
                        // Check the status of the response
                        if (response.status === 'success') {
                            // Populate user details
                            $('#userDetails').html(
                                `<p><strong>${response.user.name}</strong> invited you.</p>`
                            );
                        } else {
                            // Display custom message for invalid referral code
                            $('#userDetails').html(
                                `<div class="alert alert-danger">${response.message}</div>`);
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#userDetails').html('<p>Error fetching user details. Please try again.</p>');
                    }
                });
            }

            // Get referral code from URL or cookie
            let referralCode = getQueryParameter('ref') || getCookie('referral_code');

            // If referral code is found in URL or cookie, populate input and fetch details
            if (referralCode) {
                $('#referral_code').val(referralCode);
                fetchUserDetails(referralCode);
                // Set the referral code in a cookie for future use (optional, based on your requirements)
                setCookie('referral_code', referralCode, 7); // Store for 7 days
            }

            // Trigger AJAX call on input change with debounce
            $('#referral_code').on('input', debounce(function() {
                referralCode = $(this).val();
                if (referralCode.trim() !== '') {
                    fetchUserDetails(referralCode);
                } else {
                    $('#userDetails').empty(); // Clear user details if input is empty
                }
            }, 300)); // 300 ms debounce delay

            // Debounce function to limit the rate of function calls
            function debounce(func, delay) {
                let debounceTimer;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => func.apply(context, args), delay);
                };
            }
        });
    </script>
@endpush
