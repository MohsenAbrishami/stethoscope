<?php

namespace Tests\Commands;

use MohsenAbrishami\Stethoscope\Models\ResourceLog as ModelsResourceLog;
use Tests\TestCase;

class ResourceLog extends TestCase
{
    public function test_resource_log_has_a_resource()
    {
        $resource = ModelsResourceLog::factory()->create(['resource' => 'cpu']);

        $this->assertEquals('cpu', $resource->resource);
    }
}