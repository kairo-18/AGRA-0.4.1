<?php

namespace App\Providers;

use App\Models\AgraNotification;
use App\Models\Score;
use App\Observers\AgraNotificationObserver;
use App\Observers\ScoreObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Score::observe(ScoreObserver::class);
        AgraNotification::observe(AgraNotificationObserver::class);
    }
}
