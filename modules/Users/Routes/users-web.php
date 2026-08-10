<?php

Route::middleware('auth')->group(function () {
    Route::livewire('/', 'pages::index')->name('index');
    Route::livewire('/users', 'pages::users')->name('users');
    Route::livewire('/profile', 'pages::profile')->name('profile');
    Route::livewire('/permissions', 'pages::permissions')->name('permissions');
    Route::livewire('/settings', 'pages::settings')->name('settings');
});
