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
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-12')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Kraj",
            "package" => " 1 szt.",
            "price_min" => 17,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-12')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 45,
            "price_max" => 70,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-12')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Burak",
            "type" => "Warzywa",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 27,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-12')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 4,
            "price_max" => 5,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 11,
            "price_max" => 13,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 40,
            "price_max" => 75,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Burak",
            "type" => "Warzywa",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 27,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 4,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-10')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 8,
            "price_max" => 12,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-10')),
            "places_id" => "", 
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 30,
            "price_max" => 65,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-10')),
            "places_id" => "", 
        ]);

        DB::table('offers')->insert([
            "product" => "Burak",
            "type" => "Warzywa",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 22,
            "price_max" => 33,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-10')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 4,
            "price_max" => 6,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-09')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 9,
            "price_max" => 11,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-09')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 40,
            "price_max" => 55,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-09')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Burak",
            "type" => "Warzywa",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 35,
            "price_max" => 30,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-09')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 1,
            "price_max" => 3,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-08')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 5,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-07')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 5,
            "price_max" => 7,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-06')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 4,
            "price_max" => 6,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-05')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 6,
            "price_max" => 9,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-04')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 8,
            "price_max" => 10,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-03')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 9,
            "price_max" => 9.50,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-02')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 9,
            "price_max" => 12,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-01')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 7,
            "price_max" => 9,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-12')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Kraj",
            "package" => " 1 szt.",
            "price_min" => 17,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-12')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 45,
            "price_max" => 70,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-12')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Burak",
            "type" => "Warzywa",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 27,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-12')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 4,
            "price_max" => 5,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 11,
            "price_max" => 13,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 40,
            "price_max" => 75,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Burak",
            "type" => "Warzywa",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 27,
            "price_max" => 39,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-11')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Ananasy",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 3,
            "price_max" => 4,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-10')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Banany",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 8,
            "price_max" => 12,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-10')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Maliny",
            "type" => "Owoce",
            "origin" => "Import",
            "package" => " 1 szt.",
            "price_min" => 30,
            "price_max" => 65,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-10')),
            "places_id" => "",
        ]);

        DB::table('offers')->insert([
            "product" => "Burak",
            "type" => "Warzywa",
            "origin" => "Import",
            "package" => " 1 kg",
            "price_min" => 22,
            "price_max" => 33,
            "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-10')),
            "places_id" => "",
        ]);
    }
}
