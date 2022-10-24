<?php

namespace Tests\Commands;

use Tests\TestCase;

/**
 * @covers \MohsenAbrishami\Stethosope\Commands\ListenCommandTest
 */
class ListenCommandTest extends TestCase
{
    public function test_assert_success_stethoscope_listen_command()
    {
        $this->artisan('stethoscope:listen')
            ->assertSuccessful();
    }
}
