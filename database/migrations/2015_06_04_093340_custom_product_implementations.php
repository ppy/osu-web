<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
use App\Models\Store;
use Illuminate\Database\Migrations\Migration;

class CustomProductImplementations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-store')->table('products', function ($table) {
            $table->string('custom_class')->nullable();
            $table->integer('weight')->nullable()->default(0)->change();
            $table->decimal('cost', 10, 2)->nullable()->change();
        });

        Schema::connection('mysql-store')->table('order_items', function ($table) {
            $table->string('extra_info')->nullable();
        });

        Eloquent::unguard();

        Store\Product::create([
            'name' => 'Player Name Change',
            'custom_class' => 'username-change',
            'header_description' => "# Player Name Change\nBecause “xxultralaser_1986xx” looks retarded",
            'image' => 'https://puu.sh/ibWES/3e6dcf7397.png',
            'header_image' => 'https://puu.sh/ibWES/3e6dcf7397.png',
            'cost' => null,
            'weight' => null,
            'max_quantity' => 1,
            'stock' => null,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Store\Product::whereNotNull('custom_class')->delete();

        Schema::connection('mysql-store')->table('products', function ($table) {
            $table->dropColumn(['custom_class']);
            $table->integer('weight')->change();
            $table->decimal('cost', 10, 2)->change();
        });

        Schema::connection('mysql-store')->table('order_items', function ($table) {
            $table->dropColumn('extra_info');
        });
    }
}
