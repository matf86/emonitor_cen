<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdMarketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('markets')->insert([
            "_id" => new \MongoDB\BSON\ObjectID('10d3ec860774d5e62c000001'),
            "slug" => "wgro",
            "name" => "Wielkopolska Gildia Rolno-Ogrodnicza S.A",
            "city" => "Poznań",
            "street" => "Franowo 1",
            "zip_code" => "61-302",
            "www" => "http://www.wgro.com.pl",
            "cords" => [52.378278, 16.985115]
        ]);

        DB::table('markets')->insert([
            "_id" => new \MongoDB\BSON\ObjectID('20d3ec860774d5e62c000002'),
            "slug" => "lrh",
            "name" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A",
            "city" => " Łódź",
            "street" => "Budy 4",
            "zip_code" => "91-610",
            "www" => "http://www.zjazdowa.com.pl",
            "cords" => [51.804625, 19.53261]
        ]);

        DB::table('markets')->insert([
            "_id" => new \MongoDB\BSON\ObjectID('30d3ec860774d5e62c000003'),
            "slug" => "elizowka",
            "name" => "Lubelski Rynek Hurtowy \"Elizówka\" S.A",
            "city" => "Elizówka",
            "street" => "Elizówka 65",
            "zip_code" => "21-003",
            "www" => "http://www.elizowka.pl",
            "cords" => [51.28797, 22.580212]
        ]);

        DB::table('markets')->insert([
            "_id" => new \MongoDB\BSON\ObjectID('40d3ec860774d5e62c000004'),
            "slug" => "agrohurt",
            "name" => "Podkarpackie Centrum Hurtowe Agrohurt S.A",
            "city" => "Rzeszów",
            "street" => "Lubelska 46",
            "zip_code" => "35-959",
            "www" => "http://www.agrohurtsa.pl",
            "cords" => [ 50.063539, 22.011549]
        ]);
    }
}
