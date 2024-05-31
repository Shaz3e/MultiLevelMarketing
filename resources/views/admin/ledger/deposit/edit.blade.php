@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Edit Transaction',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'Deposit List', 'link' => route('admin.ledger.deposits.index')],
            ['text' => 'Edit', 'link' => null],
        ],
    ])

    {{-- Create Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.ledger.deposits.update', $deposit) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user_id">Select User</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">Select</option>
                                        @if ($deposit->user)
                                            <option value="{{ $deposit->user_id }}" selected>
                                                {{ $deposit->user->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="payment_method_id">Select Payment Method</label>
                                    <select name="payment_method_id" id="payment_method_id" class="form-control">
                                        <option value="">Select</option>
                                        @if ($deposit->payment_method_id)
                                            <option value="{{ $deposit->payment_method_id }}" selected>
                                                {{ $deposit->paymentMethod->name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                @error('payment_method_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="deposit">Amount</label>
                                    <input type="text" class="form-control" id="deposit" name="deposit"
                                        value="{{ old('deposit', $deposit->deposit) }}" required>
                                </div>
                                @error('deposit')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status_name">Status</label>
                                    <select name="status" id="status_name" class="form-control">
                                        @foreach ($ledgerStatuses as $status)
                                            <option value="{{ $status }}" {{ $status == $deposit->status ? ' selected' : ''}}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('status')
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
    <script>
        $(document).ready(function() {
            // Initialize select2
            $('.select2').select2();

            // Search Users
            $('#user_id').select2({
                ajax: {
                    url: '{{ route('admin.search.users') }}',
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
            // Search Payment Method
            $('#payment_method_id').select2({
                ajax: {
                    url: '{{ route('admin.search.payment-methods') }}',
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
        });
    </script>
@endpush
