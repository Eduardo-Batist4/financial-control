<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Policies\UserPolicy;
use App\Policies\AccountPolicy;
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

        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    }
}
