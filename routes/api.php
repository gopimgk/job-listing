<?php
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JobController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{id}', [JobController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/jobs', [JobController::class, 'store']);
    Route::put('/jobs/{id}', [JobController::class, 'update'])->middleware('isJobOwner');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->middleware('isJobOwner');
});
