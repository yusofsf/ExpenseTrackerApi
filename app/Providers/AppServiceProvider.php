<?php

namespace App\Providers;

use App\Interfaces\StatsServiceInterface;
use App\Models\User;
use App\Services\StatsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StatsServiceInterface::class, function () {
            return new StatsService(User::find(Auth::id())->first());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
