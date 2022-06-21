<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_a_successful_response_all_city()
    {
        $response = $this->get('/api/city/all');
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_insert_city()
    {
        $response = $this->post('/api/city/insert', ['name' => 'Test']);
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_update_city()
    {
        $response = $this->post('/api/city/update/1', ['name' => 'Test']);
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_delete_city()
    {
        $response = $this->get('/api/city/delete/1');
        $response->assertStatus(200);
    }

    public function test_return_a_error_404_response_all_city()
    {
        $response = $this->get('/api/city/all/1');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_insert_city()
    {
        $response = $this->post('/api/city/insert/1');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_update_city()
    {
        $response = $this->post('/api/city/update/');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_delete_city()
    {
        $response = $this->get('/api/city/delete/');
        $response->assertStatus(404);
    }

    public function test_return_a_error_405_response_all_city()
    {
        $response = $this->post('/api/city/all');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_insert_city()
    {
        $response = $this->get('/api/city/insert');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_update_city()
    {
        $response = $this->get('/api/city/update/1');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_delete_city()
    {
        $response = $this->post('/api/city/delete/1');
        $response->assertStatus(405);
    }

    public function test_return_a_error_400_response_insert_city()
    {
        $response = $this->post('/api/city/insert', ['name' => NULL]);
        $response->assertStatus(400);
    }
}
