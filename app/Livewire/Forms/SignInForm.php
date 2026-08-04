<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Illuminate\Validation\Rules\Password;
use Modules\Authentication\Data\SignInData;
use Modules\Authentication\Services\AuthenticationService;

class SignInForm extends Form
{
    public string $email;

    public string $password;

    public bool $remember;

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:254',
                'exists:authentications,email',
            ],

            'password' => Password::default(),

            'remember' => [
                'nullable',
                'bool',
            ],
        ];
    }

    public function submit(): void
    {
        $this->validate();
        $data = SignInData::from($this->all());

        new AuthenticationService()->authenticateWeb($data);

        session()->regenerate();
        session()->save();
    }
}
