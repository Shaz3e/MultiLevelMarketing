<div wire:poll.visible>
    <div class="row">
        <div class="col-12">
            <div class="card" style="height: calc(100% - 30px)">
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
                                    <strong
                                        class="badge bg-danger">{{ $nextRanking->bonus_point - $userPoints }}</strong>
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
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">My Reward Amount</p>
                            <h4 class="mb-2">
                                @if ($user->wallet)
                                    {{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}
                                    {{ currencyFormat($user->wallet->reward_amount) }}
                                    {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                                @else
                                    N/A
                                @endif
                            </h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-success rounded-3">
                                <i class="mdi mdi-currency-eur font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">E Money Wallet</p>
                            <h4 class="mb-2">
                                @if ($user->wallet)
                                    {{ currency(DiligentCreators('currency'), ['symbol'])['symbol'] }}
                                    {{ currencyFormat($user->wallet->e_money_wallet) }}
                                    {{ currency(DiligentCreators('currency'), ['name'])['name'] }}
                                @else
                                    N/A
                                @endif
                            </h4>
                        </div>
                        <div class="avatar-sm">
                            <span class="avatar-title bg-light text-success rounded-3">
                                <i class="mdi mdi-currency-eur font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}

</div>
