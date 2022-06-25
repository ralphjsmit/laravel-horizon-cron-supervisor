<?php

namespace RalphJSmit\LaravelHorizonCron\Supervisor\Console;

use Illuminate\Console\Command;

class RestartHorizon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'supervisor:check {--r|resume-if-paused} {--s|silent} {--p|php-path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking if Horizon is running and Starting if not';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        // First Check if horizon is installed.
        try {
            $horizon = app(\Laravel\Horizon\Contracts\MasterSupervisorRepository::class);
        } catch (\Exception) {
            $this->error('Horizon does not seem to be installed correctly.');
            return static::INVALID;
        }

        // Get supervisors.
        $masterSupervisors = $horizon->all();

        // if none is running, we should start horizon.
        if (count($masterSupervisors) === 0) {
            $this->error('Horizon is not running.');
            return $this->startHorizon();
        }

        // Get the first supervisor abd check it's status.
        $masterSupervisor = $masterSupervisors[0];

        // if paused, we can resume it.
        if ($masterSupervisor->status === 'paused') {
            $this->warn('Horizon is running, but the status is paused.');
            if ($this->option('resume-if-paused')) {
                $this->info('Resuming Horizon.');
                $this->call('horizon:continue');
            } else if (!$this->option('silent') && $this->confirm('Do you want to resume Horizon?')) {
                $this->info('Resuming Horizon.');
                $this->call('horizon:continue');
            } else {
                $this->info('You can resume Horizon by running:');
                $this->info('php artisan horizon:continue');
            }
        }

        $this->info('Horizon is already running...');
        return static::SUCCESS;
    }

    private function startHorizon(): int
    {
        $this->line('Starting Horizon...');
        $phpPath = $this->option('php-path') ?? 'php';
        $fp = popen("{$phpPath} artisan horizon", "r");
        while (!feof($fp)) {
            $buffer = fgets($fp, 4096);
            echo $buffer;
        }
        $this->error("Horizon was terminated and could not be started");
        pclose($fp);

        return static::FAILURE;
    }
}
