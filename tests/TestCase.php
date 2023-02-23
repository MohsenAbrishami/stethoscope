<?php

namespace Tests;

use Mockery\MockInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MohsenAbrishami\Stethoscope\Services\HardDisk;
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
            $this->mock($service, function (MockInterface $mock) use ($service, $mockValue) {
                if ($service === HardDisk::class){
                    $mock->shouldReceive('check')->between(0, count(config("stethoscope.hard_disks")))->andReturn($mockValue);
                }else{
                    $mock->shouldReceive('check')->once()->andReturn($mockValue);
                }
            });
        }
    }
}
