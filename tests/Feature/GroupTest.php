<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_a_successful_response_all_groups()
    {
        $response = $this->get('/api/groups/all');
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_insert_groups()
    {
        $response = $this->post('/api/groups/insert', ['name' => 'Test']);
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_update_groups()
    {
        $response = $this->post('/api/groups/update/1', ['name' => 'Test']);
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_delete_groups()
    {
        $response = $this->get('/api/groups/delete/1');
        $response->assertStatus(200);
    }

    public function test_return_a_error_404_response_all_groups()
    {
        $response = $this->get('/api/groups/all/1');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_insert_groups()
    {
        $response = $this->post('/api/groups/insert/1');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_update_groups()
    {
        $response = $this->post('/api/groups/update/');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_delete_groups()
    {
        $response = $this->get('/api/groups/delete/');
        $response->assertStatus(404);
    }

    public function test_return_a_error_405_response_all_groups()
    {
        $response = $this->post('/api/groups/all');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_insert_groups()
    {
        $response = $this->get('/api/groups/insert');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_update_groups()
    {
        $response = $this->get('/api/groups/update/1');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_delete_groups()
    {
        $response = $this->post('/api/groups/delete/1');
        $response->assertStatus(405);
    }

    public function test_return_a_error_400_response_insert_groups()
    {
        $response = $this->post('/api/groups/insert', ['name' => NULL]);
        $response->assertStatus(400);
    }
}
