<?php

Route::middleware('guest')->group(function () {
    Route::livewire('/sign-in', 'pages::guest.sign-in')->name('sign-in');

    Route::livewire('/onboarding', 'pages::guest.onboarding')->name('onboarding');
});
