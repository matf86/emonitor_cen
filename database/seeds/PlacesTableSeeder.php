<?php

use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->insert([
            "slug" => "wgro",
            "name" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "street" => "Franowo 1",
            "zip_code" => "61-302",
            "www" => "http://www.wgro.com.pl",
        ]);

        DB::table('places')->insert([
            "slug" => "lrh",
            "name" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A",
            "city" => " Łódź",
            "street" => "Budy 4",
            "zip_code" => "91-610",
            "www" => "http://www.zjazdowa.com.pl",
        ]);
    }
}
