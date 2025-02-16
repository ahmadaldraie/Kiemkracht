<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KassaticketController;
use App\Http\Controllers\KlantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resource('kassatickets', KassaticketController::class);
Route::resource('klanten', KlantController::class);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
