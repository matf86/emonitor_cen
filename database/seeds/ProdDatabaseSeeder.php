<?php

use Illuminate\Database\Seeder;

class ProdDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProdMarketsTableSeeder::class);
        $this->call(ProdUsersTableSeeder::class);
    }
}
