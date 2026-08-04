<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rules\Password;
use Modules\Authentication\Data\OnboardingData;
use Modules\Authentication\Services\AuthenticationService;

class OnboardingForm extends Form
{
    #[Validate]
    public string $email = '';

    #[Validate]
    public string $password = '';

    public string $firstName = '';

    public string $middleName = '';

    public string $lastName = '';

    public $photo;

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
                'unique:authentications,email',
            ],
            'password'   => Password::default(),
            'firstName'  => ['required', 'string', 'max:32'],
            'middleName' => ['nullable', 'string', 'max:32'],
            'lastName'   => ['required', 'string', 'max:32'],
            'photo'      => ['nullable', 'image', 'max:5120'],
        ];
    }

    public function submit(): void
    {
        $this->validate();
        $data = OnboardingData::from($this->all());

        new AuthenticationService()->onBoardAdmin($data);

        $this->reset();
    }
}
