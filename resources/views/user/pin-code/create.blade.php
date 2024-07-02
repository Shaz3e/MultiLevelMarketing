@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Create New Pin',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('dashboard')],
            ['text' => 'Pin Code List', 'link' => route('pins.index')],
            ['text' => 'Create', 'link' => null],
        ],
    ])

    {{-- Create Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('pins.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="amount-prepend">
                                                {{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}
                                            </span>
                                        </div>
                                        <input type="number" name="amount" id="amount" class="form-control"
                                            value="{{ old('amount') }}" placeholder="Enter Amount" aria-label="Amount"
                                            aria-describedby="amount" step="0.01" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="amount-append">
                                                {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @error('amount')
                                    <div><span class="text-danger">{{ $message }}</span></div>
                                @enderror
                            </div>
                            {{-- /.col --}}
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="pin_code">Generate Pin</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="pin_code" name="pin_code" class="form-control"
                                            placeholder="Generate Pin" aria-label="Generate Pin"
                                            aria-describedby="generate_pin" value="{{ old('pin_code', $pinCode) }}">
                                        <button class="btn btn-outline-primary" type="button"
                                            id="generate_pin">Generate</button>
                                    </div>
                                </div>
                                @error('pin')
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
@endpush

@push('scripts')
    <script>
        $('#generate_pin').on('click', function() {
            var button = $(this); // store the button element
            button.text('Generating...'); // change button text to "Generating..."
            $.ajax({
                type: 'GET',
                url: '{{ route('generate-pin') }}',
                success: function(response) {
                    button.text('Generated'); // change button text to "Generated"
                    $('#pin_code').val(response.pin_code);
                }
            });
        });
    </script>
@endpush
