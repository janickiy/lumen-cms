<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContainerTable extends Migration {

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
    public function up() {
        Schema::connection($this->connection)
                ->table('container', function (Blueprint $collection) {
                    $collection->index('_id');
                    $collection->string('name');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::connection($this->connection)
                ->table('container', function (Blueprint $collection) {
                    $collection->drop();
                });
    }

}
