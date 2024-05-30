@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Edit Pin',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'View List', 'link' => route('admin.pins.index')],
            ['text' => 'Edit', 'link' => null],
        ],
    ])

    {{-- Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.pins.update', $pin->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1-prepend">
                                                {{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}
                                            </span>
                                        </div>
                                        <input type="number" name="amount" id="amount" class="form-control"
                                            value="{{ old('amount', $pin->amount) }}" placeholder="Enter Amount" aria-label="Amount"
                                            aria-describedby="basic-addon1" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1-append">
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
                                    <label for="pin">Generate Pin</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="pin" name="pin" class="form-control" placeholder="Generate Pin"
                                            aria-label="Generate Pin" aria-describedby="generate_pin" value="{{ old('pin', $pin->pin) }}">
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
            $.ajax({
                type: 'GET',
                url: '{{ route('admin.generate-pin') }}',
                success: function(response) {
                    $('#pin').val(response.pin);
                }
            });
        });
    </script>
@endpush
