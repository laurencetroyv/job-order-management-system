<?php

namespace Modules\Attachment\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class AttachmentRequest extends FormRequest
{
    /**
     * Set the attachments rules with 30mb default file size
     *
     * @return array<string, mixed>
     */
    public function attachmentRule(int $max = 30): array
    {
        return [
            'attachments'   => ['sometimes', 'nullable', 'array'],
            'attachments.*' => [
                File::types(['png', 'jpg', 'jpeg', 'pdf'])
                    ->min(1)
                    ->max(1024 * $max),
            ],
        ];
    }
}
