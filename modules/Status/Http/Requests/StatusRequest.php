<?php

namespace Modules\Status\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'status' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
