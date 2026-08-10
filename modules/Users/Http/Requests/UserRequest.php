<?php

namespace Modules\Users\Http\Requests;

use Modules\Attachment\Http\Requests\AttachmentRequest;

class UserRequest extends AttachmentRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name'  => ['required'],
            'middle_name' => ['nullable'],
            'last_name'   => ['required'],
            ...$this->attachmentRule(5),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
