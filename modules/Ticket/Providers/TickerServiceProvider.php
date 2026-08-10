<?php

namespace Modules\Ticket\Providers;

use Modules\Ticket\Models\Ticket;
use Modules\Core\Contracts\Ticketable;
use Modules\Core\Providers\SkeletonServiceProvider;

class TickerServiceProvider extends SkeletonServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->app->bind(Ticketable::class, Ticket::class);
    }
}
