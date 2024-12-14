<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

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
});

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile');

Route::get('/appointment-detail', function () {
    return view('appointment-detail');
})->name('appointment.detail');

Route::middleware('auth')->group(function () {
    Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password/update', [PasswordController::class, 'update'])->name('password.update');
});

Route::get('/change-password', [PasswordController::class, 'changePassword'])->name('change.password');

Route::get('/search', [AppointmentController::class, 'search'])->name('connect');
Route::get('/appointments', [AppointmentController::class, 'index']);

Route::post('/add-session', [AppointmentController::class, 'storeSelectedSession'])->name('add-session');
Route::get('/dashboard', [AppointmentController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::post('/unadd-session', [AppointmentController::class, 'unaddSession'])->name('unaddSession');



require __DIR__.'/auth.php';
