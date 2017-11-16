<?php

namespace Tests\Feature;

use App\Market;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateOfferTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();


        $this->seed('TestDatabaseSeeder');
    }

    /**
     * @test
     */
    public function unauthenticated_user_can_not_create_an_offer()
    {
        $market_id = Market::where('slug', 'wgro')->pluck('_id');
        $date = '2017-05-10';

        $response = $this->json('post', "/dashboard/offers", [
            'product' => 'Pomelo',
            'type' => 'Owoce',
            'origin' => 'Import',
            'package' => '10kg',
            'market_id' => $market_id[0],
            'price_min' => '10',
            'price_max' => '25',
            'date' => $date,
        ]);

        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function authenticated_user_can_add_offer_for_given_market()
    {
        $user = User::first();
        $market_id = Market::where('slug', 'wgro')->pluck('_id');
        $date = '2017-05-10';

        $response = $this->actingAs($user)->json('post', "/dashboard/offers", [
            'product' => 'Pomelo',
            'type' => 'owoce',
            'origin' => 'import',
            'package' => '10kg',
            'market_id' => $market_id[0],
            'price_min' => '10',
            'price_max' => '25',
            'date' => $date,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('offers', ['product' => 'Pomelo']);
    }

    /**
     * @test
     */
    public function user_gets_response_when_he_pass_wrong_offer_parameters_when_creating()
    {
        $user = User::first();
        $market_id = Market::where('slug', 'wgro')->pluck('_id');
        $date = '2017-05-10';

        $response = $this->actingAs($user)->json('post', "/dashboard/offers", [
            'product' => 123,
            'type' => 'Test',
            'origin' => 'Test',
            'package' => '10kg',
            'market_id' => $market_id[0],
            'price_min' => '10',
            'price_max' => 'test_string',
            'date' => $date,
        ]);

        $response->assertStatus(422);
    }
}
