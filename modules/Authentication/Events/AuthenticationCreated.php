<?php

namespace Modules\Authentication\Events;

use App\Enum\RoleEnum;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Modules\Authentication\Models\Authentication;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class AuthenticationCreated implements ShouldDispatchAfterCommit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param  array<string, mixed>  $userData
     */
    public function __construct(
        public Authentication $auth,
        public array $userData,
        public RoleEnum $role,
    ) {}
}
