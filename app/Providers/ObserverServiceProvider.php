<?php

namespace App\Providers;

use App\Models\PinCode;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use App\Models\User;
use App\Models\UserWallet;
use App\Observers\PinCodeObserver;
use App\Observers\SupportTicketObserver;
use App\Observers\SupportTicketReplyObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // User
        User::observe(UserObserver::class);

        // Support Ticket
        SupportTicket::observe(SupportTicketObserver::class);
        // Support Ticket Reply
        SupportTicketReply::observe(SupportTicketReplyObserver::class);

        // Pin Code
        PinCode::observe(PinCodeObserver::class);
    }
}
