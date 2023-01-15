<?php

namespace Test\Features;

use Illuminate\Foundation\Testing\WithFaker;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;
use Tests\TestCase;

class CleanupCommandTest extends TestCase
{
    use WithFaker;

    public function test_delete_resource_logs_older_than_specified_number_of_days_in_config()
    {
        $result = ResourceLog::factory(5)->create([
            'created_at' => $this->faker->dateTimeBetween($startDate = '-7 days', $endDate = '+7 days')
        ]);

        $result = $result->toArray();

        $this->artisan('stethoscope:clean');

        $this->assertDatabaseMissing('resource_logs', $result);
    }
}
