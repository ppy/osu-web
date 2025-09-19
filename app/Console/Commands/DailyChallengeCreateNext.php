<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Multiplayer\DailyChallengeQueueItem;
use App\Models\Multiplayer\Room;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DailyChallengeCreateNext extends Command
{
    protected $description = 'Creates a new "daily challenge" multiplayer room for the first item in queue.';

    protected $signature = 'daily-challenge:create-next';

    public function handle()
    {
        $nextQueueItem = DailyChallengeQueueItem::whereNull('multiplayer_room_id')
            ->orderBy('order', 'asc')
            ->orderBy('id', 'asc')
            ->first();

        if ($nextQueueItem === null) {
            $this->error('"Daily challenge" queue is empty.');
            return 1;
        }

        $existing = Room::where('category', 'daily_challenge')->active()->first();
        if ($existing !== null) {
            $this->error("Another \"daily challenge\" room is open (id {$existing->getKey()}).");
            return 1;
        }

        DB::transaction(function () use ($nextQueueItem) {
            // matches cron schedule
            $startTime = today()->addMinutes(5);
            $hostId = $GLOBALS['cfg']['osu']['legacy']['bancho_bot_user_id'];

            $room = (new Room())->startGame(
                User::findOrFail($hostId),
                [
                    'ends_at' => today()->addDay(),
                    'name' => "Daily Challenge: {$startTime->toFormattedDateString()}",
                    'type' => 'playlists',
                    'playlist' => [[
                        'beatmap_id' => $nextQueueItem->beatmap_id,
                        'ruleset_id' => $nextQueueItem->ruleset_id,
                        'allowed_mods' => $nextQueueItem->allowed_mods,
                        'required_mods' => $nextQueueItem->required_mods,
                    ]],
                ],
                [
                    'starts_at' => $startTime,
                ],
            );
            $room->update(['category' => 'daily_challenge']);

            $nextQueueItem->multiplayer_room_id = $room->getKey();
            $nextQueueItem->save();

            $this->info("Created room {$room->name} (id {$room->getKey()})");
        });
    }
}
