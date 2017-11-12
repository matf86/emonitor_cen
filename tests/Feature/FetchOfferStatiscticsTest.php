<?php

namespace Tests\Feature;

use App\Market;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FetchOfferStatiscticsTest extends TestCase
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
    public function unauthenticated_user_can_not_fetch_offers_stats_data()
    {
        $ids = Market::all()->pluck('id')->toArray();
        $from = '2017-05-10';
        $to = '2017-05-14';

        $response = $this->json('get', '/dashboard/offers/stats/count', [
            'markets' => $ids,
            'dateRange' => [$from, $to]
        ]);

        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function authenticated_user_can_fetch_offers_count_per_day_in_given_market()
    {
        $user = User::first();
        $id = Market::whereSlug('wgro')->get()->pluck('id')->toArray();
        $from = '2017-05-10';
        $to = '2017-05-14';

        $response = $this->actingAs($user)->json('get', '/dashboard/offers/stats/count', [
            'markets' => $id,
            'dateRange' => [$from, $to]
        ]);

        $stats = $response->json()['data'];

        $market_ids = collect($stats)->unique('market_id')->toArray();

        $response->assertStatus(200);
        $this->assertEquals(5, $stats[0]['count']);
        $this->assertCount(5, $stats);
        $this->assertEquals(count($id), count($market_ids));
    }

    /**
     * @test
     */
    public function user_fetch_offers_count_from_all_markets_and_last_30_days_when_no_query_params_was_specified()
    {
        $user = User::first();
        $ids = Market::all()->pluck('id')->toArray();

        $response = $this->actingAs($user)->json('get', '/dashboard/offers/stats/count');

        $stats = $response->json()['data'];

        $market_ids = collect($stats)->unique('market_id')->toArray();

        $response->assertStatus(200);
        $this->assertEquals(5, $stats[0]['count']);
        $this->assertCount(12, $stats);
        $this->assertEquals(count($ids), count($market_ids));
    }

    /**
     * @test
     */
    public function user_gets_error_message_when_wrong_query_params_where_passed()
    {
        $user = User::first();
        $id = Market::whereSlug('wgro')->get()->pluck('id')->toArray();
        $from = 'wrong_param';

        $response = $this->actingAs($user)->json('get', '/dashboard/offers/stats/count', [
            'markets' => $id,
            'dateRange' => [$from]
        ]);

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function user_gets_offers_count_from_all_markets_when_markets_query_param_is_ommited()
    {
        $user = User::first();
        $from = '2017-05-10';
        $to = '2017-05-11';

        $response = $this->actingAs($user)->json('get', '/dashboard/offers/stats/count', [
            'dateRange' => [$from, $to]
        ]);

        $stats = $response->json()['data'];

        $market_ids = collect($stats)->unique('market_name')->toArray();
        $db_markets_count = Market::all()->pluck('name')->count();


        $response->assertStatus(200);
        $this->assertEquals(5, $stats[0]['count']);
        $this->assertCount($db_markets_count, $market_ids);
    }

//    /**
//     * @test
//     */
//    public function user_gets_no_data_message_and_404_status_code_when_markets_query_param_array_value_is_set_to_null()
//    {
//        $user = User::first();
//        $from = '2017-05-10';
//        $to = '2017-05-11';
//
//        $response = $this->actingAs($user)->json('get', '/dashboard/offers/stats/count', [
//            'markets' => [null],
//            'dateRange' => [$from, $to]
//        ]);
//
//        $stats = $response->json()['data'];
//
//        $response->assertStatus(404);
//        $this->assertCount(0, $stats);
//        $this->assertEquals('no data',  $response->json()['status']);
//    }
}






