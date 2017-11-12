<?php

namespace Tests\Unit;

use App\Market;
use App\Offer;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OfferTest extends TestCase
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
    public function it_shows_number_of_offers_for_given_market_grouped_by_date()
    {
        $markets = Market::all()->pluck('_id')->toArray();
        $dateRange = [new Carbon('10-05-2017'), new Carbon('11-05-2017')];
        $offer = new Offer();

        $data = $offer->countByDateAndMarket($markets, $dateRange);

        $data =$data->toArray();

        $this->assertCount(4, $data);
        $this->assertEquals(5, $data[0]['count']);
    }

    /**
     * @test
     */
    public function it_shows_all_distinct_types_of_products()
    {
       $offer = new Offer();

       $types = $offer->getTypes();

       $this->assertCount(2, $types);
    }

    /**
     * @test
     */
    public function it_shows_all_distinct_origins_of_products()
    {
        $offer = new Offer();

        $origins = $offer->getOrigins();

        $this->assertCount(2, $origins);
    }
}
