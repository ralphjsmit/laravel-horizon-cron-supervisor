<?php

namespace RalphJSmit\LaravelHorizonCron\Supervisor;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

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