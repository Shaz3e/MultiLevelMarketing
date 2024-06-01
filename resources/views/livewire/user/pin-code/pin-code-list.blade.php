<div>
    <div class="row mb-3">
        <div class="col-md-1 col-sm-12 mb-2">
            <select wire:model.live="perPage" class="form-control form-control-sm form-control-border">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        {{-- /.col --}}
        <div class="col-md-2 col-sm-12 mb-2">
            <select wire:model.live="isUsed" class="form-control form-control-sm form-control-border">
                <option value="" selected="selected">Filters</option>
                <option value="0">Unused Pins</option>
                <option value="1">Used Pins</option>
            </select>
        </div>
        {{-- /.col --}}
        <div class="col-md-7 col-sm-12 mb-2">
            <input type="search" wire:model.live="search" class="form-control form-control-sm" placeholder="Search...">
        </div>
        {{-- .col --}}
        <div class="col-md-2 col-sm-12 mb-2">
            <div class="d-grid">
                <a href="{{ route('pins.create') }}" class="btn btn-success btn-sm waves-effect waves-light">
                    <i class="ri-add-fill align-middle me-2"></i> Create
                </a>
            </div>
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Created On</th>
                                    <th style="width: 10%">Amount</th>
                                    <th style="width: 10%">Pin</th>
                                    <th style="width: 10%">Status</th>
                                    <th style="width: 10%">Used At</th>
                                    <th style="width: 10%">Used By</th>
                                    <th style="width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pinCodes as $pin)
                                    <tr>
                                        <td>
                                            {{ $pin->created_at->diffForHumans() }}
                                            <small class="d-block">{{ $pin->created_at->format('l, F j, Y') }}</small>
                                        </td>
                                        <td>
                                            {{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}
                                            {{ $pin->amount }}
                                        </td>
                                        <td>{{ $pin->pin_code }}</td>
                                        <td>
                                            @if ($pin->is_used)
                                                <span class="badge bg-success">Used</span>
                                            @else
                                                <span class="badge bg-danger">Unused</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pin->used_at)
                                                {{ $pin->used_at->diffForHumans() }}
                                                <small class="d-block">{{ $pin->used_at->format('l, F j, Y') }}</small>
                                            @else
                                                <small>Never</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pin->used_by)
                                                {{ $pin->usedBy->name }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('pins.show', $pin->id) }}"
                                                class="btn btn-sm btn-outline-info">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- /.table-responseive --}}
                    {{ $pinCodes->links() }}
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
</div>
@push('styles')
@endpush

@push('scripts')
@endpush
