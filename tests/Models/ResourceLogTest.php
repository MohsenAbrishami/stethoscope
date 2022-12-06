<?php

namespace Tests\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;
use Tests\TestCase;

class ResourceLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_resource_log_has_a_resource()
    {
        $resource = ResourceLog::factory()->create(['resource' => 'cpu']);

        $this->assertEquals('cpu', $resource->resource);
    }
}