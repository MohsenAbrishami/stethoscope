<?php

namespace Test\Features;

use Tests\TestCase;

class CleanupCommandTest extends TestCase
{
    public function test_delete_resource_logs_older_than_specified_number_of_days_in_config()
    {
        $this->artisan('stethoscope:clean');
    }
}