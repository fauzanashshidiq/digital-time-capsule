<?php

use App\Http\Controllers\CapsuleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('capsules/edit-mode', [CapsuleController::class, 'editMode'])
        ->name('capsules.edit-mode');
    Route::get('capsules/delete-mode', [CapsuleController::class, 'editMode'])
        ->name('capsules.delete-mode');
    Route::resource('capsules', CapsuleController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('auth')
        ->name('dashboard');
});

require __DIR__.'/auth.php';
