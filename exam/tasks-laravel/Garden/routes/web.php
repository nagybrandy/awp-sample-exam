<?php

use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProfileController;
use App\Models\Plant;
use Illuminate\Support\Facades\Route;

// TODO (L1): Register GET `/` named `home`. If the user is authenticated, redirect to `dashboard`.
//           Otherwise return `home` view with `plantCount` (Plant::count()).

// TODO (L1): Register GET `/plants` → PlantController@index, name `plants.index`.

Route::get('/plants/create', [PlantController::class, 'create'])->name('plants.create');
Route::post('/plants', [PlantController::class, 'store'])->name('plants.store');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'plantCount' => Plant::query()->count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
