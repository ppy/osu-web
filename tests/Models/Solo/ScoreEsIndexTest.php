<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models\Solo;

use App\Libraries\Search\ScoreSearch;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Group;
use App\Models\Language;
use App\Models\Solo\Score;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupEvent;
use App\Models\UserRelation;
use Tests\TestCase;

/**
 * @group RequiresScoreIndexer
 */
class ScoreEsIndexTest extends TestCase
{
    private static Beatmap $beatmap;
    private static array $scores;
    private static User $user;

    protected $connectionsToTransact = [];

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            static::$user = User::factory()->create(['osu_subscriber' => true]);
            $otherUser = User::factory()->create(['country_acronym' => Country::factory()]);
            static::$beatmap = Beatmap::factory()->qualified()->create();

            $scoreFactory = Score::factory()->state(['preserve' => true]);

            $mods = [
                ['acronym' => 'DT', 'settings' => []],
                ['acronym' => 'HD', 'settings' => []],
            ];
            $unrelatedMods = [
                ['acronym' => 'NC', 'settings' => []],
            ];

            static::$scores = [
                'otherUser' => $scoreFactory->withData([
                    'mods' => $unrelatedMods,
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'total_score' => 1150,
                    'user_id' => $otherUser,
                ]),
                'otherUserMods' => $scoreFactory->withData([
                    'mods' => $mods,
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'total_score' => 1140,
                    'user_id' => $otherUser,
                ]),
                'otherUser2' => $scoreFactory->withData([
                    'mods' => $mods,
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'total_score' => 1150,
                    'user_id' => User::factory()->state(['country_acronym' => Country::factory()]),
                ]),
                'otherUser3SameCountry' => $scoreFactory->withData([
                    'mods' => $unrelatedMods,
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'total_score' => 1130,
                    'user_id' => User::factory()->state(['country_acronym' => static::$user->country_acronym]),
                ]),
                'user' => $scoreFactory->create([
                    'beatmap_id' => static::$beatmap,
                    'total_score' => 1100,
                    'user_id' => static::$user,
                ]),
                'userMods' => $scoreFactory->withData([
                    'mods' => $mods,
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'total_score' => 1050,
                    'user_id' => static::$user,
                ]),
            ];

            static::reindexScores();
        });
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        static::withDbAccess(function () {
            Beatmap::truncate();
            Beatmapset::truncate();
            Country::truncate();
            Genre::truncate();
            Language::truncate();
            Score::truncate();
            User::truncate();
            UserGroup::truncate();
            UserGroupEvent::truncate();
            UserRelation::truncate();
            (new ScoreSearch())->deleteAll();
        });
    }

    /**
     * @dataProvider dataProviderForTestUserRank
     */
    public function testUserRank(string $key, ?array $params, int $rank): void
    {
        $score = static::$scores[$key]->fresh();

        $this->assertSame($rank, $score->userRank($params));
    }

    public static function dataProviderForTestUserRank(): array
    {
        return [
            ['user', null, 4],
            ['user', ['type' => 'country'], 2],
            ['userMods', ['mods' => ['DT', 'HD']], 3],
        ];
    }
}
