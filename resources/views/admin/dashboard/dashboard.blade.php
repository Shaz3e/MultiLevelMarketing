{{-- Task Summary --}}
@hasanyrole(json_decode(DiligentCreators('can_access_task_summary')))
    @livewire('admin.dashboard.task-summary')
    @livewire('admin.dashboard.recent-task')
@endhasanyrole

{{-- User Summary --}}
@hasanyrole(json_decode(DiligentCreators('can_access_user_summary')))
    @livewire('admin.dashboard.user-summary')
@endhasanyrole

{{-- Support Ticket Summary --}}
@hasanyrole(json_decode(DiligentCreators('can_access_support_ticket_summary')))
    @livewire('admin.dashboard.support-ticket-summary')
    <div class="row mb-3">
        <div class="col-6">
            @livewire('admin.dashboard.recent-support-ticket')
        </div>
        <div class="col-6">
            @livewire('admin.dashboard.recent-support-ticket-reply')
        </div>
    </div>
@endhasanyrole