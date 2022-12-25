<?php

namespace Tests;

use Mockery\MockInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MohsenAbrishami\Stethoscope\StethoscopeServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

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
