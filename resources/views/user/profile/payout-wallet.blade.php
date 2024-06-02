@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Update My Payout Wallet',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('dashboard')],
            ['text' => 'My Profile', 'link' => route('profile')],
            ['text' => 'My Payout Wallet', 'link' => null],
        ],
    ])

    @if ($user->is_kyc_verified)
        <div class="row">
            {{-- Easypaisa --}}
            <div class="col-4">
                <form action="{{ route('profile.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card" style="height: calc(100% - 30px)">
                        <div class="card-body">
                            <h4 class="card-title">Add Easypaisa Account</h4>
                            <h6 class="card-subtitle font-14 text-muted">Easypaisa account should be active. Account title
                                should be matched as per your KYC documents.</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="easypaisa_account_title">Account Title</label>
                                        <input type="text" name="easypaisa_account_title" id="easypaisa_account_title"
                                            class="form-control"
                                            value="{{ old('easypaisa_account_title', $user->payout ? $user->payout->easypaisa_account_title : '') }}">
                                    </div>
                                    @error('easypaisa_account_title')
                                        <div><span class="text-danger">{{ $message }}</span></div>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="easypaisa_account_number">Easypaisa Number</label>
                                        <input type="text" name="easypaisa_account_number" id="easypaisa_account_number"
                                            class="form-control"
                                            value="{{ old('easypaisa_account_number', $user->payout ? $user->payout->easypaisa_account_number : '') }}">
                                    </div>
                                    @error('easypaisa_account_number')
                                        <div><span class="text-danger">{{ $message }}</span></div>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                            </div>
                            {{-- /.row --}}
                        </div>
                        {{-- /.card-body --}}
                        <div class="card-footer">
                            <x-form.button name="updateEasyPaisaWallet" text="Update Easypaisa" icon="ri-save-line" />
                        </div>
                        {{-- /.card-footer --}}
                    </div>
                    {{-- /.card --}}
                </form>
            </div>
            {{-- /.col --}}

            {{-- JassCash --}}
            <div class="col-4">
                <form action="{{ route('profile.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card" style="height: calc(100% - 30px)">
                        <div class="card-body">
                            <h4 class="card-title">Add JazzCash Account</h4>
                            <h6 class="card-subtitle font-14 text-muted">JazzCash account should be active. Account title
                                should be matched as per your KYC documents.</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="jazzcash_account_title">Account Title</label>
                                        <input type="text" name="jazzcash_account_title" id="jazzcash_account_title"
                                            class="form-control"
                                            value="{{ old('jazzcash_account_title', $user->payout ? $user->payout->jazzcash_account_title : '') }}">
                                    </div>
                                    @error('jazzcash_account_title')
                                        <div><span class="text-danger">{{ $message }}</span></div>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="jazzcash_account_number">JazzCash Number</label>
                                        <input type="text" name="jazzcash_account_number" id="jazzcash_account_number"
                                            class="form-control"
                                            value="{{ old('jazzcash_account_number', $user->payout ? $user->payout->jazzcash_account_number : '') }}">
                                    </div>
                                    @error('jazzcash_account_number')
                                        <div><span class="text-danger">{{ $message }}</span></div>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                            </div>
                            {{-- /.row --}}
                        </div>
                        {{-- /.card-body --}}
                        <div class="card-footer">
                            <x-form.button name="updateJazzCashWallet" text="Update JazzCash" icon="ri-save-line" />
                        </div>
                        {{-- /.card-footer --}}
                    </div>
                    {{-- /.card --}}
                </form>
            </div>
            {{-- /.col --}}

            {{-- Bank Account --}}
            <div class="col-4">
                <form action="{{ route('profile.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card" style="height: calc(100% - 30px)">
                        <div class="card-body">
                            <h4 class="card-title">Add Bank Account</h4>
                            <h6 class="card-subtitle font-14 text-muted">Account title should be matched as per your KYC
                                documents.</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="bank_account_name">Bank Name</label>
                                        {{-- <input type="text" name="bank_account_name" id="bank_account_name"
                                            class="form-control"
                                            value="{{ old('bank_account_name', $user->payout ? $user->payout->bank_account_name : '') }}"> --}}
                                        <select name="bank_account_name" id="bank_account_name"
                                            class="form-control select2">
                                            <option>Bank Name</option>
                                            @foreach ($user->payout->bankList() as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $user->payout->bank_account_name == $value ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('bank_account_name')
                                        <div><span class="text-danger">{{ $message }}</span></div>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="bank_account_title">Account Title</label>
                                        <input type="text" name="bank_account_title" id="bank_account_title"
                                            class="form-control"
                                            value="{{ old('bank_account_title', $user->payout ? $user->payout->bank_account_title : '') }}">
                                    </div>
                                    @error('bank_account_title')
                                        <div><span class="text-danger">{{ $message }}</span></div>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="bank_account_number">IBAN Number</label>
                                        <input type="text" name="bank_account_number" id="bank_account_number"
                                            class="form-control"
                                            value="{{ old('bank_account_number', $user->payout ? $user->payout->bank_account_number : '') }}">
                                    </div>
                                    @error('bank_account_number')
                                        <div><span class="text-danger">{{ $message }}</span></div>
                                    @enderror
                                </div>
                                {{-- /.col --}}
                            </div>
                            {{-- /.row --}}
                        </div>
                        {{-- /.card-body --}}
                        <div class="card-footer">
                            <x-form.button name="updateBankAccountWallet" text="Update Bank Account"
                                icon="ri-save-line" />
                        </div>
                        {{-- /.card-footer --}}
                    </div>
                    {{-- /.card --}}
                </form>
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
    @else
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    Please complete your KYC before adding payout details. Click the button below to complete your KYC
                </div>
                <a class="btn btn-primary btn-sm waves-effect waves-light" href="{{ route('profile.kyc') }}">
                    <i class="ri-file-list-3-line align-middle me-2"></i> Update KYC
                </a>
            </div>
        </div>
        {{-- /.row --}}
    @endif
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
            $("#easypaisa_account_number").inputmask({
                mask: "929999999999",
                placeholder: "__________",
                greedy: false
            });
            $("#jazzcash_account_number").inputmask({
                mask: "929999999999",
                placeholder: "__________",
                greedy: false
            });
            $("#bank_account_number").inputmask({
                mask: "PK99AAAA9999999999999999",
                placeholder: "____________________",
                greedy: false
            });
        });
    </script>
@endpush
