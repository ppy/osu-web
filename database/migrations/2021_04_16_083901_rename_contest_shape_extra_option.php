<?php

use App\Models\Contest;
use Illuminate\Database\Migrations\Migration;

class RenameContestShapeExtraOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->migrate('shape', 'thumbnail_shape');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->migrate('thumbnail_shape', 'shape');
    }

    private function migrate($from, $to): void
    {
        foreach (Contest::all() as $contest) {
            if (isset($contest->extra_options[$from])) {
                $options = $contest->extra_options;
                $options[$to] = $options[$from];
                unset($options[$from]);

                $contest->update(['extra_options' => $options]);
            }
        }
    }
}
