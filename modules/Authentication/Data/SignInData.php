<?php

namespace Modules\Authentication\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class SignInData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
        public Optional|null|bool $remember,
    ) {}
}
