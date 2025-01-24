<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formpage', function () {
    return view('formpage');
});

Route::get('/projectspage', function () {
    return view('projectspage');
});
