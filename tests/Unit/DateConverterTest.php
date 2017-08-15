<?php

namespace Tests\Unit;

use App\Offer;
use MongoDB\BSON\ObjectID;
use Tests\TestCase;
use App\Utilities\DateConverter;
use Mockery;


class DateConverterTest extends TestCase
{
    public $offerMock;

    public function setUp()
    {
        parent::setUp();

        $this->offerMock = Mockery::mock(Offer::class);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /***
     * @test
     */
    public function testSetCarbonDateInstanceFromGivenInput()
    {
        $date = '2017-05-21';

        $placeId = new ObjectID();

        $converter = new DateConverter($this->offerMock);

        $result = $converter->setDate($placeId, $date);

        $this->assertInstanceOf('Carbon\Carbon', $result);
    }

    /***
     * @test
     */
    public function testQueryForLatestDateWhenThereIsNoDateInput()
    {
        $placeId = new ObjectID();

        $spy = Mockery::spy(Offer::class);

        $converter = new DateConverter($spy);

        $converter->setDate($placeId);

        $spy->shouldHaveReceived('getLatestDate')
            ->once()
            ->with($placeId);
    }

    /***
     * @test
     */
    public function testConvertDatesInputForDateRangeArray()
    {
        $placeId = new ObjectID();
        $minDate = '2017-05-10';
        $maxDate = '2017-05-26';

        $converter = new DateConverter($this->offerMock);

        $result = $converter->setDateRange($placeId, $minDate, $maxDate);

        $this->assertInstanceOf('Carbon\Carbon', $result['maxDate']);
        $this->assertInstanceOf('Carbon\Carbon', $result['minDate']);
    }

    /***
     * @test
     */
    public function testIfMinDateIsNotSpecifiedItSubtractMonthFromMaxDateParam()
    {
        $placeId = new ObjectID();
        $maxDate = '2017-05-26';

        $converter = new DateConverter($this->offerMock);

        $result = $converter->setDateRange($placeId, null, $maxDate);

        $this->assertInstanceOf('Carbon\Carbon', $result['maxDate']);
        $this->assertInstanceOf('Carbon\Carbon', $result['minDate']);
        $this->assertEquals( $result['minDate'], $result['maxDate']->subMonth());
    }

    /***
     * @test
     */
    public function testQueryForLatestDateWhenThereIsNoMaxDateInputSpecified()
    {
        $placeId = new ObjectID();
        $minDate = '2017-05-26';

        $this->offerMock->shouldReceive('getLatestDate')
            ->once()
            ->with($placeId)
            ->andReturn('latest_date_from_given_place');

        $converter = new DateConverter($this->offerMock);

        $result = $converter->setDateRange($placeId, $minDate);

        $this->assertEquals($result['maxDate'], 'latest_date_from_given_place');
        $this->assertInstanceOf('Carbon\Carbon', $result['minDate']);
    }
}
