<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_invoice_api_amount_check_can_be_false()
    {
        $response = $this->get('/api/invoice/847-55-7996');
        $this->assertFalse($response->assertStatus(200)->json('amount_check'));
    }
}
