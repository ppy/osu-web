<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class NullableCoverJsonOnUserProfileCustomizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile_customizations', function ($table) {
            $table->dateTime('created_at')->nullable(false)->useCurrent()->change();
            $table->dateTime('updated_at')->nullable(false)->useCurrent()->change();
            $table->text('cover_json')->nullable()->default('NULL')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('user_profile_customizations')
            ->where('cover_json', null)
            ->update(['cover_json' => '']);

        Schema::table('user_profile_customizations', function ($table) {
            $table->text('cover_json')->nullable(false)->default()->change();
        });
    }
}
