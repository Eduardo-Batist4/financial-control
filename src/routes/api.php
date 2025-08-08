<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::post('/register', [ AuthController::class, 'register' ]);
Route::post('/login', [ AuthController::class, 'login' ]);

Route::middleware(['jwt.verify'])->group(function () {

    Route::get('/users', [ UserController::class, 'all' ]);

    // User
    Route::put('/users/update/{id}', [ UserController::class, 'update' ]);
    Route::delete('/users/{id}', [ UserController::class, 'delete' ]);


});
