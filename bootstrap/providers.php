<?php

use App\Providers\AppServiceProvider;
use App\Providers\TelescopeServiceProvider;
use Modules\Users\Providers\UserServiceProvider;
use Modules\Status\Providers\StatusServiceProvider;
use Modules\Ticket\Providers\TickerServiceProvider;
use Modules\Comment\Providers\CommentServiceProvider;
use Modules\Attachment\Providers\AttachmentServiceProvider;
use Modules\Departments\Providers\DepartmentServiceProvider;
use Modules\Authentication\Providers\AuthenticationServiceProvider;

return [
    AppServiceProvider::class,
    UserServiceProvider::class,
    TickerServiceProvider::class,
    TelescopeServiceProvider::class,
    DepartmentServiceProvider::class,
    AttachmentServiceProvider::class,
    AuthenticationServiceProvider::class,
    CommentServiceProvider::class,
    StatusServiceProvider::class,
];
