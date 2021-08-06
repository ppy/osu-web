<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetNomination;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Log;

class BeatmapsetNominationSyncCommand extends Command
{
    protected $signature = 'beatmapset:nomination-sync';
    protected $description = 'Migrates nomination-related BeatmapsetEvents to BeatmapsetNomination.';

    public function handle()
    {
        $progress = $this->output->createProgressBar();
        $max = BeatmapsetEvent::max('id');

        BeatmapsetEvent::where('id', '<=', $max)->whereIn('type', [BeatmapsetEvent::NOMINATE, BeatmapsetEvent::NOMINATION_RESET, BeatmapsetEvent::DISQUALIFY])
            ->with('beatmapset')
            ->chunkById(1000, function ($chunk) use ($progress) {
                /** @var BeatmapsetEvent $event */
                foreach ($chunk as $event) {
                    switch ($event->type) {
                        case BeatmapsetEvent::NOMINATE:
                            try {
                                Log::debug('nominate', ['beatmapset_id' => $event->beatmapset_id, 'user_id' => $event->user_id]);
                                BeatmapsetNomination::create([
                                    'beatmapset_id' => $event->beatmapset_id,
                                    'created_at' => $event->created_at,
                                    'event_id' => $event->getKey(),
                                    'modes' => $event->comment['modes'] ?? null,
                                    'user_id' => $event->user_id,
                                ]);
                            } catch (QueryException $e) {
                                if (!is_sql_unique_exception($e)) {
                                    throw $e;
                                }

                                Log::debug('nominate already exists', ['beatmapset_id' => $event->beatmapset_id, 'user_id' => $event->user_id]);
                            }
                            break;
                        case BeatmapsetEvent::DISQUALIFY:
                        case BeatmapsetEvent::NOMINATION_RESET:
                            Log::debug('nomination reset', ['beatmapset_id' => $event->beatmapset_id, 'user_id' => $event->user_id]);
                            BeatmapsetNomination::current()
                                ->where('beatmapset_id', $event->beatmapset_id)
                                ->where('event_id', '<', $event->getKey())
                                ->update([
                                    'reset' => true,
                                    'reset_at' => $event->created_at,
                                    'reset_user_id' => $event->user_id,
                                ]);
                            break;
                    }

                    $progress->advance();
                }
            });

        $progress->finish();
        $this->line('');
    }
}
