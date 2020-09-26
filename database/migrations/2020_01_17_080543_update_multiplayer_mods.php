<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class UpdateMultiplayerMods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('multiplayer_playlist_items')->chunkById(1000, function ($items) {
            foreach ($items as $item) {
                $allowedMods = $this->updateMods($item->allowed_mods);
                $requiredMods = $this->updateMods($item->required_mods);

                if ($allowedMods === $item->allowed_mods && $requiredMods === $item->required_mods) {
                    continue;
                }

                DB::table('multiplayer_playlist_items')->where('id', $item->id)->update([
                    'allowed_mods' => $allowedMods,
                    'required_mods' => $requiredMods,
                ]);
            }
        });

        DB::table('multiplayer_scores')->chunkById(1000, function ($scores) {
            foreach ($scores as $score) {
                $mods = $this->updateMods($score->mods);

                if ($mods === $score->mods) {
                    continue;
                }

                DB::table('multiplayer_scores')->where('id', $score->id)->update([
                    'mods' => $mods,
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // no going back
    }

    private function updateMods($mods)
    {
        if ($mods === null) {
            return;
        }

        $mods = json_decode($mods);

        foreach ($mods as $mod) {
            if (is_array($mod->settings) && count($mod->settings) === 0) {
                $mod->settings = new stdClass();
            }
        }

        return json_encode($mods);
    }
}
