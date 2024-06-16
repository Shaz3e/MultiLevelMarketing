<div class="card card-primary">
    <div class="card-body pb-0 px-0">
        <a href="{{ route('referrals.index', $direct->id) }}">
            <div class="px-4">
                <img src="{{ $direct->avatar ? asset('storage/' . $direct->avatar) : asset('assets/images/users/avatar-1.jpg') }}"
                    class="rounded-circle d-blok w-100 mx-auto" alt="{{ $direct->name }}" />
            </div>
        </a>
        <p class="my-2 text-center">
            {{ $direct->name }}
            <br>
            <span class="badge bg-primary">User ID: {{ $direct->id }}</span>
            <br>
            <span class="badge bg-success">Ref Code: {{ $direct->referral_code }}</span>
            @if ($direct->wallet)
                <span class="badge bg-info">Points: {{ $direct->wallet->points }}</span>
                <br>
                <span class="badge bg-info">Amount: {{ $direct->wallet->amount }}</span>
            @else
                <span class="badge bg-danger">Points: 0</span>
                <br>
                <span class="badge bg-danger">Amount: 0</span>
            @endif
        </p>
    </div>
    {{-- /.card-body --}}
</div>
{{-- /.card --}}