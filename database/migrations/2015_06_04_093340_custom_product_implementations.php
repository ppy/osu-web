<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
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
