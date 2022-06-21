<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_a_successful_response_all_campaigns()
    {
        $response = $this->get('/api/campaigns/all');
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_insert_campaigns()
    {
        $response = $this->post('/api/campaigns/insert', ['name' => 'Test']);
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_update_campaigns()
    {
        $response = $this->post('/api/campaigns/update/1', ['name' => 'Test']);
        $response->assertStatus(200);
    }

    public function test_return_a_successful_response_delete_campaigns()
    {
        $response = $this->get('/api/campaigns/delete/1');
        $response->assertStatus(200);
    }

    public function test_return_a_error_404_response_all_campaigns()
    {
        $response = $this->get('/api/campaigns/all/1');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_insert_campaigns()
    {
        $response = $this->post('/api/campaigns/insert/1');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_update_campaigns()
    {
        $response = $this->post('/api/campaigns/update/');
        $response->assertStatus(404);
    }

    public function test_return_a_error_404_response_delete_campaigns()
    {
        $response = $this->get('/api/campaigns/delete/');
        $response->assertStatus(404);
    }

    public function test_return_a_error_405_response_all_campaigns()
    {
        $response = $this->post('/api/campaigns/all');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_insert_campaigns()
    {
        $response = $this->get('/api/campaigns/insert');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_update_campaigns()
    {
        $response = $this->get('/api/campaigns/update/1');
        $response->assertStatus(405);
    }

    public function test_return_a_error_405_response_delete_campaigns()
    {
        $response = $this->post('/api/campaigns/delete/1');
        $response->assertStatus(405);
    }

    public function test_return_a_error_400_response_insert_campaigns()
    {
        $response = $this->post('/api/campaigns/insert', ['name' => NULL]);
        $response->assertStatus(400);
    }

}
