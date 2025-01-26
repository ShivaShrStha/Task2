<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DateConversionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formpage', function () {
    return view('formpage');
});

Route::get('/projectspage', function () {
    return view('projectspage');
});

Route::post('/convert-date', [DateConversionController::class, 'convertDate']);
