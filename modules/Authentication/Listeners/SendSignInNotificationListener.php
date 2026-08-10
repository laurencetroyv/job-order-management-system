<?php

namespace Modules\Authentication\Listeners;

use Modules\Authentication\Events\SignInEvent;

class SendSignInNotificationListener
{
    public function handle(SignInEvent $event): void
    {
        // TODO: Add sign-in email notification with ip along with the user agent
    }
}
