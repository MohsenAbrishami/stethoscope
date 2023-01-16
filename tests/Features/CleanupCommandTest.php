<?php

namespace Test\Features;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;
use Tests\TestCase;

class CleanupCommandTest extends TestCase
{
    use WithFaker;

    public function test_delete_old_resource_logs_from_database()
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

    public function test_delete_old_resource_log_files()
    {
        $oldLog = ResourceLog::factory()->create([
            'created_at' => $this->faker->dateTimeBetween('-15 days', '-7 days')
        ]);

        $newLog = ResourceLog::factory()->create([
            'created_at' => $this->faker->dateTimeBetween('-7 days')
        ]);

        $this->artisan('stethoscope:clean')->assertOk();

        $path = config('stethoscope.log_file_storage.path');

        Storage::assertMissing($path . $oldLog->created_at->toDateString());
        Storage::assertExists($path . $newLog->created_at->toDateString());
    }
}
