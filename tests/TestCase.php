<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
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

    protected function mockServices($services)
    {
        foreach ($services as $service => $mockValue) {
            $this->mock($service, function (MockInterface $mock) use ($mockValue) {
                $mock->shouldReceive('check')->once()->andReturn($mockValue);
            });
        }
    }
}
