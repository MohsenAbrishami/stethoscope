<?php

namespace Test\Features;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;
use Tests\TestCase;

class CleanupCommandTest extends TestCase
{
    use WithFaker;

    public function test_delete_resource_logs_older_than_specified_number_of_days_in_config()
    {
        Config::set('stethoscope.drivers.log_record', 'database');
        
        $oldLogId = ResourceLog::factory()->create([
            'created_at' => $this->faker->dateTimeBetween('-15 days', '-7 days')
        ])->id;

        $newLogId = ResourceLog::factory()->create([
            'created_at' => $this->faker->dateTimeBetween('-7 days')
        ])->id;

        $this->artisan('stethoscope:clean')->assertOk();

        $this->assertDatabaseMissing('resource_logs', ['id' => $oldLogId]);
        $this->assertDatabaseHas('resource_logs', ['id' => $newLogId]);
    }
}
