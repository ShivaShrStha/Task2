<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\OptionController;

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


Route::get('/get-options', [OptionController::class, 'getOptions']);
