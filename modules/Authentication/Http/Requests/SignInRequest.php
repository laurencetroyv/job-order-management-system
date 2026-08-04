<?php

namespace Modules\Authentication\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read ?string $username
 * @property-read ?string $email
 * @property-read string $password
 * @property-read bool $remember
 */
class SignInRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username' => [
                'sometimes',
                'string',
                'max:32',
                'exists:authentications,username',
            ],
            'email' => [
                Rule::requiredIf(fn () => $this->input('username') === '' || $this->input('username') === null),
                'email',
                'exists:authentications,email',
            ],
            'password' => ['required', 'min:8', 'max:32'],
            'remember' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'username.exists'   => 'Username does not exist.',
            'username.max'      => 'Username name is too long.',
            'email.exists'      => 'Email not found, Please check your email and try again.',
            'password.min'      => 'Password must be at least 8 characters.',
            'password.max'      => 'Password must not be greater than 32 characters.',
            'password.required' => 'Password is required.',
        ];
    }
}
