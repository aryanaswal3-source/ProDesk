<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyMediaController;
use App\Http\Controllers\PublicPropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // Properties
    Route::resource('properties', PropertyController::class);


    // Property Media

    // Upload photo/video
    Route::post(
        '/properties/{property}/media',
        [PropertyMediaController::class, 'store']
    )->name('properties.media.store');


    // Set image as cover
    Route::post(
        '/property-media/{media}/cover',
        [PropertyMediaController::class, 'setCover']
    )->name('properties.media.cover');


    // Delete photo/video
    Route::delete(
        '/property-media/{media}',
        [PropertyMediaController::class, 'destroy']
    )->name('properties.media.destroy');
});

// Public Property
Route::get(
    '/property/{property:slug}',
    [PublicPropertyController::class, 'show']
)->name('properties.public');

require __DIR__ . '/auth.php';
