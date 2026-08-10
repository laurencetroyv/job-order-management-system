<?php

namespace Modules\Users\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Illuminate\Http\UploadedFile;

class CreateUserData extends Data
{
    public function __construct(
        public Optional|null|string $id,
        public string $first_name,
        public Optional|null|string $middle_name,
        public string $last_name,
        public Optional|UploadedFile|null $photo
    ) {}
}
