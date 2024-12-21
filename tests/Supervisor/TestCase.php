<?php

namespace RalphJSmit\LaravelHorizonCron\Supervisor\Tests;

use RalphJSmit\LaravelHorizonCron\SupervisorServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            SupervisorServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        //
    }
}
