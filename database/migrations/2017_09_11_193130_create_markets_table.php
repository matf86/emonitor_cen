<?php

use Illuminate\Support\Facades\Schema;
use Moloquent\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketsTable extends Migration
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
        table('markets', function (Blueprint $collection) {
            $collection->index('slug');
            $collection->string('name');
            $collection->string('street');
            $collection->string('zip_code');
            $collection->string('city');
            $collection->string('www');
            $collection->jsonb('cords');
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
            ->table('markets', function (Blueprint $collection)
            {
                $collection->drop();
            });
    }
}
