<?php

namespace Tests\Unit;

use App\Market;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MarketTest extends TestCase
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
    public function market_has_offers()
    {
        $market = Market::first();

        $this->assertInstanceOf('App\Offer', $market->offers[0]);
    }

    /**
     * @test
     */
    public function market_has_logs()
    {
        $market = Market::first();

        $this->assertInstanceOf('App\Log', $market->logs[0]);
    }

    /**
     * @test
     */
    public function market_knows_date_of_latest_offer()
    {
        $market = Market::first();
        $latestDateFromTestDB = '16-05-2017';

        $latestDate = $market->getLatestOfferDate();

        $this->assertEquals($latestDate->toDateTime(), new Carbon($latestDateFromTestDB));
    }

    /**
     * @test
     */
    public function market_knows_number_of_offers_in_given_date()
    {
        $market = Market::first();
        $date = new Carbon('15-05-2017');

        $offersCount = $market->getOffersCount($date);

        $this->assertEquals($offersCount, 5);
    }

}
