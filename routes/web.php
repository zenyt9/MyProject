<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarCategoryController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes (protected by admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories', CarCategoryController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('cars', CarController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('rentals', RentalController::class);
    Route::resource('bookings', BookingController::class);
});

// User routes (protected by auth)
Route::middleware(['auth'])->group(function () {
    // Users can view available cars and make bookings
    Route::get('/cars', [CarController::class, 'userIndex'])->name('user.cars.index');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('user.bookings');
    Route::post('/bookings', [BookingController::class, 'store'])->name('user.bookings.store');
});
