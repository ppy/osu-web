<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddIpBans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('osu_ip_bans')) {
            return;
        }

        Schema::create('osu_ip_bans', function ($table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $column = $table->string('ip', 40)->primary()->default('');
            $column->collation = 'utf8_bin';
            $table->unsignedMediumInteger('user_id')->nullable();
            $table->integer('length')->default(72 * 3600);
            $table->boolean('active')->default(true);

            $table->index('user_id', 'user_id');
        });

        DB::statement('
            ALTER TABLE osu_ip_bans
            ADD COLUMN timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER user_id
        ');
        DB::statement('ALTER TABLE osu_ip_bans ROW_FORMAT=DYNAMIC');

        Schema::table('osu_ip_bans', function ($table) {
            $table->index(['active', 'timestamp'], 'active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('osu_ip_bans');
    }
}
