<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::post('/register', [ AuthController::class, 'register' ]);
Route::post('/login', [ AuthController::class, 'login' ]);

Route::middleware(['jwt.verify'])->group(function () {

    // User
    Route::put('/users/update', [ UserController::class, 'update' ]);
    Route::delete('/users/delete', [ UserController::class, 'delete' ]);

    // Account
    Route::get('/users/accounts', [ AccountController::class, 'get' ]);
    Route::put('/users/accounts', [ AccountController::class, 'update' ]);

    // Category
    Route::get('/categories', [ CategoryController::class, 'index' ]);
    Route::post('/categories/create', [ CategoryController::class, 'create' ]);
    Route::put('/categories/update/{id}', [ CategoryController::class, 'update' ]);
    ROute::delete('/categories/delete/{id}', [ CategoryController::class, 'delete' ]);

    // Transactions
    Route::post('/transactions', [ TransactionController::class, 'store' ]);
    Route::get('/transactions', [ TransactionController::class, 'index' ]);
    Route::get('/transactions/stats', [ TransactionController::class, 'transactionStats' ]);
    Route::put('/transactions/{id}', [ TransactionController::class, 'update' ]);
    Route::delete('/transactions/{id}', [ TransactionController::class, 'delete' ]);
});
