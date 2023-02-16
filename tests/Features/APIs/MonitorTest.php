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

    public function test_get_resource_log_histories()
    {
        $yesterday = now()->subDay(1)->format('Y-m-d');

        $yesterdayLog = ResourceLog::factory([
            'created_at' => $yesterday,
            'updated_at' => $yesterday
        ])->create();

        $todayLog = ResourceLog::factory()->create();

        $this->get("monitor/history/$yesterday/$yesterday")
            ->assertOk()
            ->assertJsonFragment($yesterdayLog->toArray())
            ->assertJsonMissing($todayLog->toArray());
    }
}
