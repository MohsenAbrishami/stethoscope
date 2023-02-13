<?php

namespace Tests\Features;

use Tests\TestCase;

class StatusTest extends TestCase
{
    function test_get_statuses()
    {
        $this->get('/statuses')
            ->assertOk()
            ->assertJsonStructure(['cpu', 'memory', 'network', 'web_server', 'hard_disk']);
    }
}
