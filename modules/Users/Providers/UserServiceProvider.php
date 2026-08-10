<?php

namespace Modules\Users\Providers;

use Modules\Users\Models\User;
use Modules\Core\Contracts\Userable;
use Modules\Core\Registry\ResourceRegistry;
use Modules\Users\Http\Resources\UserResource;
use Modules\Core\Providers\SkeletonServiceProvider;

class UserServiceProvider extends SkeletonServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->app->bind(Userable::class, User::class);
    }

    public function boot(): void
    {
        parent::boot();

        ResourceRegistry::register(Userable::class, UserResource::class);
    }
}
