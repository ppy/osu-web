<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
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
