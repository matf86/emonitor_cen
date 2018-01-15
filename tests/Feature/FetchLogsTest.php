<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FetchLogsTest extends TestCase
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
    public function only_registered_user_can_fetch_logs_data()
    {
        $slug = 'wgro';
        $response = $this->json('get',"dashboard/markets/{$slug}/logs");

        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function user_fetch_all_logs_when_there_are_no_filters_in_url()
    {
        $user = User::first();
        $logsCount = 18;
        $slug = 'wgro';
        $response = $this->actingAs($user)->json('get',"dashboard/markets/{$slug}/logs");

        $logs = $response->json();

        $response->assertStatus(200);
        $this->assertCount($logsCount, $logs['data']);
    }

    /**
     * @test
     */
    public function user_can_filter_logs_by_date_range()
    {
        $user = User::first();
        $slug = 'wgro';
        $from = '2017-10-10';
        $to = '2017-10-12';

        $response = $this->actingAs($user)->get("dashboard/markets/{$slug}/logs?dateRange[]={$from}&dateRange[]={$to}");

        $uniqueDates = collect($response->json()['data'])->map(function($item) {
            return $item['created_at'];
        })->unique();

        $maxDate = $uniqueDates->max();
        $minDate = $uniqueDates->min();

        $this->assertEquals($from, $minDate);
        $this->assertEquals($to, $maxDate);
    }

    /**
     * @test
     */
    public function user_can_filter_offers_by_category()
    {
        $user = User::first();
        $slug = 'wgro';
        $categories = ['error'];

        $response = $this->actingAs($user)->json('get',"dashboard/markets/{$slug}/logs", [
            'categories' => $categories
        ]);

        $logs = $response->json()['data'];
        $logCategory= $logs[0]['category'];

        $this->assertCount(6, $logs);

        $this->assertEquals($categories[0], $logCategory);
    }

    /**
     * @test
     */
    public function user_gets_no_data_response_when_categories_array_is_empty()
    {
        $user = User::first();
        $slug = 'wgro';
        $categories = [null];

        $response = $this->actingAs($user)->json('get',"dashboard/markets/{$slug}/logs", [
            'categories' => $categories
        ]);

        $logs = $response->json()['status'];

        $this->assertEquals($logs, 'no data');
    }

}
