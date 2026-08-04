<?php

namespace Modules\Authentication\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class OnboardingData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
        public string $firstName,
        public Optional|null|string $middleName,
        public string $lastName,
        public Optional|null|TemporaryUploadedFile $photo,
    ) {}
}
