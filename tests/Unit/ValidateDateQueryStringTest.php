<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\ValidateDateQueryString;


class ValidateDateQueryStringTest extends TestCase
{
    /***
     * @test
     */
    public function testPassIncomingRequestIfThereIsNoDateQueryString()
    {
        // Create request

        $request = Request::create('/api/offers/wgro/products', 'GET');

        // Pass it to the middlewar
        $middleware = new ValidateDateQueryString();

        $response = $middleware->handle($request, function () {
            return null;
        });

        $this->assertEquals($response, null);
    }

    /***
     * @test
     */
    public function testPassIncomingRequestIfThereIsValidDateInQueryString()
    {
        // Create request
        $request = Request::create('/api/offers/wgro/products?date=2017-05-10', 'GET');

        // Pass it to the middleware
        $middleware = new ValidateDateQueryString();

        $response = $middleware->handle($request, function () {
            return null;
        });

        $this->assertEquals($response, null);
    }

    /***
     * @test
     */
    public function testStopIncomingRequestIfThereIsInvalidDateInQueryString()
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

            $request = Request::create("/api/offers/wgro/products?date={$format}" , 'GET');

            $middleware = new ValidateDateQueryString();

            $response = $middleware->handle($request, function () {
                return null;

            });
            $this->assertEquals($response->getStatusCode(422), 422);
        }

    }
}
