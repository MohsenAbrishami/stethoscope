<?php

namespace Tests\Features\APIs;

use MohsenAbrishami\Stethoscope\Models\ResourceLog;
use Tests\TestCase;

class MonitorCurrentTest extends TestCase
{
    function test_get_resource_current_state()
    {
        $this->get('monitor/current')
            ->assertOk()
            ->assertJsonStructure(['cpu', 'memory', 'network', 'web_server', 'hard_disk']);
    }

    public function test_get_resource_logs_history()
    {
        ResourceLog::factory()->create();

        $this->get('monitor/history')->assertOk();
    }
}
