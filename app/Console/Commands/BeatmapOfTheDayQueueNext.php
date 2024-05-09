<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Multiplayer\BeatmapOfTheDayQueueItem;
use App\Models\Multiplayer\Room;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BeatmapOfTheDayQueueNext extends Command
{
    protected $signature = 'beatmap-of-the-day:queue-next';

    protected $description = 'Creates a new "beatmap of the day" multiplayer room for the first item in queue.';

    public function handle()
    {
        $nextQueueItem = BeatmapOfTheDayQueueItem::whereNull('multiplayer_room_id')
            ->orderBy('order', 'asc')
            ->orderBy('id', 'asc')
            ->first();

        if ($nextQueueItem === null) {
            $this->error('Beatmap of the day queue is empty.');
            return 1;
        }

        $existing = Room::where('category', 'beatmap_of_the_day')->active()->first();
        if ($existing !== null) {
            $this->error("Another 'beatmap of the day' room is open (id {$existing->id}).");
            return 1;
        }

        DB::transaction(function () use ($nextQueueItem) {
            $startTime = today();
            $ownerId = $GLOBALS['cfg']['osu']['legacy']['bancho_bot_user_id'];

            $room = (new Room())->startGame(
                User::lookup($ownerId),
                [
                    'ends_at' => today()->addDay(),
                    'name' => "Beatmap of the Day: {$startTime->toFormattedDateString()}",
                    'type' => 'playlists',
                    'playlist' => [[
                        'beatmap_id' => $nextQueueItem->beatmap_id,
                        'ruleset_id' => $nextQueueItem->ruleset_id,
                        'allowed_mods' => $nextQueueItem->allowed_mods,
                        'required_mods' => $nextQueueItem->required_mods,
                    ]],
                ]
            );
            $room->update(['category' => 'beatmap_of_the_day']);

            $nextQueueItem->multiplayer_room_id = $room->id;
            $nextQueueItem->save();

            $this->info("Created room {$room->name} (id {$room->id})");
        });
    }
}
