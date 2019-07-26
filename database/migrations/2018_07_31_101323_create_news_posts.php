<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('version')->nullable();
            $table->string('slug', 150)->unique();
            $table->string('hash')->unique()->nullable();
            $table->string('tumblr_id')->nullable();
            $table->text('page')->nullable();
            $table->timestampsTz();
            $table->timestampTz('published_at')->nullable();

            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news_posts');
    }
}
