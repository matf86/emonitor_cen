<?php

namespace Tests\Feature;

use App\Market;
use App\Offer;
use App\User;
use Carbon\Carbon;
use MongoDB\BSON\ObjectID;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteOffersTest extends TestCase
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
    public function unauthenticated_user_can_not_delete_an_offer()
    {
        $slug = 'wgro';
        $date = '2017-05-10';

        $response = $this->json('delete', "/dashboard/markets/{$slug}/offers", [
            'date' => $date,
        ]);

        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function authenticated_user_can_delete_all_offers_from_given_market_on_given_date()
    {
        $user = User::first();
        $market = Market::where('slug', 'wgro')->get()->toArray();

        $date = '2017-05-10';

        $response = $this->actingAs($user)->json('delete', "/dashboard/markets/{$market[0]['slug']}/offers", [
            'date' => $date,
        ]);

        $offers = Offer::where('market_id', new ObjectID($market[0]['_id']))
                        ->where('date',new Carbon($date))->get();

        $response->assertStatus(200);
        $this->assertCount(0, $offers);
    }

    /**
     * @test
     */
    public function when_date_parameter_is_not_specified_delete_action_is_stoped()
    {
        $user = User::first();
        $market = Market::where('slug', 'wgro')->get()->toArray();

        $response = $this->actingAs($user)->json('delete', "/dashboard/markets/{$market[0]['slug']}/offers");

        $response->assertStatus(422);
    }
}
