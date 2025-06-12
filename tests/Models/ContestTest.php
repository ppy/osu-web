<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Contest;
use App\Models\ContestEntry;
use App\Models\ContestJudge;
use App\Models\ContestScoringCategory;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\ScoreLink as MultiplayerScoreLink;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Tests\TestCase;

class ContestTest extends TestCase
{
    public static function dataProviderForTestAssertVoteRequirementPlaylistBeatmapsets(): array
    {
        return [
            // when passing is required
            [true, true, true, true, true],
            [true, true, false, true, false],
            [true, false, false, true, false],
            [false, false, false, true, false],
            // when passing is not specified (default required)
            [true, true, true, null, true],
            [true, true, false, null, false],
            [true, false, false, null, false],
            [false, false, false, null, false],
            // when passing is not required
            [true, true, true, false, true],
            [true, true, false, false, true],
            [true, false, false, false, false],
            [false, false, false, false, false],
        ];
    }

    public static function dataProviderForTestCalculateScoresStd()
    {
        return [
            [fn () => 3, [0.0, 0.0, 0.0, 0.0], [0.0, 0.0, 0.0, 0.0]],
            [fn ($entry, $judge) => $judge->getKey() % 4, [0.0, 0.0, 0.0, 0.0], [0.0, 0.0, 0.0, 0.0]],
            [fn ($entry, $user) => $entry->getKey() % 4, [5.3665631459996, 1.78885438199984, -1.78885438199984, -5.3665631459996], [1.3416407864999, 0.44721359549996, -0.44721359549996, -1.3416407864999]],
            [fn ($entry, $user) => 10 - $entry->getKey() % 4, [5.3665631459996, 1.78885438199984, -1.78885438199984, -5.3665631459996], [1.3416407864999, 0.44721359549996, -0.44721359549996, -1.3416407864999]],
        ];
    }

    public static function dataProviderForTestShowEntryUser(): array
    {
        return [
            [false, null, false],
            [true, null, true],
            [false, false, false],
            [true, false, true],
            [false, true, true],
            [true, true, true],
        ];
    }

    /**
     * @dataProvider dataProviderForTestAssertVoteRequirementPlaylistBeatmapsets
     */
    public function testAssertVoteRequirementPlaylistBeatmapsets(
        bool $loggedIn,
        bool $played,
        bool $passed,
        ?bool $mustPass,
        bool $canVote
    ): void {
        $beatmapsets = Beatmapset::factory()->count(5)->create();
        $beatmaps = [];
        foreach ($beatmapsets as $beatmapset) {
            $beatmapsetId = $beatmapset->getKey();
            for ($i = 0; $i < 2; $i++) {
                $beatmaps[] = Beatmap::factory()->create(['beatmapset_id' => $beatmapsetId]);
            }
        }
        // extra beatmap
        Beatmap::factory()->create();

        $rooms = Room::factory()->count(2)->create();
        foreach ($rooms as $i => $room) {
            foreach ($beatmapsets as $beatmapset) {
                $playlistItems[] = PlaylistItem::factory()->create([
                    'room_id' => $room,
                    'beatmap_id' => $beatmapset->beatmaps[$i],
                ]);
            }
        }
        $contest = Contest::factory()->create([
            'extra_options' => [
                'requirement' => [
                    'must_pass' => $mustPass,
                    'name' => 'playlist_beatmapsets',
                    'room_ids' => array_column($rooms->all(), 'id'),
                ],
            ],
        ]);
        $entries = ContestEntry::factory()->count(2)->create(['contest_id' => $contest->getKey()]);

        $user = $loggedIn ? User::factory()->create() : null;

        if ($loggedIn && $played) {
            $userId = $user->getKey();
            $endedAt = json_time(Carbon::now());
            foreach ($beatmapsets as $beatmapset) {
                $room = array_rand_val($rooms);
                $playlistItem = $room
                    ->playlist()
                    ->whereIn('beatmap_id', array_column($beatmapset->beatmaps->all(), 'beatmap_id'))
                    ->first();

                MultiplayerScoreLink::factory()->state([
                    'playlist_item_id' => $playlistItem,
                    'user_id' => $userId,
                ])->completed([
                    'ended_at' => $endedAt,
                    'passed' => $passed,
                ])->create();
            }
            foreach ($rooms as $room) {
                UserScoreAggregate::lookupOrDefault($user, $room)->recalculate();
            }
        }

        if (!$canVote) {
            $this->expectException(InvariantException::class);
        }

        $contest->assertVoteRequirement($user);

        if ($canVote) {
            $this->assertTrue(true, 'no exception');
        }
    }

    public function testAssertVoteRequirementNoRequirement(): void
    {
        $contest = Contest::factory()->create();
        $entry = ContestEntry::factory()->create(['contest_id' => $contest->getKey()]);
        $user = User::factory()->create();

        $contest->assertVoteRequirement($user, $entry);
        $this->assertTrue(true, 'no exception');
    }

    /**
     * @dataProvider dataProviderForTestCalculateScoresStd
     */
    public function testCalculateScoresStd(Closure $scoreFn, array $entriesStdDev, array $votesStdDev): void
    {
        $contest = Contest::factory()
            ->judged()
            ->scoreStandardised()
            ->has(ContestScoringCategory::factory()->count(4), 'scoringCategories')
            ->has(ContestEntry::factory()->count(count($entriesStdDev)), 'entries')
            ->has(ContestJudge::factory()->count(4), 'judges')
            ->create();

        foreach ($contest->judges as $judge) {
            foreach ($contest->entries as $entry) {
                $vote = $entry->judgeVotes()->create(['user_id' => $judge->user_id]);

                foreach ($contest->scoringCategories as $category) {
                    $vote->scores()->create([
                        'contest_judge_vote_id' => $vote->getKey(),
                        'contest_scoring_category_id' => $category->getKey(),
                        'value' => $scoreFn($entry, $judge),
                    ]);
                }
            }
        }

        $contest->fresh()->calculateScoresStd();

        $entries = $contest->entries()->withScore($contest)->get();
        $this->assertSame($entriesStdDev, $entries->pluck('total_score_std')->toArray());
        foreach ($entries as $index => $entry) {
            // All votes for the same entry will have the same std dev at the moment because that's just how the test is currently set up.
            $values = $entry->judgeVotes()->pluck('total_score_std')->toArray();
            $this->assertSame([$votesStdDev[$index]], array_unique($values));
        }
    }

    /**
     * @dataProvider dataProviderForTestShowEntryUser
     */
    public function testShowEntryUser(bool $showVotes, ?bool $showEntryUserOption, bool $result): void
    {
        $extraOptions = $showEntryUserOption === null
            ? null
            : ['show_entry_user' => $showEntryUserOption];
        $contest = Contest::factory()->create([
            'show_votes' => $showVotes,
            'extra_options' => $extraOptions,
        ]);
        $this->assertSame($result, $contest->showEntryUser());
    }
}
