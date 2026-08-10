<?php

use Livewire\Component;
use Modules\Authentication\Services\AuthenticationService;

new class extends Component {

    public function signOut(): void
    {
        $auth = Auth::user();
        new AuthenticationService()->revokeToken($auth);
        $this->redirect('/sign-in');
    }
};
?>

<flux:menu>
    <flux:menu.group heading="Account">
        <flux:menu.item
            href="{{ route('profile') }}"
            icon="user"
        >
            Profile
        </flux:menu.item>
        <flux:menu.item
            href="{{ route('permissions') }}"
            icon="shield-check"
        >
            Permissions
        </flux:menu.item>
    </flux:menu.group>

    <flux:menu.group heading="Help & Support">
        <flux:menu.item
            icon="cog-6-tooth"
            href="{{ route('settings') }}">
            Settings
        </flux:menu.item>
        <flux:menu.item
            icon="information-circle"
            href="mailto:laurencetroyv@gmail.com">
            Help
        </flux:menu.item>
    </flux:menu.group>

    <flux:menu.item wire:click.prevent="signOut" icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
</flux:menu>
