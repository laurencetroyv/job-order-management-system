<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('onboarding.admin-information')
        ->assertStatus(200);
});
