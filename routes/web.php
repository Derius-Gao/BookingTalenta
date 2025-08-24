<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RatingController;
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
    
    // Users CRUD routes
    Route::resource('users', UserController::class);
    
    // Talents CRUD routes
    Route::resource('talents', TalentController::class);
    
    // Kategoris CRUD routes
    Route::resource('kategoris', KategoriController::class);
    
    // Portfolios CRUD routes
    Route::resource('portfolios', PortfolioController::class);
    
    // Bookings CRUD routes
    Route::resource('bookings', BookingController::class);
    
    // Pembayarans CRUD routes
    Route::resource('pembayarans', PembayaranController::class);
    
    // Ratings CRUD routes
    Route::resource('ratings', RatingController::class);
});

require __DIR__.'/auth.php';
