<?php

namespace Modules\Users\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Illuminate\Http\UploadedFile;

class UpdateUserData extends Data
{
    /**
     * @param  array<int, UploadedFile>|null  $attachments
     */
    public function __construct(
        public Optional|null|string $first_name,
        public Optional|null|string $middle_name,
        public Optional|null|string $last_name,
        public Optional|array|null $attachments
    ) {}
}
