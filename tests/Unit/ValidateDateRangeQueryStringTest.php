<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\ValidateDateRangeQueryString;

class ValidateDateRangeQueryStringTest extends TestCase
{
    /***
     * @test
     */
    public function testPassIncomingRequestIfThereIsNoDateMinAndDateMaxQueryString()
    {
        // Create request

        $request = Request::create('/api/offers/wgro/products/Ananas', 'GET');

        // Pass it to the middlewar
        $middleware = new ValidateDateRangeQueryString();

        $response = $middleware->handle($request, function () {
            return null;
        });

        $this->assertEquals($response, null);
    }

    /***
     * @test
     */
    public function testPassIncomingRequestIfThereIsOnlyValidMinDateQueryString()
    {
        // Create request

        $request = Request::create('/api/offers/wgro/products/Ananas?minDate=2017-08-21', 'GET');

        // Pass it to the middlwear
        $middleware = new ValidateDateRangeQueryString();

        $response = $middleware->handle($request, function () {
            return null;
        });

        $this->assertEquals($response, null);
    }

    /***
     * @test
     */
    public function testPassIncomingRequestIfThereIsOnlyValidMaxDateQueryString()
    {
        // Create request

        $request = Request::create('/api/offers/wgro/products/Ananas?maxDate=2017-08-21', 'GET');

        // Pass it to the middlewar
        $middleware = new ValidateDateRangeQueryString();

        $response = $middleware->handle($request, function () {
            return null;
        });

        $this->assertEquals($response, null);
    }

    /***
     * @test
     */
    public function testStopIncomingRequestIfThereIsInvalidMaxDateQueryString()
    {
        $invalidDateFormats = ['2017-05-100',
                                '0000-00-00',
                                "",
                                20170824,
                                '20170824',
                                'testString',
                                '01-05-2017',
                                '2017-02-29',
                                '2017-06-31',
                                null
                            ];

        foreach ($invalidDateFormats as $format) {

            $request = Request::create("/api/offers/wgro/products/Ananas?minDate=2017-08-21&maxDate={$format}", 'GET');

            $middleware = new ValidateDateRangeQueryString();

            $response = $middleware->handle($request, function () {
                return null;

            });
            $this->assertEquals($response->getStatusCode(422), 422);
        }
    }

    /***
     * @test
     */
    public function testStopIncomingRequestIfThereIsInvalidMinDateQueryString()
    {
        $invalidDateFormats = ['2017-05-100',
                                '0000-00-00',
                                "",
                                20170824,
                                '20170824',
                                'testString',
                                '01-05-2017',
                                '2017-02-29',
                                '2017-06-31',
                                null
                            ];

        foreach ($invalidDateFormats as $format) {

            $request = Request::create("/api/offers/wgro/products/Ananas?minDate={$format}&maxDate=2017-08-21", 'GET');

            $middleware = new ValidateDateRangeQueryString();

            $response = $middleware->handle($request, function () {
                return null;

            });
            $this->assertEquals($response->getStatusCode(422), 422);
        }
    }

    /***
     * @test
     */
    public function testStopIncomingRequestIfThereIsInvalidMinDateAndMaxDateQueryString()
    {
        $invalidDateFormats = ['2017-05-100',
                                '0000-00-00',
                                "",
                                20170824,
                                '20170824',
                                'testString',
                                '01-05-2017',
                                '2017-02-29',
                                '2017-06-31',
                                null
                            ];

        foreach ($invalidDateFormats as $format) {

            $request = Request::create("/api/offers/wgro/products/Ananas?minDate={$format}&maxDate={$format}", 'GET');

            $middleware = new ValidateDateRangeQueryString();

            $response = $middleware->handle($request, function () {
                return null;

            });

            $this->assertEquals($response->getStatusCode(422), 422);
        }
    }
}
