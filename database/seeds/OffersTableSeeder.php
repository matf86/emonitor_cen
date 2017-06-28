<?php

use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 7,
            "price_max" => 9,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Kraj",
            "package" => " 1 szt.",
            "price_min" => 17,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 45,
            "price_max" => 70,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Burak",
            "type" => "Warzywa",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 27,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 6,
            "price_max" => 8,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 10,
            "price_max" => 12,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 5,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Kraj",
            "package" => " 1 szt.",
            "price_min" => 12,
            "price_max" => 32,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 41,
            "price_max" => 50,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Cytryna",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 22,
            "price_max" => 35,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 6,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 16,
            "price_max" => 19,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 7,
            "price_max" => 9,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Rodzynki",
            "type" => "Bakalie",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 7,
            "price_max" => 9,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Kraj",
            "package" => " 1 szt.",
            "price_min" => 17,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 45,
            "price_max" => 70,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Cytryna",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 27,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 6,
            "price_max" => 8,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Pieczarki",
            "type" => "Grzyby",
            "origin" => "Import",
            "package" => " 1 kg.",
            "price_min" => 16,
            "price_max" => 28,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 10,
            "price_max" => 12,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 5,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Marchew",
            "type" => "Warzywa",
            "origin" => "Kraj",
            "package" => " 1 szt.",
            "price_min" => 12,
            "price_max" => 32,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 41,
            "price_max" => 50,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Cytryna",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 22,
            "price_max" => 35,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 6,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 16,
            "price_max" => 19,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

                DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 7,
            "price_max" => 9,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Kraj",
            "package" => " 1 szt.",
            "price_min" => 17,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 45,
            "price_max" => 70,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Cytryna",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 27,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 6,
            "price_max" => 8,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 10,
            "price_max" => 12,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 5,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Kraj",
            "package" => " 1 szt.",
            "price_min" => 12,
            "price_max" => 32,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 41,
            "price_max" => 50,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Cytryna",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 22,
            "price_max" => 35,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 6,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 16,
            "price_max" => 19,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

                DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 7,
            "price_max" => 9,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Kraj",
            "package" => " 1 szt.",
            "price_min" => 17,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 45,
            "price_max" => 70,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Cytryna",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 27,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 6,
            "price_max" => 8,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 10,
            "price_max" => 12,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Wielkopolska Giełda Rolno-Ogrodnicza",
            "city" => "Poznań",
            "slug" => "wgro"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 5,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Kraj",
            "package" => " 1 szt.",
            "price_min" => 12,
            "price_max" => 32,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 41,
            "price_max" => 50,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Cytryna",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 22,
            "price_max" => 35,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 6,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 16,
            "price_max" => 19,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "place" => "Łódzki Rynek Hurtowy „Zjazdowa” S.A.",
            "city" => "Łódź",
            "slug" => "lrh"
        ]);
    }
}
