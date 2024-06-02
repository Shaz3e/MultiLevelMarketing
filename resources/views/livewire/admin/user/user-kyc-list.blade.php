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
        <div class="col-md-7 col-sm-12 mb-2">
            <input type="search" wire:model.live="search" class="form-control form-control-sm" placeholder="Search...">
        </div>
        {{-- .col --}}
        <div class="col-md-2 col-sm-12 mb-2">
            <div class="d-grid">
                <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-sm waves-effect waves-light">
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

                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>ID Number</th>
                                <th>ID Proof Front</th>
                                <th>ID Proof Back</th>
                                <th>Address Proof</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr wire:key="{{ $user->id }}">
                                    <td>
                                        Name: <a href="{{ route('admin.users.show', $user->id) }}"><strong class="d-block">{{ $user->name }}</strong></a>
                                        email: <strong class="d-block">{{ $user->email }}</strong>
                                        phone: <strong class="d-block">{{ $user->phone }}</strong>
                                    </td>
                                    <td>{{ $user->userKyc->id_number }}</td>
                                    <td>
                                        @if ($user->userKyc->id_proof_front)
                                            <a href="{{ asset('storage/' . $user->userKyc->id_proof_front) }}"
                                                class="image-popup-no-margins">
                                                <img src="{{ asset('storage/' . $user->userKyc->id_proof_front) }}"
                                                    alt="{{ $user->userKyc->name }}" class="img-fluid avatar-sm">
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->userKyc->id_proof_back)
                                            <a href="{{ asset('storage/' . $user->userKyc->id_proof_back) }}"
                                                class="image-popup-no-margins">
                                                <img src="{{ asset('storage/' . $user->userKyc->id_proof_back) }}"
                                                    alt="{{ $user->userKyc->name }}" class="img-fluid avatar-sm">
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->userKyc->address_proof)
                                            <a href="{{ asset('storage/' . $user->userKyc->address_proof) }}"
                                                class="image-popup-no-margins">
                                                <img src="{{ asset('storage/' . $user->userKyc->address_proof) }}"
                                                    alt="{{ $user->userKyc->name }}" class="img-fluid avatar-sm">
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" wire:change="toggleStatus({{ $user->id }})"
                                            id="is_kyc_verified{{ $user->id }}" switch="bool"
                                            {{ $user->is_kyc_verified ? 'checked' : '' }} />
                                        <label for="is_kyc_verified{{ $user->id }}" data-on-label="Yes"
                                            data-off-label="No"></label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
</div>
@push('styles')
    <!-- Lightbox css -->
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <!-- Magnific Popup-->
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- lightbox init js-->
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
@endpush
@script
    <script>
        // Status Changed
        document.addEventListener('statusChanged', () => {
            Toast.fire({
                icon: 'success',
                title: "Status has been updated successfully",
            })
        })

        // Error
        document.addEventListener('error', () => {
            Toast.fire({
                icon: 'error',
                title: "Record not found",
            })
        })
    </script>
@endscript
