<?php

use Illuminate\Database\Seeder;
use MongoDB\BSON\ObjectID;
use Illuminate\Support\Facades\DB;

class OffersTableSeeder extends Seeder
{
    protected $products = [ 'Ananasy' => 'Owoce',
                            'Ziemniaki' => 'Warzywa',
                            'Buraki' => 'Warzywa',
                            'Maliny' => 'Warzywa',
                            'Cytryny' => 'Owoce',
                            'Banany' => 'Owoce',
                            'Kapusta' => 'Warzywa',
                            'Ogórki' => 'Warzywa',
                            'Kalafior' => 'Warzywa',
                            'Mandarynki' => 'Owoce',
                            'Pomarancze' => 'Owoce',
                            'Winogrona' => 'Owoce',
                            'Marchew' => 'Warzywa',
                            'Pietruszka' => 'Warzywa',
                            'Seler' => 'Warzywa'];

    protected $package = ['1 szt.', '5kg', '15kg', '1 karton'];
    protected $origin = ['Import', 'Kraj'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $wgro = App\Place::whereSlug('wgro')->first();
        $lrh = App\Place::whereSlug('lrh')->first();


            foreach ($this->products as $name => $type) {
                for ($x = 10; $x <= 30; $x++) {
                    DB::table('offers')->insert([
                        "product" => $name,
                        "type" => $type,
                        "origin" => $this->origin[array_rand($this->origin)],
                        "package" => $this->package[array_rand($this->package)],
                        "price_min" => rand(1,15),
                        "price_max" => rand(15,25),
                        "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-08-'.$x)),
                        "place_id" => new ObjectID($wgro->id),
                    ]);
                }
            }

            foreach ($this->products as $name => $type) {
                for ($x = 10; $x <= 30; $x++) {
                    DB::table('offers')->insert([
                        "product" => $name,
                        "type" => $type,
                        "origin" => $this->origin[array_rand($this->origin)],
                        "package" => $this->package[array_rand($this->package)],
                        "price_min" => rand(1,15),
                        "price_max" => rand(15,30),
                        "date" => new MongoDB\BSON\UTCDateTime(new DateTime('2017-08-'.$x)),
                        "place_id" => new ObjectID($lrh->id),
                    ]);
                }
            }
    }
}
