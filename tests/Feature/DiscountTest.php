<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DiscountTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_a_successful_response_all_discounts()
    {
        $response = $this->get('/api/discounts/all');
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_insert_discounts()
    {
        $response = $this->post('/api/discounts/insert', ['product_id' => 1, 'campaign_id' => 1, 'discount' => 0.99]);
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_update_discounts()
    {
        $response = $this->post('/api/discounts/update/1', ['product_id' => 1]);
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_delete_discounts()
    {
        $response = $this->get('/api/discounts/delete/1');
        $response->assertStatus(200);
    }

    public function test_return_a_error_404_response_all_discounts()
    {
        $response = $this->get('/api/discounts/all/1');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_insert_discounts()
    {
        $response = $this->post('/api/discounts/insert/1');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_update_discounts()
    {
        $response = $this->post('/api/discounts/update/');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_delete_discounts()
    {
        $response = $this->get('/api/discounts/delete/');
        $response->assertStatus(404);
    }

    public function test_return_a_error_405_response_all_discounts()
    {
        $response = $this->post('/api/discounts/all');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_insert_discounts()
    {
        $response = $this->get('/api/discounts/insert');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_update_discounts()
    {
        $response = $this->get('/api/discounts/update/1');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_delete_discounts()
    {
        $response = $this->post('/api/discounts/delete/1');
        $response->assertStatus(405);
    }

    public function test_return_a_error_400_response_insert_discounts()
    {
        $response = $this->post('/api/discounts/insert', ['product_id' => NULL, 'campaign_id' => 1, 'discount' => 0.99]);
        $response->assertStatus(400);
    }
}
