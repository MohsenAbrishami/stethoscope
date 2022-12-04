<?php

namespace Tests\Models;

use MohsenAbrishami\Stethoscope\Models\ResourceLog;
use Tests\TestCase;

class ResourceLogTest extends TestCase
{
    public function test_resource_log_has_a_resource()
    {
        $resource = ResourceLog::factory()->create(['resource' => 'cpu']);

        $this->assertEquals('cpu', $resource->resource);
    }
}