<?php

use Database\Seeders\RoleSeeder;
use Livewire\Livewire;
use Modules\Authentication\Models\Authentication;

it('test-form', function () {
    $this->seed(RoleSeeder::class);

    $email = 'admin@mrxuh.jo';
    $password = 'Secret123!';

    Livewire::test('pages::guest.onboarding')
        ->set('form.email', $email)
        ->set('form.password', $password)
        ->set('form.firstName', 'Super')
        ->set('form.lastName', 'Admin')
        ->call('onSubmit')
        ->assertHasNoErrors();

    $auth = Authentication::where('email', 'admin@mrxuh.jo')->first();

    expect($auth)->not->toBeNull()
        ->and(Hash::check($password, $auth->password))->toBeTrue();

    Livewire::test('pages::guest.sign-in')
        ->set('form.email', $email)
        ->set('form.password', $password)
        ->call('onSubmit')
        ->assertRedirect('/');
});
