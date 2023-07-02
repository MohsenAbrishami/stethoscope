<?php

namespace Tests\Features\APIs;

use MohsenAbrishami\Stethoscope\Models\ResourceLog;
use Tests\TestCase;

class MonitorTest extends TestCase
{
    public function test_get_resource_current_state()
    {
        $this->enableMonitoring();

        $this->get('monitor/current')
            ->assertOk()
            ->assertJsonStructure(['cpu', 'memory', 'network', 'web_server', 'hard_disk']);
    }

    public function test_get_resources_log_history()
    {
        $this->enableMonitoring();

        $yesterday = now()->subDay(1)->format('Y-m-d');
        $today = now();

        ResourceLog::factory(5, [
            'resource' => 'cpu',
            'created_at' => $yesterday,
            'updated_at' => $yesterday,
        ])->create();

        ResourceLog::factory([
            'resource' => 'cpu',
        ])->create();

        $this->get("monitor/history/$yesterday/$today")
            ->assertOk()
            ->assertJsonFragment(['cpu' => [5, 1]]);
    }

    private function enableMonitoring()
    {
        config()->set('stethoscope.monitoring_panel.status', 'true');
    }
}
