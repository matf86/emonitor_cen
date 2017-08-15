<?php

namespace Tests\Unit;

use App\Exceptions\EmptyResourceException;
use App\Offer;
use App\Place;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OfferTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();

        Cache::flush();
    }

    /***
     * @test
     */
    public function testItCanFetchDateOfLatestOfferForGivenMarketPlace()
    {
        $this->seed('TestDatabaseSeeder');

        $date = Carbon::createFromFormat('Y-m-d', '2017-05-15');

        $placeId = Place::whereSlug('wgro')->firstOrfail()->id;


        $result_date = app()->make(Offer::class)->getLatestDate($placeId);


        $this->assertInstanceOf('Carbon\Carbon', $result_date);

        $this->assertEquals($date->toDateString(), $result_date->toDateString());

    }


    /***
     * @test
     */
    public function testItCanFetchDataAboutOfferedProductsInGivenTimeRangeForGivenMarketPlace()
    {
        $this->seed('TestDatabaseSeeder');

        $dateStartPoint = Carbon::createFromFormat('Y-m-d', '2017-05-10');
        $dateEndpoint = Carbon::createFromFormat('Y-m-d', '2017-05-15');
        $placeId = Place::whereSlug('wgro')->firstOrfail()->id;
        $name = 'Banany';


        $result = app()->make(Offer::class)
            ->getProductInTimeRange($name, $placeId, $dateStartPoint, $dateEndpoint);


        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(5, $result->count());
    }

    /***
     * @test
     */
    public function testItThrowEmptyResourceExceptionWhenThereAreNoProductsOffersInGivenTimeRange()
    {
        $this->seed('TestDatabaseSeeder');

        $dateStartPoint = Carbon::createFromFormat('Y-m-d', '2017-01-01');
        $dateEndpoint = Carbon::createFromFormat('Y-m-d', '2017-01-15');
        $placeId = Place::whereSlug('wgro')->firstOrfail()->id;
        $name = 'Banany';

        $this->expectException(EmptyResourceException::class);

        app()->make(Offer::class)
             ->getProductInTimeRange($name, $placeId, $dateStartPoint, $dateEndpoint);

    }


    /***
     * @test
     */
    public function testItFetchAllOffersForGivenDateInSpecifiedMarketPlace()
    {
        $this->seed('TestDatabaseSeeder');

        $slug = 'wgro';
        $date = Carbon::createFromFormat('Y-m-d H:i:s', '2017-05-12 00:00:00');
        $placeId = Place::whereSlug($slug)->firstOrfail()->id;

        $result = app()->make(Offer::class)->getByDate($slug, $placeId, $date);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(5, $result->count());

    }

    /***
     * @test
     */
    public function testItThrowEmptyResourceExceptionIfThereIsNoOffersForGivenDate()
    {
        $this->seed('TestDatabaseSeeder');

        $slug = 'wgro';
        $date = Carbon::createFromFormat('Y-m-d H:i:s', '2017-01-01 00:00:00');
        $placeId = Place::whereSlug($slug)->firstOrfail()->id;

        $this->expectException(EmptyResourceException::class);

        app()->make(Offer::class)->getByDate($slug, $placeId, $date);
    }

    /***
     * @test
     */
    public function testItWriteDataToCacheAfterRetrievingThemFromDb()
    {
        $this->seed('TestDatabaseSeeder');

        $slug = 'wgro';
        $date = Carbon::createFromFormat('Y-m-d H:i:s', '2017-05-11 00:00:00');
        $placeId = Place::whereSlug($slug)->firstOrfail()->id;

        $initialCache = Cache::get($slug.'-'.$date->toDateString());

        $result = app()->make(Offer::class)->getByDate($slug, $placeId, $date);

        $afterCaching = Cache::get($slug.'-'.$date->toDateString());

        $this->assertNull($initialCache);
        $this->assertInstanceOf(Collection::class, $afterCaching);
        $this->assertEquals($result, $afterCaching);
    }

    /***
     * @test
     */
    public function testItDoesntCacheResultIfQueryWasEmpty()
    {
        $this->seed('TestDatabaseSeeder');

        $slug = 'wgro';
        $date = Carbon::createFromFormat('Y-m-d H:i:s', '2017-01-11 00:00:00');
        $placeId = Place::whereSlug($slug)->firstOrfail()->id;

        $initialCache = Cache::get($slug.'-'.$date->toDateString());

        try {
            app()->make(Offer::class)->getByDate($slug, $placeId, $date);
        } catch(\Exception $e) {

        }

        $afterCaching = Cache::get($slug.'-'.$date->toDateString());

        $this->assertNull($initialCache);
        $this->assertNull($afterCaching);
    }


}
