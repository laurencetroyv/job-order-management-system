<?php

namespace Modules\Attachment\Providers;

use Modules\Attachment\Models\Attachment;
use Modules\Core\Contracts\Attachmentable;
use Modules\Core\Registry\ResourceRegistry;
use Modules\Core\Providers\SkeletonServiceProvider;
use Modules\Attachment\Http\Resources\AttachmentResource;

class AttachmentServiceProvider extends SkeletonServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->app->bind(Attachmentable::class, Attachment::class);
    }

    public function boot(): void
    {
        parent::boot();

        ResourceRegistry::register(Attachmentable::class, AttachmentResource::class);
    }
}
