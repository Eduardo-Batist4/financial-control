<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Models\User;
use App\Observers\UserObserver;
use App\Observers\TransactionObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        User::observe(UserObserver::class);
        Transaction::observe(TransactionObserver::class);

        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    }
}
