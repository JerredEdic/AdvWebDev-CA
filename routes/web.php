<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
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



Route::resource('reviews',ReviewController::class);

Route::post('animes/{anime}/reviews',[ReviewController::class,'store'])->name('reviews.store');
Route::get('review/{review}/edit',[ReviewController::class,'edit'])->name('reviews.edit');
Route::patch('/reviews/{review}',[AnimeController::class,'update'])->name('reviews.update');


require __DIR__.'/auth.php';
