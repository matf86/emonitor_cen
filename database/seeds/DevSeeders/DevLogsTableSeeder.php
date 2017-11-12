<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevLogsTableSeeder extends Seeder
{

    protected $category =['error', 'info', 'success'];

    /**
    * Run the database seeds.
    *
    * @return void
    */
        public function run()
        {
            $wgro = App\Market::whereSlug('wgro')->first();
            $lrh = App\Market::whereSlug('lrh')->first();

            foreach ($this->category as $item => $type) {
                for ($x = 10; $x <= 15; $x++) {
                    DB::table('logs')->insert([
                        "message" => "test_{$type}_message",
                        "category" => $type,
                        "created_at" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-10-'.$x)),
                        "market_id" => new \MongoDB\BSON\ObjectID($wgro->id)
                    ]);
                }
            }

            foreach ($this->category as $item => $type) {
                for ($x = 10; $x <= 13; $x++) {
                    DB::table('logs')->insert([
                        "message" => "test_{$type}_message",
                        "category" => $type,
                        "created_at" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-10-'.$x)),
                        "market_id" => new \MongoDB\BSON\ObjectID($lrh->id)
                    ]);
                }
            }
        }
}