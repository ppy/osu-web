<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedMediumInteger('user_id')->nullable();

            $table->text('message');

            $table->enum('commentable_type', ['beatmapset', 'build', 'news_post'])->nullable();
            $table->unsignedBigInteger('commentable_id')->nullable();

            $table->unsignedBigInteger('replies_count_cache')->default(0);

            $table->string('legacy_id')->nullable();
            $table->text('legacy_user_data')->nullable();

            $table->timestampTz('edited_at')->nullable();
            $table->unsignedMediumInteger('edited_by_id')->nullable();

            $table->timestampTz('deleted_at')->nullable();
            $table->unsignedMediumInteger('deleted_by_id')->nullable();

            $table->timestampsTz();

            $table->index(['commentable_type', 'commentable_id']);
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
