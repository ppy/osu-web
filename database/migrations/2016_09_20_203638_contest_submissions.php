<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisibleToContests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contests', function (Blueprint $table) {
            //fix ends_at not being nullable
            $table->timestamp('ends_at')->nullable()->change();

            $table->renameColumn('description', 'description_voting');
            $table->renameColumn('ends_at', 'voting_ends_at');

            $table->timestamp('entry_starts_at')->nullable()->after('show_votes');
            $table->timestamp('entry_ends_at')->nullable()->after('entry_starts_at');
            $table->timestamp('voting_starts_at')->nullable()->after('entry_ends_at');

            $table->text('description_enter')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->dropColumn('description_enter');

            $table->dropColumn('voting_starts_at');
            $table->dropColumn('entry_starts_at');
            $table->dropColumn('entry_ends_at');

            $table->renameColumn('description_voting', 'description');
            $table->renameColumn('voting_ends_at', 'ends_at');

            $table->timestamp('ends_at')->change();
        });
    }
}
