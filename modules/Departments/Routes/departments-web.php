<?php

use App\Enum\RoleEnum;

Route::middleware(['auth', 'role:'.RoleEnum::SuperAdmin->value])->group(function () {
    Route::livewire('/departments', 'pages::departments.index')->name('departments');
});
