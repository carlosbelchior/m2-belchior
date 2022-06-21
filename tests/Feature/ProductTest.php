<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_a_successful_response_all_product()
    {
        $response = $this->get('/api/product/all');
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_insert_product()
    {
        $response = $this->post('/api/product/insert', ['name' => 'Test', 'price' => 12.00]);
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_update_product()
    {
        $response = $this->post('/api/product/update/1', ['name' => 'Test']);
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_delete_product()
    {
        $response = $this->get('/api/product/delete/1');
        $response->assertStatus(200);
    }

    public function test_return_a_error_404_response_all_product()
    {
        $response = $this->get('/api/product/all/1');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_insert_product()
    {
        $response = $this->post('/api/product/insert/1');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_update_product()
    {
        $response = $this->post('/api/product/update/');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_delete_product()
    {
        $response = $this->get('/api/product/delete/');
        $response->assertStatus(404);
    }

    public function test_return_a_error_405_response_all_product()
    {
        $response = $this->post('/api/product/all');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_insert_product()
    {
        $response = $this->get('/api/product/insert');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_update_product()
    {
        $response = $this->get('/api/product/update/1');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_delete_product()
    {
        $response = $this->post('/api/product/delete/1');
        $response->assertStatus(405);
    }

    public function test_return_a_error_400_response_insert_product()
    {
        $response = $this->post('/api/product/insert', ['name' => NULL, 'price' => NULL]);
        $response->assertStatus(400);
    }
}
