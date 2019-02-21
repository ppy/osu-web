<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShopifyIdToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-store')->table('products', function (Blueprint $table) {
            $table->string('shopify_id', 50)->nullable();
            $table->index(['shopify_id'], 'shopify_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-store')->table('products', function (Blueprint $table) {
            $table->dropColumn('shopify_id');
        });
    }
}
