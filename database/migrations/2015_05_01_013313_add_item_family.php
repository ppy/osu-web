<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use Illuminate\Database\Migrations\Migration;

class AddItemFamily extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-store')->table('products', function ($table) {
            $table->text('description')->nullable()->change();
            $table->string('image')->nullable()->change();
            $table->string('header_description')->nullable()->change();
            $table->string('header_image')->nullable()->change();
            $table->text('images_json')->nullable()->change();

            $table->integer('master_product_id')->nullable();
            $table->text('type_mappings_json')->nullable();
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
            $table->text('description')->change();
            $table->string('image')->change();
            $table->string('header_description')->change();
            $table->string('header_image')->change();
            $table->text('images_json')->change();

            $table->dropColumn('master_product_id');
            $table->dropColumn('type_mappings_json');
        });
    }
}
