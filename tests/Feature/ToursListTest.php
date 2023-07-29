<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToursListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tours_list_by_travel_slug_returns_correct_tours()
    {
        $travel = Travel::factory()->create(['is_public' => true]);
        $tour = Tour::factory()->create(['travel_id' => $travel->id]);

        $response = $this->get('api/v1/travels/' . $travel->slug . '/tours');

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $tour->id]);
    }

    public function test_tours_list_returns_paginated_data_correctly()
    {
        $travel = Travel::factory()->create(['is_public' => true]);
        Tour::factory(16)->create(['travel_id' => $travel->id]);

        $response = $this->get('api/v1/travels/' . $travel->slug . '/tours');

        $response->assertStatus(200);
        $response->assertJsonCount(15, 'data');
        $response->assertJsonPath('meta.last_page', 2);
    }

    public function test_tours_list_sorts_by_price_correctly()
    {
        $travel = Travel::factory()->create(['is_public' => true]);

        $earlier_tour = Tour::factory()->create([
            'travel_id' => $travel->id,
            'price' => 100,
        ]);

        $later_tour = Tour::factory()->create([
            'travel_id' => $travel->id,
            'price' => 200,
        ]);

        $response = $this->get('api/v1/travels/' . $travel->slug . '/tours?sortBy=price&sortOrder=asc');

        $response->assertStatus(200);
        $response->assertJsonPath('data.0.id', $earlier_tour->id);
        $response->assertJsonPath('data.1.id', $later_tour->id);
    }

    public function test_tour_list_returns_validation_errors()
    {
        $travel = Travel::factory()->create(['is_public' => true]);

        $response = $this->get('api/v1/travels/' . $travel->slug . '/tours?priceFrom=asdasd');

        $response->assertStatus(422);
    }
}
