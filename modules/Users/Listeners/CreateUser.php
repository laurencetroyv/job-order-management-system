<?php

namespace Modules\Users\Listeners;

use Modules\Users\Data\CreateUserData;
use Modules\Users\Services\UserService;
use Modules\Authentication\Events\AuthenticationCreated;

readonly class CreateUser
{
    public function __construct(
        private UserService $service,
    ) {}

    /**
     * Handle the event.
     */
    public function handle(AuthenticationCreated $event): void
    {
        $arr = array_merge(['id' => $event->auth->id], $event->userData);

        $data = CreateUserData::from($arr);

        $this->service->createUser($data);
    }
}
