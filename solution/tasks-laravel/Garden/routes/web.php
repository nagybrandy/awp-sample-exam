<?php

use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProfileController;
use App\Models\Plant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('home', [
        'plantCount' => Plant::query()->count(),
    ]);
})->name('home');

Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');

Route::middleware('auth')->group(function () {
    Route::get('/plants/mine', [PlantController::class, 'mine'])->name('plants.mine');
    Route::get('/plants/create', [PlantController::class, 'create'])->name('plants.create');
    Route::post('/plants', [PlantController::class, 'store'])->name('plants.store');
});

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
