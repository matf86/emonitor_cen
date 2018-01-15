<?php

use Illuminate\Database\Seeder;

class DevDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DevMarketsTableSeeder::class);
        $this->call(DevOffersTableSeeder::class);
        $this->call(DevLogsTableSeeder::class);
        $this->call(DevUsersTableSeeder::class);
    }
}
