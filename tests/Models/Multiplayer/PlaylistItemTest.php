<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\User;
use Tests\TestCase;

class PlaylistItemTest extends TestCase
{
    public static function rulesetsProvider()
    {
        return [
            'osu' => [0],
            'taiko' => [1],
            'fruits' => [2],
            'mania' => [3],
        ];
    }

    /**
     * @dataProvider rulesetsProvider
     */
    public function testOsuBeatmapPlayableInAnyRuleset(int $rulesetId)
    {
        $beatmap = Beatmap::factory()->create([
            'playmode' => 0,
        ]);
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $playlistItem = new PlaylistItem([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => $rulesetId,
            'room_id' => $room->getKey(),
            'owner_id' => $user->getKey(),
            'required_mods' => [],
            'allowed_mods' => [],
            'freestyle' => false,
        ]);

        $this->expectNotToPerformAssertions();
        $playlistItem->save();
    }

    public function testCatchBeatmapPlayableInCatchRuleset()
    {
        $beatmap = Beatmap::factory()->create([
            'playmode' => 2,
        ]);
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $playlistItem = new PlaylistItem([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => 2,
            'room_id' => $room->getKey(),
            'owner_id' => $user->getKey(),
            'required_mods' => [],
            'allowed_mods' => [],
            'freestyle' => false,
        ]);

        $this->expectNotToPerformAssertions();
        $playlistItem->save();
    }

    public function testManiaBeatmapNotPlayableInOtherRulesets()
    {
        $beatmap = Beatmap::factory()->create([
            'playmode' => 3,
        ]);
        $room = Room::factory()->create();
        $user = User::factory()->create();
        $playlistItem = new PlaylistItem([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => 2,
            'room_id' => $room->getKey(),
            'owner_id' => $user->getKey(),
            'required_mods' => [],
            'allowed_mods' => [],
            'freestyle' => false,
        ]);

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessageMatches('/^invalid ruleset_id for beatmap \d+$/');
        $playlistItem->save();
    }
}
