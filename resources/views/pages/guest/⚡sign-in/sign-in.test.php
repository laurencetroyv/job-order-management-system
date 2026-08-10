<?php

use Livewire\Livewire;
use Database\Seeders\RoleAndPermissionSeeder;
use Modules\Authentication\Models\Authentication;

it('test-form', function () {
    $this->seed(RoleAndPermissionSeeder::class);

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
