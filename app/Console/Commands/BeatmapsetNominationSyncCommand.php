<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetNomination;
use Illuminate\Console\Command;

class BeatmapsetNominationSyncCommand extends Command
{
    protected $signature = 'beatmapset:nomination-sync';
    protected $description = 'Indexes documents into Elasticsearch.';

    public function handle()
    {
        BeatmapsetEvent::whereIn('type', [BeatmapsetEvent::NOMINATE, BeatmapsetEvent::NOMINATION_RESET, BeatmapsetEvent::DISQUALIFY])
            ->with('beatmapset')
            ->chunkById(1000, function ($chunk) {
                /** @var BeatmapsetEvent $event */
                foreach ($chunk as $event) {
                    switch ($event->type) {
                        case BeatmapsetEvent::NOMINATE:
                            \Log::debug('nominate', ['beatmapset_id' => $event->beatmapset_id, 'user_id' => $event->user_id]);
                            $event->beatmapset->beatmapsetNominations()->create([
                                'user_id' => $event->user_id,
                            ]);
                            break;
                        case BeatmapsetEvent::DISQUALIFY:
                        case BeatmapsetEvent::NOMINATION_RESET:
                            \Log::debug('nomination reset', ['beatmapset_id' => $event->beatmapset_id, 'user_id' => $event->user_id]);
                            BeatmapsetNomination::where('beatmapset_id', $event->beatmapset->getKey())->current()->update([
                                'reset' => true,
                                'reset_at' => $event->created_at,
                                'reset_user_id' => $event->user_id,
                            ]);
                            break;
                    }
                }
            });
    }
}
