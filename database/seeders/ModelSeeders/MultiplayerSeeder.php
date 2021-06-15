<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\Beatmap;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\Score;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MultiplayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = factory(Room::class, 10)->create();

        foreach ($rooms as $room) {
            $beatmaps = Beatmap::orderByRaw('RAND()')->limit(rand(4, 10))->get();
            foreach ($beatmaps as $beatmap) {
                $playlistItem = factory(PlaylistItem::class)->create([
                    'room_id' => $room->getKey(),
                    'beatmap_id' => $beatmap->getKey(),
                    'ruleset_id' => $beatmap->playmode,
                ]);

                $users = User::orderByRaw('RAND()')->limit(rand(4, 10))->get();
                foreach ($users as $user) {
                    $attempts = rand(1, 10);
                    for ($i = 0; $i < $attempts; $i++) {
                        $completed = rand(0, 100) > 20;
                        factory(Score::class)->create([
                            'playlist_item_id' => $playlistItem->getKey(),
                            'user_id' => $user->getKey(),
                            'beatmap_id' => $beatmap->getKey(),
                            'room_id' => $room->getKey(),
                            'total_score' => rand(10000, 100000),
                            'started_at' => Carbon::now()->subMinutes(5),
                            'ended_at' => $completed ? Carbon::now() : null,
                            'passed' => $completed ? rand(0, 100) > 20 : null,
                            'accuracy' => rand(50, 100) / 100,
                            'pp' => rand(100, 200),
                        ]);
                    }
                }
            }
        }
    }
}
