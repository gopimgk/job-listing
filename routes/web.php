<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JobController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/dashboard', [JobController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     Route::post('/jobs/store', [JobController::class, 'store'])->name('jobs.store');
//     Route::put('/jobs/{id}', [JobController::class, 'update'])->middleware('isJobOwner')->name('jobs.update');
//     Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->middleware('isJobOwner')->name('jobs.destroy');
// });


// Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
// Route::get('/jobs/create', function () {
//     return view('jobs.create');})->name('jobs.create');
// Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');



// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Jobs
    Route::get('/jobs/create', function () {
    return view('jobs.create');})->name('jobs.create');
    Route::post('/jobs/store', [JobController::class, 'store'])->name('jobs.store');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->middleware('isJobOwner')->name('jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->middleware('isJobOwner')->name('jobs.destroy');
});

// Public Job Routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');



require __DIR__.'/auth.php';
