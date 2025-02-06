<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;


Route::namespace('Api')->group(function () {
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::get('/posts', [PostController::class, 'index']);
});
