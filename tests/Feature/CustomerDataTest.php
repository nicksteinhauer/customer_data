<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerDataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_customer_api_has_name()
    {
        $response = $this->get('/api/customerdata/847-55-7996');
        $response->assertStatus(200)->assertSee('Manny Trent');
    }

    public function test_customer_api_wrong_token_returns_404()
    {
        $response = $this->get('/api/customerdata/ein-token-der-nicht-existiert');
        $response->assertStatus(404);
    }

}
