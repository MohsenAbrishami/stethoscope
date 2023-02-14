<?php

namespace Tests\Features\APIs;

use Tests\TestCase;

class MonitorCurrentTest extends TestCase
{
    function test_monitor_current_state_server()
    {
        $this->get('monitor/current')
            ->assertOk()
            ->assertJsonStructure(['cpu', 'memory', 'network', 'web_server', 'hard_disk']);
    }
}
