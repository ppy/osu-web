<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use Illuminate\Database\Migrations\Migration;

class RecordCostAndShippingInOrderPopulate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* No longer needed and doesn't work after upgrade to Laravel 5.
         * Not going to bother making it work.
         *
        foreach (Store\Order::where("status", ">=", "paid")->whereNull("shipping")->get() as $o)
        {
            echo "Adding static data for {$o->order_id}\n";
            $o->refreshCost(true);
        }
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
