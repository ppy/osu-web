<?php

use App\Libraries\Fulfillments\BannerFulfillment;
use App\Models\Store\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTournamentIdToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-store')->table('products', function (Blueprint $table) {
            $table->unsignedInteger('tournament_id')->nullable();
            $table->index(['tournament_id']);
        });

        // migrate existing data
        $products = Product::whereIn('custom_class', BannerFulfillment::ALLOWED_TAGGED_NAMES)->get();

        foreach ($products as $product) {
            $values = array_values($product->typeMappings());
            $tournamentId = $values[0]['tournament_id'] ?? null;
            if ($tournamentId !== null) {
                $product->timestamps = false;
                $product->update(['tournament_id' => $tournamentId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-store')->table('products', function (Blueprint $table) {
            $table->dropColumn('tournament_id');
        });
    }
}
