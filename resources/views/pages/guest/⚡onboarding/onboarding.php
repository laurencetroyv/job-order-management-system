<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\OnboardingForm;
use Modules\Authentication\Models\Authentication;

new #[Layout('layouts.default')]
class extends Component
{
    use WithFileUploads;

    public function boot(): void
    {
        if (Authentication::count() !== 0) {
            $this->redirect('/sign-in');
        }
    }

    public OnboardingForm $form;

    public function onSubmit(): void
    {
        $this->form->submit();

        Flux::toast(
            text: 'Account has been created',
            variant: 'success',
        );

        $this->redirect('/sign-in');
    }
};
