<?php

use Illuminate\Database\Seeder;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TestMarketsTableSeeder::class);
        $this->call(TestOffersTableSeeder::class);
        $this->call(TestUsersTableSeeder::class);
        $this->call(TestLogsTableSeeder::class);
    }
}
