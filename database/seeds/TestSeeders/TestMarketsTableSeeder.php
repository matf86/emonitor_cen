<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestMarketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('markets')->insert([
            "slug" => "wgro",
            "name" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "street" => "Franowo 1",
            "zip_code" => "61-302",
            "www" => "http://www.wgro.com.pl",
            "cords" => [52.378278, 16.985115]
        ]);

        DB::table('markets')->insert([
            "slug" => "lrh",
            "name" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A",
            "city" => " Łódź",
            "street" => "Budy 4",
            "zip_code" => "91-610",
            "www" => "http://www.zjazdowa.com.pl",
            "cords" => [51.804625, 19.53261]
        ]);
    }
}
