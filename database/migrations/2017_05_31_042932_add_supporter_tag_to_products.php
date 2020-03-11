<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\Store;
use Illuminate\Database\Migrations\Migration;

class AddSupporterTagToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Store\Product::unguard();

        Store\Product::create([
            'name' => 'osu! Supporter Tag',
            'custom_class' => 'supporter-tag',
            'header_description' => "# osu! Supporter Tag\nThe first step in self improvement",
            'image' => 'https://puu.sh/ibWES/3e6dcf7397.png',
            'header_image' => 'https://puu.sh/ibWES/3e6dcf7397.png',
            'cost' => null,
            'weight' => null,
            'max_quantity' => 1,
            'stock' => null,
            'allow_multiple' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Store\Product::where('custom_class', 'supporter-tag')->delete();
    }
}
