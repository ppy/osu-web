<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\ScoreLink;
use App\Models\ScoreToken;
use Tests\TestCase;

class ScoreLinkTest extends TestCase
{
    private static array $commonScoreParams;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$commonScoreParams = [
            'accuracy' => 0.5,
            'ended_at' => new \DateTime(),
            'max_combo' => 1,
            'statistics' => [
                'great' => 1,
            ],
            'total_score' => 1,
        ];
    }

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
            ...static::$commonScoreParams,
            'beatmap_id' => $playlistItem->beatmap_id,
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
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
            ...static::$commonScoreParams,
            'beatmap_id' => $playlistItem->beatmap_id,
            'mods' => [['acronym' => 'HD']],
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
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
            ...static::$commonScoreParams,
            'beatmap_id' => $playlistItem->beatmap_id,
            'mods' => [
                ['acronym' => 'DT'],
                ['acronym' => 'HD'],
            ],
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
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
            ...static::$commonScoreParams,
            'beatmap_id' => $playlistItem->beatmap_id,
            'mods' => [
                ['acronym' => 'DT'],
                ['acronym' => 'HD'],
            ],
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
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
            ...static::$commonScoreParams,
            'beatmap_id' => $playlistItem->beatmap_id,
            'mods' => [['acronym' => 'HD']],
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
        ]);
    }

    public function testUnexpectedModAcceptedIfAlwaysValidForSubmission()
    {
        $beatmap = Beatmap::factory()->create([
            'playmode' => 0, // must be osu! specifically. no other ruleset currently has an appropriate mod.
        ]);
        $playlistItem = PlaylistItem::factory()->create([
            'ruleset_id' => 0,
            'beatmap_id' => $beatmap,
            // no required or allowed mods.
        ]);
        $scoreToken = ScoreToken::factory()->create([
            'beatmap_id' => $playlistItem->beatmap_id,
            'playlist_item_id' => $playlistItem,
        ]);

        $this->expectNotToPerformAssertions();
        ScoreLink::complete($scoreToken, [
            ...static::$commonScoreParams,
            'beatmap_id' => $playlistItem->beatmap_id,
            'mods' => [['acronym' => 'TD']],
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
        ]);
    }

    public function testFailedMultiplayerScoresArePreserved()
    {
        $playlistItem = PlaylistItem::factory()->create();
        $scoreToken = ScoreToken::factory()->create([
            'beatmap_id' => $playlistItem->beatmap_id,
            'playlist_item_id' => $playlistItem,
        ]);

        $scoreLink = ScoreLink::complete($scoreToken, [
            ...static::$commonScoreParams,
            'beatmap_id' => $playlistItem->beatmap_id,
            'ruleset_id' => $playlistItem->ruleset_id,
            'user_id' => $scoreToken->user_id,
            'passed' => false,
        ]);
        $this->assertTrue($scoreLink->score->preserve);
    }
}
