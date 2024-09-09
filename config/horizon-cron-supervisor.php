<?php

return [
    /**
     * Enables Horizon Cron Supervisor
     */
    'enabled' => env('HORIZON_CRON_SUPERVISOR_ENABLED', true),

    /**
     * Run every X minutes or define a cron expression like "0,20,40 * * * *"
     */
    'schedule' => env('HORIZON_CRON_SUPERVISOR_SCHEDULE', 3),
];