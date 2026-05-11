<?php

use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProfileController;
use App\Models\Plant;
use Illuminate\Support\Facades\Route;

// TODO (L1.a–b): Register GET `/`, name it `home`. For guests, return the `home`
//                view with `plantCount` (Plant::count()).
// TODO (L3.a):   For an authenticated user, redirect from `/` to the `dashboard`
//                route instead of returning the guest home.

// TODO (L1.c):   Register GET `/plants` → `PlantController@index`,
//                route name `plants.index`.

// TODO (L3.i–j): Wrap `GET /plants/create` and `POST /plants` in the `auth`
//                middleware so guests cannot reach them.
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
