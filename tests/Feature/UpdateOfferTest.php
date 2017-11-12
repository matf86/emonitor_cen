<?php

namespace Tests\Feature;

use App\Offer;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateOfferTest extends TestCase
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
    public function unauthenticated_user_can_not_update_an_offer()
    {
        $product = Offer::where('date', new Carbon('2017-05-10'))->first();

        $response = $this->json('patch', "/dashboard/offers/".$product->_id, [
            'product' => 'Pomelo',
            'type' => 'Owoce',
            'origin' => 'Import',
            'package' => '10kg',
            'price_min' => '10',
            'price_max' => '25',
        ]);

        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function authenticated_user_can_update_existing_offer_for_given_market()
    {
        $user = User::first();
        $product = Offer::where('date', new Carbon('2017-05-10'))->first();

        $response = $this->actingAs($user)->json('patch', "/dashboard/offers/".$product->_id, [
            'product' => 'Pomelo',
            'type' => 'Owoce',
            'origin' => 'Import',
            'package' => '10kg',
            'price_min' => '10',
            'price_max' => '25',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('offers', ['_id' => $product->_id, 'product' => 'Pomelo']);
        $this->assertDatabaseMissing('offers', ['_id' => $product->_id, 'product' => $product->product]);
    }

    /**
     * @test
     */
    public function user_gets_response_when_he_pass_wrong_offer_parameters_when_updating()
    {
        $user = User::first();
        $product = Offer::where('date', new Carbon('2017-05-10'))->first();

        $response = $this->actingAs($user)->json('patch', "/dashboard/offers/".$product->_id, [
            'product' => 'Pomelo',
            'type' => 'test_type',
            'origin' => 'test_origin',
            'package' => '10kg',
            'price_min' => '10',
            'price_max' => '25',
        ]);

        $response->assertStatus(422);
    }
}
