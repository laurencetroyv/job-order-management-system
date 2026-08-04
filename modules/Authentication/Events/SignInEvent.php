<?php

namespace Modules\Authentication\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Modules\Authentication\Models\Authentication;

class SignInEvent
{
    use Dispatchable;

    public function __construct(
        public Authentication $auth,
    ) {}
}
