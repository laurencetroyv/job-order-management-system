<?php

use Modules\Departments\Http\Controllers\DepartmentController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // -- /api/departments
    Route::prefix('departments')->controller(DepartmentController::class)->group(function () {
        // -- / INDEX
        Route::get('', 'index');

        // -- / POST
        Route::post('', 'store');

        // -- /api/departments/{id}
        Route::prefix('{id}')->group(function () {
            // -- GET
            Route::get('', 'show');

            // -- UPDATE
            Route::patch('', 'update');

            // -- DELETE
            Route::delete('', 'destroy');

            // -- RESTORE
            Route::post('', 'restore');
        });
    });
});
