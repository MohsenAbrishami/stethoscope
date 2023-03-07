<?php

namespace Tests\Features\APIs;

use MohsenAbrishami\Stethoscope\Models\ResourceLog;
use Tests\TestCase;

class MonitorTest extends TestCase
{
    function test_get_resource_current_state()
    {
        $this->get('monitor/current')
            ->assertOk()
            ->assertJsonStructure(['cpu', 'memory', 'network', 'web_server', 'hard_disk']);
    }

    public function test_get_resources_log_history()
    {
        $yesterday = now()->subDay(1)->format('Y-m-d');

        ResourceLog::factory(5, ['created_at' => $yesterday, 'updated_at' => $yesterday])->create();

        ResourceLog::factory()->create();

        $this->get("monitor/history/$yesterday/$yesterday")
            ->assertOk()
            ->assertJsonFragment(['date' => $yesterday, 'count(date)' => 5])
            ->assertJsonMissing(['date' => now()]);
    }
}
