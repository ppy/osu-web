<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');
            $table->string('name');
            $table->text('description');

            $table->string('icon_url');
            $table->string('header_url');

            $table->string('soundcloud')->nullable();
            $table->string('website')->nullable();

            $table->timestamps();
        });

        Schema::create('artists', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');
            $table->string('name');
            $table->text('description');

            $table->integer('label_id')->unsigned()->nullable();
            $table->foreign('label_id')
                ->references('id')
                ->on('labels')
                ->onDelete('restrict');

            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('soundcloud')->nullable();
            $table->string('website')->nullable();
            $table->string('cover_url')->nullable();
            $table->string('header_url')->nullable();

            $table->timestamps();
        });

        Schema::create('artist_tracks', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');
            $table->integer('artist_id')->unsigned()->nullable();
            $table->foreign('artist_id')
                ->references('id')
                ->on('artists')
                ->onDelete('restrict');

            $table->string('title');
            $table->string('version')->nullable();
            $table->string('genre');
            $table->float('bpm');
            $table->string('cover_url')->nullable();
            $table->string('preview');
            $table->string('osz');

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
        Schema::drop('artist_tracks');
        Schema::drop('artists');
        Schema::drop('labels');
    }
}
