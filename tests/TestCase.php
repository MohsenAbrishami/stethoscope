<?php

namespace Tests;

use Mockery\MockInterface;
use MohsenAbrishami\Stethoscope\StethoscopeServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            StethoscopeServiceProvider::class,
        ];
    }

    protected function mockService($service, $mockValue)
    {
        $this->mock($service, function (MockInterface $mock) use ($mockValue) {
            $mock->shouldReceive('check')->once()->andReturn($mockValue);
        });
    }

    public function getEnvironmentSetUp($app)
    {
        $resourceLogMigration = include_once __DIR__ . '/../database/migrations/2022_12_03_070906_create_resource_logs_table.php';

        $resourceLogMigration->up();
    }
}
