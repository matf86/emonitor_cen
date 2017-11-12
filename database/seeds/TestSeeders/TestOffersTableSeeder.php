<?php

use Illuminate\Database\Seeder;
use MongoDB\BSON\ObjectID;

class TestOffersTableSeeder extends Seeder
{
    protected $products = [
                            'Cytryny' => 'Owoce',
                            'Banany' => 'Owoce',
                            'Kapusta' => 'Warzywa',
                            'Kalafior' => 'Warzywa',
                            'Mandarynki' => 'Owoce'
                           ];

    protected $package = ['1 szt.', '5kg'];
    protected $origin = ['Import', 'Kraj'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $wgro = App\Market::whereSlug('wgro')->first();
        $lrh = App\Market::whereSlug('lrh')->first();


            foreach ($this->products as $name => $type) {
                for ($x = 10; $x <= 15; $x++) {
                    DB::table('offers')->insert([
                        "product" => $name,
                        "type" => $type,
                        "origin" => $this->origin[array_rand($this->origin)],
                        "package" => $this->package[array_rand($this->package)],
                        "price_min" => rand(1,15),
                        "price_max" => rand(15,25),
                        "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-'.$x)),
                        "market_id" => new ObjectID($wgro->id),
                    ]);
                }
            }

            foreach ($this->products as $name => $type) {
                for ($x = 10; $x <= 15; $x++) {
                    DB::table('offers')->insert([
                        "product" => $name,
                        "type" => $type,
                        "origin" => $this->origin[array_rand($this->origin)],
                        "package" => $this->package[array_rand($this->package)],
                        "price_min" => rand(1,15),
                        "price_max" => rand(15,30),
                        "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-05-'.$x)),
                        "market_id" => new ObjectID($lrh->id),
                    ]);
                }
            }
    }
}
