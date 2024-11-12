<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnimeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/animes',[AnimeController::class,'index'])->name('animes.index');

Route::get('/animes/create',[AnimeController::class,'create'])->name('animes.create');
Route::get('/animes/{anime}/edit',[AnimeController::class,'edit'])->name('animes.edit');
Route::delete('/animes/{anime}',[AnimeController::class,'destroy'])->name('animes.destroy');
Route::get('/animes/{anime}',[AnimeController::class,'show'])->name('animes.show');

Route::post('/animes',[AnimeController::class,'store'])->name('animes.store');
Route::patch('/animes/{anime}',[AnimeController::class,'update'])->name('animes.update');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
});

require __DIR__.'/auth.php';
