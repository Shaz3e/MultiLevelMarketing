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
        <div class="col-md-1 col-sm-12 mb-2">
            <select wire:model.live="createdBy" class="form-control form-control-sm form-control-border">
                <option value="" selected="selected">Filters</option>
                <option value="admin">Admin Pins</option>
                <option value="user">User Pins</option>
            </select>
        </div>
        {{-- /.col --}}
        <div class="col-md-1 col-sm-12 mb-2">
            <select wire:model.live="isUsed" class="form-control form-control-sm form-control-border">
                <option value="" selected="selected">Filters</option>
                <option value="0">Unused Pins</option>
                <option value="1">Used Pins</option>
            </select>
        </div>
        {{-- /.col --}}
        <div class="col-md-5 col-sm-12 mb-2">
            <input type="search" wire:model.live="search" class="form-control form-control-sm" placeholder="Search...">
        </div>
        {{-- .col --}}
        <div class="col-md-2 col-sm-12 mb-2">
            <div class="d-grid">
                <a href="{{ route('admin.pins.create') }}" class="btn btn-success btn-sm waves-effect waves-light">
                    <i class="ri-add-fill align-middle me-2"></i> Create
                </a>
            </div>
        </div>
        {{-- /.col --}}
        <div class="col-md-2 col-sm-12 mb-2">
            <select wire:model.live="showDeleted" class="form-control form-control-sm form-control-border">
                <option value="" selected="selected">Filters</option>
                <option value="">Show Active Record</option>
                <option value="true">Show Deleted Record</option>
            </select>
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
                                    <th style="width: 10%">Created By</th>
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
                                            @if ($pin->user_id)
                                                {{ $pin->user->name }}
                                            @endif
                                            @if ($pin->admin_id)
                                                {{ $pin->admin->name }}
                                            @endif
                                        </td>
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
                                                <a href="{{ route('admin.users.show', $pin->used_by) }}">
                                                    {{ $pin->usedBy->name }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @if ($showDeleted)
                                                @can('pin-code.restore')
                                                    <button wire:click="confirmRestore({{ $pin->id }})"
                                                        class="btn btn-sm btn-outline-info" data-toggle="modal"
                                                        data-target="#deleteModal">
                                                        <i class="ri-arrow-go-back-line"></i>
                                                    </button>
                                                @endcan
                                                @can('pin-code.force.delete')
                                                    <button wire:click="confirmForceDelete({{ $pin->id }})"
                                                        class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                                        data-target="#deleteModal">
                                                        <i class="ri-delete-bin-7-line"></i>
                                                    </button>
                                                @endcan
                                            @else
                                                @can('pin-code.read')
                                                    <a href="{{ route('admin.pins.show', $pin->id) }}"
                                                        class="btn btn-sm btn-outline-info">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                @endcan
                                                @can('pin-code.update')
                                                    <a href="{{ route('admin.pins.edit', $pin->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                @endcan
                                                @can('pin-code.delete')
                                                    <button wire:click="confirmDelete({{ $pin->id }})"
                                                        class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                                        data-target="#deleteModal">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                @endcan
                                            @endif
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

@script
    <script>
        // Error
        document.addEventListener('error', () => {
            Toast.fire({
                icon: 'error',
                title: "Record not found",
            })
        })

        // Show Delete Confirmation
        document.addEventListener('showDeleteConfirmation', () => {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this record!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch('deleteConfirmed');
                    Swal.fire({
                        title: "Deleted!",
                        text: "The record has been deleted.",
                        icon: "success"
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'This record is safe :)',
                        'error'
                    );
                }
            });
        })

        // Show Restore Confirmation
        document.addEventListener('confirmRestore', () => {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to restore this record!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, restore it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch('restored');
                    Swal.fire({
                        title: "Restored!",
                        text: "The record has been restored.",
                        icon: "success"
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'This record is still deleted :)',
                        'error'
                    );
                }
            });
        })

        // Show Force Delete Confirmation
        document.addEventListener('confirmForceDelete', () => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch('forceDeleted');
                    Swal.fire({
                        title: "Deleted!",
                        text: "The record has been deleted.",
                        icon: "success"
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'This record is deleted but can be restore later :)',
                        'error'
                    );
                }
            });
        })
    </script>
@endscript
