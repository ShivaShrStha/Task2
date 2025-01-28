<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DateConversionController;
use App\Http\Controllers\DistrictController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formpage', function () {
    return view('formpage');
});

Route::get('/projectspage', function () {
    return view('projectspage');
});


Route::get('/get-districts', [DistrictController::class, 'getDistricts']);
