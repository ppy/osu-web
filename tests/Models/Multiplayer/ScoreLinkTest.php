<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\ScoreLink;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class ScoreLinkTest extends TestCase
{
    public function testRequiredModsMissing()
    {
        $user = User::factory()->create();
        $beatmap = Beatmap::factory()->create();
        $playlistItem = PlaylistItem::factory()->create([
            'required_mods' => [[
                'acronym' => 'HD'
            ]],
        ]);
        $scoreLink = ScoreLink::factory()->create([
            'user_id' => $user,
            'playlist_item_id' => $playlistItem
        ]);

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage("This play does not include the mods required.");
        $scoreLink->complete([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => 0,
            'user_id' => $user->getKey(),
            'ended_at' => json_date(Carbon::now()),
            'mods' => [],
            'statistics' => [
                'great' => 1
            ]
        ]);
    }

    public function testRequiredModsPresent()
    {
        $user = User::factory()->create();
        $beatmap = Beatmap::factory()->create();
        $playlistItem = PlaylistItem::factory()->create([
            'required_mods' => [[
                'acronym' => 'HD'
            ]],
        ]);
        $scoreLink = ScoreLink::factory()->create([
            'user_id' => $user,
            'playlist_item_id' => $playlistItem
        ]);

        $this->expectNotToPerformAssertions();
        $scoreLink->complete([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => 0,
            'user_id' => $user->getKey(),
            'ended_at' => json_date(Carbon::now()),
            'mods' => [['acronym' => 'HD']],
            'statistics' => [
                'great' => 1
            ]
        ]);
    }

    public function testExpectedAllowedMod()
    {
        $user = User::factory()->create();
        $beatmap = Beatmap::factory()->create();
        $playlistItem = PlaylistItem::factory()->create([
            'required_mods' => [[
                'acronym' => 'DT'
            ]],
            'allowed_mods' => [[
                'acronym' => 'HD'
            ]],
        ]);
        $scoreLink = ScoreLink::factory()->create([
            'user_id' => $user,
            'playlist_item_id' => $playlistItem
        ]);

        $this->expectNotToPerformAssertions();
        $scoreLink->complete([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => 0,
            'user_id' => $user->getKey(),
            'ended_at' => json_date(Carbon::now()),
            'mods' => [
                ['acronym' => 'DT'],
                ['acronym' => 'HD']
            ],
            'statistics' => [
                'great' => 1
            ]
        ]);
    }

    public function testUnexpectedAllowedMod()
    {
        $user = User::factory()->create();
        $beatmap = Beatmap::factory()->create();
        $playlistItem = PlaylistItem::factory()->create([
            'required_mods' => [[
                'acronym' => 'DT'
            ]],
            'allowed_mods' => [[
                'acronym' => 'HR'
            ]],
        ]);
        $scoreLink = ScoreLink::factory()->create([
            'user_id' => $user,
            'playlist_item_id' => $playlistItem
        ]);

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage("This play includes mods that are not allowed.");
        $scoreLink->complete([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => 0,
            'user_id' => $user->getKey(),
            'ended_at' => json_date(Carbon::now()),
            'mods' => [
                ['acronym' => 'DT'],
                ['acronym' => 'HD']
            ],
            'statistics' => [
                'great' => 1
            ]
        ]);
    }

    public function testUnexpectedModWhenNoModsAreAllowed()
    {
        $user = User::factory()->create();
        $beatmap = Beatmap::factory()->create();
        $playlistItem = PlaylistItem::factory()->create(); // no required or allowed mods.
        $scoreLink = ScoreLink::factory()->create([
            'user_id' => $user,
            'playlist_item_id' => $playlistItem
        ]);

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage("This play includes mods that are not allowed.");
        $scoreLink->complete([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => 0,
            'user_id' => $user->getKey(),
            'ended_at' => json_date(Carbon::now()),
            'mods' => [['acronym' => 'HD']],
            'statistics' => [
                'great' => 1
            ]
        ]);
    }
}
