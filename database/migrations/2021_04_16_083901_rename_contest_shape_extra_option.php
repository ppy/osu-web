<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
