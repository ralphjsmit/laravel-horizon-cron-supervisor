<?php

namespace RalphJSmit\LaravelHorizonCron\Supervisor\Tests;

use RalphJSmit\LaravelHorizonCron\SupervisorServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    // additional setup
  }

  protected function getPackageProviders($app)
  {
    return [
		SupervisorServiceProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    // perform environment setup
  }
}