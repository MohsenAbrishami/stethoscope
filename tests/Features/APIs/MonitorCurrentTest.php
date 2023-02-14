<?php

namespace Tests\Features\APIs;

use Tests\TestCase;

class MonitorCurrentTest extends TestCase
{
    function test_get_statuses()
    {
        $this->get('monitor/current')
            ->assertOk()
            ->assertJsonStructure(['cpu', 'memory', 'network', 'web_server', 'hard_disk']);
    }
}
