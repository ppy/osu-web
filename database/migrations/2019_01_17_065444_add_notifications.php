<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('notifiable_id');
            $table->string('notifiable_type', 255);
            $table->unsignedBigInteger('source_user_id')->nullable();
            $table->integer('priority')->default(0);

            $table->boolean('is_private')->default(false);
            $table->string('name', 255);
            $table->json('details');

            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notifications');
    }
}
