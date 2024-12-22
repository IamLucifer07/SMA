<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialMediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [SocialMediaController::class, 'index'])
    // ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// API routes for social media data
Route::get('/api/facebook-engagement/{userId}', [SocialMediaController::class, 'getFacebookEngagement'])
    // ->middleware(['auth'])


require __DIR__ . '/auth.php';
