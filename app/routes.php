<?php

use App\Controllers\UrlController;
use App\Controllers\UserController;
use Core\Route;

Route::post('/api/v1/users', [UserController::class, 'store']);

Route::get('/api/v1/urls', [UrlController::class, 'index']);
Route::post('/api/v1/urls', [UrlController::class, 'store']);
Route::put('/api/v1/urls/{hash}', [UrlController::class, 'update']);
Route::delete('/api/v1/urls/{hash}', [UrlController::class, 'destroy']);

Route::get('/{hash}', [UrlController::class, 'redirect']);

Route::get('/', 'Welcome to the Link Shortener!');
