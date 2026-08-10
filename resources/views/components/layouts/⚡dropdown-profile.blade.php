<?php

use Livewire\Component;
use Modules\Attachment\Models\Attachment;
use Modules\Users\Models\User;

new class extends Component {
    public readonly User $user;
    public readonly Attachment $attachment;

    public function mount(): void
    {
        $user = \Auth::user()->user();
        $this->user = $user;
        $this->attachment = $user->attachment()->first();
    }
};
?>

<flux:sidebar.profile
    avatar="{{ $attachment->getUrlAttribute() }}"
    name="{{ $user->full_name }}"
/>
