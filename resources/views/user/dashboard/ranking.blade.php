<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="progress animated-progess mb-2">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progress }}%"
                        aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <p>
                            <span class="d-block">Current Points: 
                                <strong class="badge bg-success">{{ $userPoints }}</strong>
                            </span>
                            <span class="d-block">Remaining Points: 
                                <strong class="badge bg-danger">{{ $nextRanking->bonus_point - $userPoints }}</strong>
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="text-end">
                            <span class="d-block"><small>Next Ranking: </small>
                                <strong>{{ $nextRanking->name }}</strong>
                            </span>
                            <span class="d-block"><small>Reward: </small>
                                <strong>{{ $nextRanking->reward }}</strong>
                            </span>
                        </p>
                    </div>
                </div>
                {{-- /.row --}}
            </div>
            {{-- /.card-body --}}
        </div>
        {{-- /.card --}}
    </div>
    {{-- /.col --}}
</div>
{{-- /.row --}}
