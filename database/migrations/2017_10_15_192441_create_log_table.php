<?php

use Illuminate\Support\Facades\Schema;
use Moloquent\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
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
        table('logs', function (Blueprint $collection) {
            $collection->string('message');
            $collection->string('category')->index();;
            $collection->timestamp('created_at')->index();
            $collection->string('market_id')->default(null);
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
            ->table('logs', function (Blueprint $collection)
            {
                $collection->drop();
            });
    }
}

