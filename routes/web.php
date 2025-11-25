<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/signup', [SignupController::class, 'create'])->name('signup');
Route::get('/login', [AuthController::class, 'create'])->name('auth.login');

Route::get('/cars/search', [CarController::class, 'search'])->name('car.search');
Route::resource('cars', CarController::class);
