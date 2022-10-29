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
}
