<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FetchOffersTest extends TestCase
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
    public function user_fetch_latest_offers_when_there_are_no_filters_in_url()
    {
        $slug = 'wgro';
        $offersCount = 5;
        $latestDate = '2017-05-15';

        $response = $this->json('get',"/markets/{$slug}/offers");
        $offers = $response->json();
        $offersDate = $offers['data'][0]['date'];

        $response->assertStatus(200);
        $this->assertCount($offersCount, $offers['data']);
        $this->assertEquals($latestDate, $offersDate);
    }

    /**
     * @test
     */
    public function user_gets_response_where_there_are_no_data_for_given_resource_call()
    {
        $slug = 'wgro';
        $date = '2017-05-01';

        $response = $this->json('get',"/markets/{$slug}/offers?date={$date}");

        $this->assertEquals('no data', $response->json()['status']);
    }

    /**
     * @test
     */
    public function user_get_404_status_when_he_pass_wrong_slug()
    {
        $slug = 'wrong_test_slug';

        $response = $this->json('get',"/markets/{$slug}/offers");

        $response->assertStatus(404);
    }


    /**
     * @test
     */
    public function user_can_filter_offers_by_date()
    {
        $slug = 'wgro';
        $date = '2017-05-10';

        $response = $this->get("/markets/{$slug}/offers?date={$date}");

        $offers = $response->json()['data'];
        $offersDate = $offers[0]['date'];

        $this->assertCount(5, $offers);
        $this->assertEquals('2017-05-10', $offersDate);
    }

    /**
     * @test
     */
    public function user_can_filter_offers_by_product()
    {
        $slug = 'wgro';
        $product = 'Cytryny';

        $response = $this->get("/markets/{$slug}/offers?product={$product}");

        $offers = $response->json()['data'];
        $offerProduct = $offers[0]['product'];

        $this->assertCount(6, $offers);

        $this->assertEquals($product, $offerProduct);
    }

    /**
     * @test
     */
    public function user_can_filter_offers_by_date_range()
    {
        $slug = 'wgro';
        $from = '2017-05-10';
        $to = '2017-05-12';

        $response = $this->get("/markets/{$slug}/offers?dateRange[]={$from}&dateRange[]={$to}");

        $uniqueDates = collect($response->json()['data'])->map(function($item) {
            return $item['date'];
        })->unique();

        $maxDate = $uniqueDates->max();
        $minDate = $uniqueDates->min();

        $this->assertEquals($from, $minDate);
        $this->assertEquals($to, $maxDate);

    }

    /**
     * @test
     */
    public function user_can_fetch_offers_data_for_given_product_in_time_range()
    {
        $slug = 'wgro';
        $product = 'Cytryny';
        $from = '2017-05-10';
        $to = '2017-05-14';

        $response = $this->get("/markets/{$slug}/offers?product={$product}&dateRange[]={$from}&dateRange[]={$to}");

        $uniqueDates = collect($response->json()['data'])->map(function($item) {
            return $item['date'];
        })->unique();

        $maxDate = $uniqueDates->max();
        $minDate = $uniqueDates->min();
        $offers = $response->json()['data'];
        $offerProduct = $offers[0]['product'];


        $this->assertEquals($from, $minDate);
        $this->assertEquals($to, $maxDate);
        $this->assertCount(5, $offers);
        $this->assertEquals($product, $offerProduct);
    }

    /**
     * @test
     */
    public function user_get_error_message_when_wrong_date_query_string_is_passed()
    {
        $slug = 'wgro';
        $invalid_query = ['01-09-2017', '', 1234, '2017/09/01'];

        foreach ($invalid_query as $query) {
            $response = $this->json('get',"/markets/{$slug}/offers?date={$query}");

            $message = $response->json()['date'][0];

            $this->assertEquals('Błędny parametr date. Akceptowany format Y-m-d.', $message);
        }
    }

    /**
     * @test
     */
    public function user_get_error_message_when_dateRange_query_string_is_not_array()
    {
        $slug = 'wgro';
        $dateRange = '2017-10-05';

        $response = $this->json('get',"/markets/{$slug}/offers?dateRange={$dateRange}");


        $message = $response->json()['dateRange'][0];

        $this->assertEquals('Błędny parametr date range. Akceptowany typ: array.', $message);
    }


    /**
     * @test
     */
    public function user_get_error_message_when_wrong_dateRange_query_string_is_passed()
    {
        $slug = 'wgro';
        $from = '05-10-2017';
        $to = '15-10-2017';

        $response = $this->json('get',"/markets/{$slug}/offers?dateRange[]={$from}&dateRange[]={$to}");
        $message = $response->json()['dateRange.0'][0];

        $this->assertEquals('Błędny parametr dateRange.0. Akceptowany format Y-m-d.', $message);

        $from = 1234;
        $to = '';

        $response = $this->json('get',"/markets/{$slug}/offers?dateRange[]={$from}&dateRange[]={$to}");
        $message = $response->json();

        $this->assertEquals('Błędny parametr dateRange.0. Akceptowany format Y-m-d.', $message['dateRange.0'][0]);
        $this->assertEquals('Błędny parametr dateRange.1. Akceptowany format Y-m-d.', $message['dateRange.1'][0]);
    }


}
