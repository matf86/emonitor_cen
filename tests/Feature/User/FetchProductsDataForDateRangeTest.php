<?php

namespace Tests\Feature\User;

use App\Exceptions\EmptyResourceException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FetchProductsDataForDateRangeTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->seed('TestDatabaseSeeder');
    }

    /***
     * @test
     */
    public function testUserGetsDataFromMaximumLatest30DaysIfDateMaxAndDateMinParamsAreNotSpecified()
    {
        $slug = 'wgro';
        $productName= 'Banany';
        $oldestDate = '2017-05-10';
        $latestDate = '2017-05-15';


        $response = $this->get("api/offers/{$slug}/products/{$productName}");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['products_list' =>[]]
        ]);

        $result = $response->json();

        $this->assertEquals($oldestDate, $result['data']['products_list'][0]['date']);
        $this->assertEquals($latestDate, $result['data']['products_list'][5]['date']);
    }

    /***
     * @test
     */
    public function testUserGetsDataFromSpecifiedDateRange()
    {
        $slug = 'wgro';
        $productName= 'Banany';
        $mintDate= '2017-05-10';
        $maxDate= '2017-05-14';


        $response = $this->get("api/offers/{$slug}/products/{$productName}?minDate={$mintDate}&maxDate={$maxDate}");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['products_list' =>[]]
            ]);

        $result = $response->json();

        $this->assertEquals($mintDate, $result['data']['products_list'][0]['date']);
        $this->assertEquals($maxDate, $result['data']['products_list'][4]['date']);
    }

    /***
     * @test
     */
    public function testUserGetsUnprocessableEntityResponseWhenQueryParamsAreInUnsupportedFormat()
    {
        $slug = 'wgro';
        $productName= 'Banany';
        $mintDate= '20170510';
        $maxDate= 'invalid_format';


        $response = $this->get("api/offers/{$slug}/products/{$productName}?minDate={$mintDate}&maxDate={$maxDate}");

        $response->assertStatus(422);

    }

    /***
     * @test
     */
    public function testUserGetsAnEmptyResourceExceptionWhenThereAreNoOffersForGivenDateRange()
    {
        $slug = 'wgro';
        $productName= 'Banany';
        $mintDate= '2017-06-05';
        $maxDate= '2017-06-25';

        $response = $this->get("api/offers/{$slug}/products/{$productName}?minDate={$mintDate}&maxDate={$maxDate}");

        $this->expectException(EmptyResourceException::class);

        $response->json();
    }

    /***
     * @test
     */
    public function testUserGetsAnEmptyResourceExceptionWhenThereAreNoGivenProduct()
    {
        $slug = 'wgro';
        $productName= 'invalid_name';
        $mintDate= '2017-06-05';
        $maxDate= '2017-06-25';

        $response = $this->get("api/offers/{$slug}/products/{$productName}?minDate={$mintDate}&maxDate={$maxDate}");

        $this->expectException(EmptyResourceException::class);

        $response->json();
    }

    /***
     * @test
     */
    public function testUserGetsAnModelNotFoundExceptionWhenThereAreNoGivenMarketPlace()
    {
        $slug = 'invalid_slug';
        $productName= 'Banany';
        $mintDate= '2017-06-05';
        $maxDate= '2017-06-25';

        $response = $this->get("api/offers/{$slug}/products/{$productName}?minDate={$mintDate}&maxDate={$maxDate}");

        $this->expectException(ModelNotFoundException::class);

        dd($response->json());
    }
}
