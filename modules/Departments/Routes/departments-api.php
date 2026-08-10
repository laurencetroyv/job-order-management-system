<?php

use Modules\Departments\Http\Controllers\DepartmentController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // -- /api/departments
    Route::group([
        'prefix'     => 'departments',
        'as'         => 'departments.',
        'controller' => DepartmentController::class,
    ], static function () {
        // -- / INDEX
        Route::get('', 'index')->name('index');

        // -- / POST
        Route::post('', 'store')->name('post');

        // -- /api/departments/{id}
        Route::prefix('{id}')->group(function () {
            // -- GET
            Route::get('', 'show')->name('show');

            // -- UPDATE
            Route::patch('', 'update')->name('update');

            // -- DELETE
            Route::delete('', 'destroy')->name('destroy');

            // -- RESTORE
            Route::post('', 'restore')->name('restore');
        });
    });
});
