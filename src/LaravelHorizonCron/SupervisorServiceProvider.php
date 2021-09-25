<?php

namespace RalphJSmit\LaravelHorizonCron\Supervisor;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Command;

class SupervisorServiceProvider extends ServiceProvider
{
	public function boot()
	{
        $this->commands([
            \RalphJSmit\LaravelHorizonCron\Supervisor\Console\RestartHorizon::class,
        ]);
	}

	public function register()
	{

	}
}