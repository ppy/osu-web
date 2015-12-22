<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('creator_id')->unsigned()->nullable();
            $table->mediumInteger('category_id')->unsigned()->nullable();
            $table->mediumText("content");
            $table->string("title");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faq_articles');
    }
}
