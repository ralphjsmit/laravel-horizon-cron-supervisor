<?php

namespace RalphJSmit\LaravelHorizonCron\Supervisor;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class SupervisorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /**
         * Register the check horizon status command
         */
        $this->commands([
            \RalphJSmit\LaravelHorizonCron\Supervisor\Console\RestartHorizon::class,
        ]);

        /**
         * Schedule the command
         */
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('supervisor:check')->everyThreeMinutes();
        });
    }

    public function register()
    {

    }
}
