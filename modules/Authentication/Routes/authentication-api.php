<?php

use Modules\Authentication\Http\Controllers\AuthenticationController;

Route::middleware('guest')->group(function () {
    Route::post('/sign-in', [AuthenticationController::class, 'signIn']);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // -- /api/sign-out
    Route::post('/sign-out', [AuthenticationController::class, 'signOut']);
});
