@extends('components.layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'User Profile',
        'breadcrumbs' => [
            ['text' => 'Dashboard', 'link' => route('admin.dashboard')],
            ['text' => 'Users', 'link' => route('admin.users.index')],
            ['text' => 'User Profile', 'link' => null],
        ],
    ])

    {{-- Show Record --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Full Name</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Referral Code</td>
                                <td>{{ $user->referral_code }}</td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td>
                                    @if ($user->company != null)
                                        <a href="{{ route('admin.companies.show', $user->company->id) }}">
                                            {{ $user->company->name }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if ($user->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>{{ $user->country }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>{{ $user->state }}</td>
                            <tr>
                                <td>City</td>
                                <td>{{ $user->city }}</td>
                            </tr>
                            <tr>
                                <td>Zip Code</td>
                                <td>{{ $user->zip_code }}</td>
                            </tr>
                            <tr>
                                <td>Email Verified</td>
                                <td>
                                    @if ($user->is_email_verified)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Phone Verified</td>
                                <td>
                                    @if ($user->is_phone_verified)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>KYC Verified</td>
                                <td>
                                    @if ($user->is_kyc_verified)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Can Login</td>
                                <td>
                                    @if ($user->is_active)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>{{ $user->created_at->format('l, F j, Y') }}</td>
                            </tr>
                            <tr>
                                <td>Updated At</td>
                                <td>{{ $user->updated_at->format('l, F j, Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    {{-- /.table-responsive --}}

                    <a href="{{ route('admin.users.edit', $user) }}">Edit</a>
                </div>
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}

    {{-- Show Recent Support Tickets --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Recent Support Tickets</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ticket#</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->supportTickets()->latest()->take(5)->get() as $ticket)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.support-tickets.show', $ticket->id) }}">
                                                {{ $ticket->ticket_number }}
                                            </a>
                                        </td>
                                        <td>{{ $ticket->title }}</td>
                                        <td>
                                            <span class="badge"
                                                style="background-color: {{ $ticket->status->bg_color }}; color:{{ $ticket->status->text_color }};">

                                                {{ $ticket->status->name }}
                                            </span>
                                        </td>
                                        <td>{{ $ticket->created_at->format('l, F j, Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.support-tickets.show', $ticket->id) }}"
                                                class="btn btn-sm btn-outline-info">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- /.table-responsive --}}
                </div>
                {{-- /.card-body --}}
                <div class="card-footer">
                    <a href="{{ route('admin.support-tickets.index') }}?searchUser={{ $user->email }}&filterByStatusTickets="
                        class="btn btn-sm btn-outline-info">
                        View All Support Tickets
                    </a>
                </div>
                {{-- /.card-footer --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}

    @hasanyrole(['superadmin', 'developer'])
        {{-- Show Audit History --}}
        @if (count($audits) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Audit History</h4>
                        </div>
                        {{-- /.card-header --}}

                        <div class="card-body">
                            <table class="table" id="#audit-log-table">
                                <thead>
                                    <tr>
                                        <th>Audit</th>
                                        <th>IP</th>
                                        <th>Modified At</th>
                                        <th>Records</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($audits as $audit)
                                        <tr>
                                            <td></td>
                                            <td>{{ $audit->ip_address }}</td>
                                            <td>{{ $audit->created_at }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm waves-effect waves-light show-audit-modal"
                                                    data-bs-toggle="modal" data-bs-target=".auditLog"
                                                    data-audit-id="{{ $audit->id }}">
                                                    <i class="ri-history-line"></i>
                                                </button>

                                                <button type="button"
                                                    class="btn btn-danger btn-sm waves-effect waves-light delete-audit-log"
                                                    data-audit-id="{{ $audit->id }}">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $audits->links('pagination::bootstrap-5') }}
                        </div>
                        {{-- /.card-body --}}
                    </div>
                    {{-- /.card --}}
                </div>
                {{-- /.col --}}
            </div>
            {{-- /.row --}}
        @endif

        {{-- Audit Log --}}
        <div class="modal fade auditLog" tabindex="-1" aria-labelledby="auditLog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auditLog">Audit Log</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    @endhasanyrole
@endsection

@push('styles')
@endpush

@push('scripts')
    @hasanyrole(['superadmin', 'developer'])
        <script>
            $(document).ready(function() {
                // Audit Log Show Modal
                $('.show-audit-modal').click(function(e) {
                    e.preventDefault();
                    const userId = $(this).data('audit-id');
                    // Fetch details via AJAX
                    $.ajax({
                        url: `{{ route('admin.users.audit', ':id') }}`.replace(':id', userId),
                        type: 'GET',
                        success: function(data) {
                            // Populate modal content with fetched data
                            $('.auditLog .modal-body').html(data);
                            // Show the modal
                            $('.auditLog').modal('show');
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                });
                $('.delete-audit-log').click(function(e) {
                    e.preventDefault();
                    const userId = $(this).data('audit-id');

                    // Show confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this audit log!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If user confirms, proceed with deletion
                            $.ajax({
                                url: `{{ route('admin.users.audit.delete', ':id') }}`.replace(
                                    ':id', userId),
                                type: 'GET',
                                success: function(data) {
                                    // Show success message
                                    Swal.fire('Deleted!',
                                        'Your audit log has been deleted.', 'success');
                                    // reload page
                                    location.reload();
                                },
                                error: function(error) {
                                    console.error('Error:', error);
                                    // Show error message if deletion fails
                                    Swal.fire('Error!',
                                        'Failed to delete audit log or it has been deleted',
                                        'error');
                                }
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            // If user cancels, show message that the history is safe
                            Swal.fire('Cancelled', 'Your audit log is safe :)', 'info');
                        }
                    });
                });
            });
        </script>
    @endhasanyrole
@endpush
