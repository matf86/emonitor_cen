<?php

namespace Tests\Feature\User;

use App\Exceptions\EmptyResourceException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FetchOffersDataTest extends TestCase
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
    public function testUserCanEnterPageWithOffersForGivenMarketPlace()
    {
        $slug = 'wgro';
        $this->get('/offers/'.$slug)->assertStatus(200);
    }

    /***
     * @test
     */
    public function testUserIsRedirectedWhenEntersWrongMarketPlaceSlug()
    {
        $slug = 'wrongSlug';
        $this->get('/offers/'.$slug)->assertStatus(302);
    }

    /***
     * @test
     */
    public function testUserGetDataAboutOffersForGivenMarketPlace()
    {
        $slug = 'wgro';

        $response = $this->get("api/offers/{$slug}/products");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['products_list' =>[],
                                              'place_data' =>[]]
                                  ]);
    }

    /***
     * @test
     */
    public function testWhenUserDontSpecifyDateInQueryStringHeGetsLatestOffers()
    {
        $slug = 'wgro';
        $latestDateFromDb = '2017-05-15';

        $response = $this->get("api/offers/{$slug}/products");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['products_list' =>[],
                'place_data' =>[]]
            ]);

        $data = $response->json();
        $fetchedDate = $data['data']['products_list'][0]['date'];

        $this->assertEquals($latestDateFromDb, $fetchedDate);
    }

    /***
     * @test
     */
    public function testUserGetsDataAboutOffersFromMarketPlaceForSpecifiedDate()
    {
        $slug = 'wgro';
        $date= '2017-05-10';

        $response = $this->get("api/offers/{$slug}/products?date={$date}");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['products_list' =>[],
                'place_data' =>[]]
            ]);

        $data = $response->json();
        $fetchedDate = $data['data']['products_list'][0]['date'];

        $this->assertEquals($date, $fetchedDate);
    }

    /***
     * @test
     */
    public function testUserGetUnprocessableEntityResponseWhenHeSpecifyUnsupportedDateQueryStringValue()
    {
        $slug = 'wgro';
        $date= '20170510';

        $response = $this->get("api/offers/{$slug}/products?date={$date}");

        $response->assertStatus(422);
    }

    /***
     * @test
     */
    public function testUserGetsAnEmptyResourceExceptionWhenThereAreNoOffersForGivenDate()
    {
        $slug = 'wgro';
        $date= '2017-06-10';

        $response = $this->get("api/offers/{$slug}/products?date={$date}");

        $this->expectException(EmptyResourceException::class);

        $response->json();
    }

    /***
     * @test
     */
    public function testUserGetAModelNotFoundExceptionWhenWrongSlugIsSpecified()
    {
        $slug = 'invalid_slug';

        $response = $this->get("api/offers/{$slug}/products");

        $this->expectException(ModelNotFoundException::class);

        $response->json();
    }


}