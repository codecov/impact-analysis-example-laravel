<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\TimeService;

class TimeServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_Now()
    {
        $this->travel(-5)->hours();
        $time = now();
        $this->assertEquals(TimeService::getNow(), $time);
    }
}
