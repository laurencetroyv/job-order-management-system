<?php

use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {


    #[NoReturn]
    public function onSubmit(): void
    {
        $validated = $this->$validate();
        $this->dispatch(
            'create-admin-information',
            firstName: $validated['firstName'], middleName: $validated['middleName'], lastName: $validated['lastName']
        );
    }
};
?>

<form class="space-y-6" wire:submit="onSubmit">
    <div>
        <flux:heading size="lg">Setup your information</flux:heading>
        <flux:text class="mt-2">This is how you will appear in the system</flux:text>
        <flux:text class="mt-2">Account created will be the super admin</flux:text>
    </div>


</form>
