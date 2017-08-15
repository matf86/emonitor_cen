<?php

namespace Tests\Unit;

use App\Utilities\DateConverter;
use App\Offer;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use MongoDB\BSON\ObjectID;
use Tests\TestCase;
use App\Services\OfferService;
use Mockery;


class OfferServiceTest extends TestCase
{

    public $dateConverterMock;

    public $offerMock;

    public function setUp()
    {
        parent::setUp();
        $this->dateConverterMock = Mockery::mock(DateConverter::class);
        $this->offerMock = Mockery::mock(Offer::class);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    // FUNCTION getOffersForProductInTimeRange() TESTS //

    /***
     * @test
     */
    public function testExceptionIsThrownWhenGetOffersForProductInTimeRangeFunctionIsCalledWithEmptyProps()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $name = '';
        $placeId = '';

        $this->expectException(\InvalidArgumentException::class);

        $service->getOffersForProductInTimeRange($name, $placeId);
    }

    /***
     * @test
     */
    public function testExceptionIsThrownWhenGetOffersForProductInTimeRangeFunctionIsCalledWithInvalidTypeProps()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $name = 1;

        $placeId = '12';

        $this->expectException(\InvalidArgumentException::class);

        $service->getOffersForProductInTimeRange($name, $placeId);
    }

    /***
     * @test
     */
    public function testExceptionIsThrownWhenGetOffersForProductInTimeRangeFunctionIsCalledWithInvalidNameProp()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $name = '';

        $placeId = new ObjectID();

        $this->expectException(\InvalidArgumentException::class);

        $service->getOffersForProductInTimeRange($name, $placeId);
    }

    /***
     * @test
     */
    public function testExceptionIsThrownWhenGetOffersForProductInTimeRangeFunctionIsCalledWithInvalidPlaceIdProp()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $name = 'test_name';

        $placeId = 'invalid_id_string';

        $this->expectException(\InvalidArgumentException::class);

        $service->getOffersForProductInTimeRange($name, $placeId);
    }

    /***
     * @test
     */
    public function testGetOffersForProductInTimeRangeFunctionReturnCollectionFromOfferQuery()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $name = 'test_name';
        $placeId = new ObjectID();


        $this->dateConverterMock->shouldReceive('setDateRange')->once();

        $this->offerMock->shouldReceive('getProductInTimeRange')->once()->andReturnUsing(function() {
                return collect(['offer_1', 'offer_2', 'offer_3']);
            });

        $result = $service->getOffersForProductInTimeRange($name, $placeId);

        $this->assertInstanceOf(Collection::class, $result);
    }


    /***
     * @test
     */
    public function testExceptionIsThrownWhenGetOffersByDateFunctionIsCalledWithEmptyProps()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $slug = '';
        $placeId = '';

        $this->expectException(\InvalidArgumentException::class);

        $service->getOffersByDate($slug, $placeId);
    }

    /***
     * @test
     */
    public function testExceptionIsThrownWhenGetOffersByDateFunctionIsCalledWithInvalidTypeProps()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $slug = 1;

        $placeId = '12';

        $this->expectException(\InvalidArgumentException::class);

        $service->getOffersByDate($slug, $placeId);
    }

    /***
     * @test
     */
    public function testExceptionIsThrownWhenGetOffersByDateFunctionIsCalledWithEmptySlugProp()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $slug = '';

        $placeId = new ObjectID();

        $this->expectException(\InvalidArgumentException::class);

        $service->getOffersByDate($slug, $placeId);
    }

    public function testExceptionIsThrownWhenGetOffersByDateFunctionIsCalledWithInvalidSlugProp()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $slug = ' ';

        $placeId = new ObjectID();

        $this->expectException(\InvalidArgumentException::class);

        $service->getOffersByDate($slug, $placeId);
    }

    /***
     * @test
     */
    public function testExceptionIsThrownWhenGetOffersByDateFunctionIsCalledWithInvalidPlaceIdProp()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $slug = 'test_slug';

        $placeId = 'invalid_id_string';

        $this->expectException(\InvalidArgumentException::class);

        $service->getOffersByDate($slug, $placeId);
    }


    /***
     * @test
     */
    public function testGetOffersByDateReturnCollectionFromOfferQuery()
    {
        $service = new OfferService($this->dateConverterMock, $this->offerMock);

        $slug = 'test_slug';

        $placeId = new ObjectID();

        $date = $this->dateConverterMock->shouldReceive('setDate')->once()
            ->andReturnUsing(function() {
                new Carbon();
            });

        $this->offerMock->shouldReceive('getByDate')->once()->andReturnUsing(function() {
            return collect(['offer_1', 'offer_2', 'offer_3']);
        });

        $result = $service->getOffersByDate($slug, $placeId, $date);

        $this->assertInstanceOf(Collection::class, $result);
    }


}
