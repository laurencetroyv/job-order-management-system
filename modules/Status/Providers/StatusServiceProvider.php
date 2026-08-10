<?php

namespace Modules\Status\Providers;

use Modules\Status\Models\Status;
use Modules\Core\Contracts\Statusable;
use Modules\Core\Providers\SkeletonServiceProvider;

class StatusServiceProvider extends SkeletonServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->app->bind(Statusable::class, Status::class);
    }
}
