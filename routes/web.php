<?php

use App\Http\Controllers\KassaticketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resource('kassatickets', KassaticketController::class);
