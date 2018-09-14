<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

		$response->assertStatus(200);
		$response->assertSee('Laratter');
	}
	

	public function testCanSearchForMessages()
	{
		// this->get call the base path and add the parameter that we are passing
		$response = $this->get('messages?query=Tercero');

		$response->assertSee('Tercero');
	}
}
