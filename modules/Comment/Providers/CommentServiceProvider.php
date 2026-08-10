<?php

namespace Modules\Comment\Providers;

use Modules\Comment\Models\Comment;
use Modules\Core\Contracts\Commentable;
use Modules\Core\Providers\SkeletonServiceProvider;

class CommentServiceProvider extends SkeletonServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->app->bind(Commentable::class, Comment::class);
    }
}
