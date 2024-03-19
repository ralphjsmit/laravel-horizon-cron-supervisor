<?php

namespace RalphJSmit\LaravelHorizonCron\Supervisor;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class SupervisorServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            \RalphJSmit\LaravelHorizonCron\Supervisor\Console\RestartHorizon::class,
        ]);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
			
            $schedule->command('supervisor:check')->everyThreeMinutes();
        });
    }

    public function register(): void
    {
		//
    }
}
