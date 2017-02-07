<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration {

    protected $connection = 'mongodb';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::connection($this->connection)
                ->table('content', function (Blueprint $collection) {
                    $collection->index('_id');
                    $collection->foreign('container_id')
                    ->references('_id')->on('container')
                    ->onDelete('cascade');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::connection($this->connection)
                ->table('content', function (Blueprint $collection) {
                    $collection->drop();
                });
    }

}
