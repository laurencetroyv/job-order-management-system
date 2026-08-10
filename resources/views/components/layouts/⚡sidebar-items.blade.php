<?php

use App\Models\Role;
use App\Enum\RoleEnum;
use Livewire\Component;
use Modules\Users\Enum\UserPermissions;
use Modules\Departments\Enums\DepartmentPermissions;

new class extends Component {
};
?>

<flux:sidebar.nav>
    <flux:sidebar.item icon="home" href="{{ route('index') }}" wire:current.exact>Home</flux:sidebar.item>

    @canany([DepartmentPermissions::Index, UserPermissions::Index])
        <flux:sidebar.group expandable heading="Manage" class="grid">
            @can(DepartmentPermissions::Index)
                <flux:sidebar.item
                    icon="inbox"
                    wire:current.exact
                    href="{{ route('departments') }}"
                >
                    Departments
                </flux:sidebar.item>
            @endcan

            @can(UserPermissions::Index)
                <flux:sidebar.item
                    icon="inbox"
                    href="{{ route('users') }}"
                    wire:current.exact
                >
                    Users
                </flux:sidebar.item>
            @endcan
        </flux:sidebar.group>
    @endcanany
</flux:sidebar.nav>
