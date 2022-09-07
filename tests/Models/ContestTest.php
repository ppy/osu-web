<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\Contest;
use App\Models\ContestEntry;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\Score as MultiplayerScore;
use App\Models\User;
use Tests\TestCase;

class ContestTest extends TestCase
{
    /**
     * @dataProvider dataProviderForTestAssertVoteRequirementPlaylistBeatmapsets
     */
    public function testAssertVoteRequirementPlaylistBeatmapsets(bool $played, bool $passed, ?bool $mustPass, bool $canVote): void
    {
        $beatmaps = Beatmap::factory()->count(5)->create();
        // extra beatmap
        Beatmap::factory()->create();

        $rooms = factory(Room::class, 2)->create();
        foreach ($rooms as $room) {
            foreach ($beatmaps as $beatmap) {
                $playlistItems[] = factory(PlaylistItem::class)->create([
                    'room_id' => $room->getKey(),
                    'beatmap_id' => $beatmap->getKey(),
                ]);
            }
        }
        $contest = factory(Contest::class)->create([
            'extra_options' => [
                'requirement' => [
                    'must_pass' => $mustPass,
                    'name' => 'playlist_beatmapsets',
                    'room_ids' => array_column($rooms->all(), 'id'),
                ],
            ],
        ]);
        $entries = factory(ContestEntry::class, 2)->create(['contest_id' => $contest->getKey()]);

        if (!$canVote) {
            $this->expectException(InvariantException::class);
        }

        $user = User::factory()->create();

        if ($played) {
            $userId = $user->getKey();
            foreach ($beatmaps as $beatmap) {
                $room = array_rand_val($rooms);
                $playlistItem = $room->playlist()->firstWhere(['beatmap_id' => $beatmap->getKey()]);
                factory(MultiplayerScore::class)->create([
                    'passed' => $passed,
                    'playlist_item_id' => $playlistItem->getKey(),
                    'user_id' => $userId,
                ]);
            }
        }

        $contest->assertVoteRequirement($user);

        if ($canVote) {
            $this->assertTrue(true, 'no exception');
        }
    }

    public function testAssertVoteRequirementNoRequirement(): void
    {
        $contest = factory(Contest::class)->create();
        $entry = factory(ContestEntry::class)->create(['contest_id' => $contest->getKey()]);
        $user = User::factory()->create();

        $contest->assertVoteRequirement($user, $entry);
        $this->assertTrue(true, 'no exception');
    }

    public function dataProviderForTestAssertVoteRequirementPlaylistBeatmapsets(): array
    {
        return [
            // when passing is required
            [true, true, true, true],
            [true, false, true, false],
            [false, false, true, false],
            // when passing is not specified (default required)
            [true, true, null, true],
            [true, false, null, false],
            [false, false, null, false],
            // when passing is not required
            [true, true, false, true],
            [true, false, false, true],
            [false, false, false, false],
        ];
    }
}
