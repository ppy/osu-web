<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\ScoreLink;
use App\Models\ScoreToken;
use Carbon\Carbon;
use Tests\TestCase;

class ScoreLinkTest extends TestCase
{
    public function testRequiredModsMissing()
    {
        $playlistItem = PlaylistItem::factory()->create([
            'required_mods' => [[
                'acronym' => 'HD',
            ]],
        ]);
        $scoreToken = ScoreToken::factory()->create([
            'beatmap_id' => $playlistItem->beatmap_id,
            'playlist_item_id' => $playlistItem,
        ]);

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage('This play does not include the mods required.');
        ScoreLink::complete($scoreToken, [
            'beatmap_id' => $playlistItem->beatmap_id,
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
            'ended_at' => json_date(Carbon::now()),
            'mods' => [],
            'statistics' => [
                'great' => 1,
            ],
        ]);
    }

    public function testRequiredModsPresent()
    {
        $playlistItem = PlaylistItem::factory()->create([
            'required_mods' => [[
                'acronym' => 'HD',
            ]],
        ]);
        $scoreToken = ScoreToken::factory()->create([
            'beatmap_id' => $playlistItem->beatmap_id,
            'playlist_item_id' => $playlistItem,
        ]);

        $this->expectNotToPerformAssertions();
        ScoreLink::complete($scoreToken, [
            'beatmap_id' => $playlistItem->beatmap_id,
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
            'ended_at' => json_date(Carbon::now()),
            'mods' => [['acronym' => 'HD']],
            'statistics' => [
                'great' => 1,
            ],
        ]);
    }

    public function testExpectedAllowedMod()
    {
        $playlistItem = PlaylistItem::factory()->create([
            'required_mods' => [[
                'acronym' => 'DT',
            ]],
            'allowed_mods' => [[
                'acronym' => 'HD',
            ]],
        ]);
        $scoreToken = ScoreToken::factory()->create([
            'beatmap_id' => $playlistItem->beatmap_id,
            'playlist_item_id' => $playlistItem,
        ]);

        $this->expectNotToPerformAssertions();
        ScoreLink::complete($scoreToken, [
            'beatmap_id' => $playlistItem->beatmap_id,
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
            'ended_at' => json_date(Carbon::now()),
            'mods' => [
                ['acronym' => 'DT'],
                ['acronym' => 'HD'],
            ],
            'statistics' => [
                'great' => 1,
            ],
        ]);
    }

    public function testUnexpectedAllowedMod()
    {
        $playlistItem = PlaylistItem::factory()->create([
            'required_mods' => [[
                'acronym' => 'DT',
            ]],
            'allowed_mods' => [[
                'acronym' => 'HR',
            ]],
        ]);
        $scoreToken = ScoreToken::factory()->create([
            'beatmap_id' => $playlistItem->beatmap_id,
            'playlist_item_id' => $playlistItem,
        ]);

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage('This play includes mods that are not allowed.');
        ScoreLink::complete($scoreToken, [
            'beatmap_id' => $playlistItem->beatmap_id,
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
            'ended_at' => json_date(Carbon::now()),
            'mods' => [
                ['acronym' => 'DT'],
                ['acronym' => 'HD'],
            ],
            'statistics' => [
                'great' => 1,
            ],
        ]);
    }

    public function testUnexpectedModWhenNoModsAreAllowed()
    {
        $playlistItem = PlaylistItem::factory()->create(); // no required or allowed mods.
        $scoreToken = ScoreToken::factory()->create([
            'beatmap_id' => $playlistItem->beatmap_id,
            'playlist_item_id' => $playlistItem,
        ]);

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage('This play includes mods that are not allowed.');
        ScoreLink::complete($scoreToken, [
            'beatmap_id' => $playlistItem->beatmap_id,
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
            'ended_at' => json_date(Carbon::now()),
            'mods' => [['acronym' => 'HD']],
            'statistics' => [
                'great' => 1,
            ],
        ]);
    }
}
