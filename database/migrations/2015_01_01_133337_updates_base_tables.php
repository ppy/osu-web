<?php

use Illuminate\Database\Migrations\Migration;

class UpdatesBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $builder = Schema::connection('mysql-updates');

        $builder->create('streams', function ($table) {
            $table->increments('stream_id');
            $table->string('name', 50);
            $table->string('pretty_name', 50)->nullable();

            $table->unique('name', 'name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $builder = Schema::connection('mysql-updates');

        $builder->drop('streams');
    }
}
