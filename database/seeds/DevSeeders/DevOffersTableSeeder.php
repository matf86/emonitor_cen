<?php

use Illuminate\Database\Seeder;
use MongoDB\BSON\ObjectID;
use Illuminate\Support\Facades\DB;

class DevOffersTableSeeder extends Seeder
{

    protected $products = [];
    protected $type =['Owoce', 'Warzywa', 'Grzyby', 'Bakalie'];
    protected $package = ['1 szt.', '5 kg', '15 kg', '1 karton', '1kg', '10kg'];
    protected $origin = ['Import', 'Kraj'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $wgro = App\Market::whereSlug('wgro')->first();
        $lrh = App\Market::whereSlug('lrh')->first();
        $elizowka = App\Market::whereSlug('elizowka')->first();
        $agrohurt = App\Market::whereSlug('agrohurt')->first();

        for($x = 0; $x <= 150; $x++) {
            $this->products[$faker->unique()->word] = [
                'type' => $this->type[array_rand($this->type)],
                'origin' => $this->origin[array_rand($this->origin)],
                "package" => $this->package[array_rand($this->package)],
            ];
        }

            foreach ($this->products as $name => $attrs) {

                for ($x = 10; $x <= 30; $x++) {
                    DB::table('offers')->insert([
                        "product" => $name,
                        "type" => $attrs['type'],
                        "origin" => $attrs['origin'],
                        "package" => $attrs['package'],
                        "price_min" => rand(1,20),
                        "price_max" => rand(20,75),
                        "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2018-01-'.$x)),
                        "market_id" => new ObjectID($wgro->id),
                    ]);
                }
            }

            foreach ($this->products as $name => $attrs) {
                for ($x = 10; $x <= 30; $x++) {
                    DB::table('offers')->insert([
                        "product" => $name,
                        "type" => $attrs['type'],
                        "origin" => $attrs['origin'],
                        "package" => $attrs['package'],
                        "price_max" => rand(15,50),
                        "price_min" => rand(1,14),
                        "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2018-01-'.$x)),
                        "market_id" => new ObjectID($lrh->id),
                    ]);
                }
            }

            foreach ($this->products as $name => $attrs) {
                for ($x = 10; $x <= 30; $x++) {
                    DB::table('offers')->insert([
                        "product" => $name,
                        "type" => $attrs['type'],
                        "origin" => $attrs['origin'],
                        "package" => $attrs['package'],
                        "price_max" => rand(15,50),
                        "price_min" => rand(1,14),
                        "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2018-01-'.$x)),
                        "market_id" => new ObjectID($elizowka->id),
                    ]);
                }
            }

            foreach ($this->products as $name => $attrs) {
                for ($x = 10; $x <= 30; $x++) {
                    DB::table('offers')->insert([
                        "product" => $name,
                        "type" => $attrs['type'],
                        "origin" => $attrs['origin'],
                        "package" => $attrs['package'],
                        "price_max" => rand(15,50),
                        "price_min" => rand(1,14),
                        "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2018-01-'.$x)),
                        "market_id" => new ObjectID($agrohurt->id),
                    ]);
                }
            }
    }
}
