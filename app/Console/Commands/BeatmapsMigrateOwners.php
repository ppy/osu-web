<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Beatmap;
use Illuminate\Console\Command;

class BeatmapsMigrateOwners extends Command
{
    protected $signature = 'beatmaps:migrate-owners';

    protected $description = 'Migrates beatmap owners to new table.';

    public function handle()
    {
        $progress = $this->output->createProgressBar();

        Beatmap::chunkById(1000, function ($beatmaps) use ($progress) {
            foreach ($beatmaps as $beatmap) {
                $beatmap->beatmapOwners()->firstOrCreate(['user_id' => $beatmap->user_id]);
                $progress->advance();
            }
        });

        $progress->finish();
        $this->line('');
    }
}
