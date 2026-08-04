<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\SignInForm;
use Modules\Authentication\Models\Authentication;

new #[Layout('layouts.default')]
class extends Component
{
    public SignInForm $form;

    public function boot(): void
    {
        if (Authentication::count() === 0) {
            $this->redirect('/onboarding');
        }
    }

    public function onSubmit(): void
    {
        $this->form->submit();

        $this->redirect('/', navigate: true);
    }
};
