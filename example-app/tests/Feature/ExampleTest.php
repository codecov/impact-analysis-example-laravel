<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_welcome()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Get the Time');
    }

    public function test_example()
    {
        //time travel just to freeze the clock.
        $this->travel(-5)->hours();
        $time = now();

        $response = $this->get('/example');
        $response->assertStatus(200);
        $response->assertViewHas('time', $value = $time);
    }
}
