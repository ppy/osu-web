<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use Illuminate\Database\Migrations\Migration;

class ExtendProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-store')->table('products', function ($table) {
            $table->boolean('promoted')->default(false);
            $table->integer('display_order')->default(0);
            $table->string('header_description');
            $table->string('header_image');
            $table->text('images_json');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-store')->table('products', function ($table) {
            $table->dropColumn(['promoted', 'display_order', 'header_description', 'header_image', 'images_json']);
        });
    }
}
