<?php

use Illuminate\Support\Facades\Schema;
use Moloquent\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * The name of the database connection to use.
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->
        table('offers', function (Blueprint $collection) {
            $collection->index('product');
            $collection->string('type');
            $collection->string('origin');
            $collection->string('package');
            $collection->string('place_id');
            $collection->integer('price_min');
            $collection->integer('price_max');
            $collection->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)
            ->table('offers', function (Blueprint $collection)
            {
                $collection->drop();
            });
    }
}
