<?php

namespace RalphJSmit\LaravelHorizonCron\Supervisor;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class SupervisorServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/horizon-cron-supervisor.php' => config_path('horizon-cron-supervisor.php'),
        ]);

        $this->commands([
            \RalphJSmit\LaravelHorizonCron\Supervisor\Console\RestartHorizon::class,
        ]);

        $this->app->booted(function () {
            if (config('horizon-cron-supervisor.enabled')) {
                $expression = config('horizon-cron-supervisor.schedule');
                $schedule = $this->app->make(Schedule::class);

                $schedule->command('supervisor:check')->tap(
                    fn (Event $event) => $event->expression = is_numeric($expression) ? "*/$expression * * * *" : $expression
                );
            }
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/horizon-cron-supervisor.php', 'horizon-cron-supervisor');
    }
}
