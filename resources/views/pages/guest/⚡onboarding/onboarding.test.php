<?php

use Livewire\Livewire;
use Modules\Users\Models\User;
use Database\Seeders\RoleSeeder;
use Modules\Authentication\Models\Authentication;

use function Pest\Laravel\assertDatabaseMissing;

it('onboarding-page', function () {
    $this->seed(RoleSeeder::class);

    $password = 'Secret123!';
    $hash = Hash::make($password);

    assertDatabaseMissing(Authentication::class, [
        'email'    => 'admin@mrxuh.jo',
        'password' => $hash,
    ]);

    assertDatabaseMissing(User::class, [
        'first_name'  => 'Super',
        'middle_name' => '',
        'last_name'   => 'Admin',
    ]);

    Livewire::test('pages::guest.onboarding')
        ->set('form.email', 'admin@mrxuh.jo')
        ->set('form.password', $password)
        ->set('form.firstName', 'Super')
        ->set('form.lastName', 'Admin')
        ->call('onSubmit')
        ->assertRedirect('/sign-in');

    $auth = Authentication::where('email', 'admin@mrxuh.jo')->first();

    expect($auth)->not->toBeNull()
        ->and(Hash::check($password, $auth->password))->toBeTrue();

    $user = User::where('id', $auth->id)->first();

    expect($user)->not->toBeNull()
        ->and($user->first_name)->toBe('Super')
        ->and($user->last_name)->toBe('Admin');
});
