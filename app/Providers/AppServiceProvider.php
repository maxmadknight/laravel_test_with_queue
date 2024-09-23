<?php

namespace App\Providers;

use App\Events\SubmissionSaved;
use App\Listeners\LogSubmissionSaved;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        Event::listen(
            SubmissionSaved::class,
            LogSubmissionSaved::class,
        );
    }
}
