<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\OptionController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/form', function () {
    return view('form');
});


Route::get('/get-districts', [DistrictController::class, 'getDistricts']);


Route::get('/get-options', [OptionController::class, 'getOptions']);
require base_path('routes/api.php');
