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
 * @group EsSoloScores
 */
class ScoreEsIndexTest extends TestCase
{
    private static Beatmap $beatmap;
    private static array $scores;
    private static User $user;

    protected $connectionsToTransact = [];

    public static function setUpBeforeClass(): void
    {
        (new static())->refreshApplication();
        static::$user = User::factory()->create(['osu_subscriber' => true]);
        $otherUser = User::factory()->create(['country_acronym' => Country::factory()]);
        static::$beatmap = Beatmap::factory()->qualified()->create();

        $scoreFactory = Score::factory()->state(['preserve' => true]);
        $defaultData = ['build_id' => 1];

        $mods = [
            ['acronym' => 'DT', 'settings' => []],
            ['acronym' => 'HD', 'settings' => []],
        ];
        $unrelatedMods = [
            ['acronym' => 'NC', 'settings' => []],
        ];

        static::$scores = [
            'otherUser' => $scoreFactory->withData($defaultData, [
                'total_score' => 1150,
                'mods' => $unrelatedMods,
            ])->create([
                'beatmap_id' => static::$beatmap,
                'user_id' => $otherUser,
            ]),
            'otherUserMods' => $scoreFactory->withData($defaultData, [
                'total_score' => 1140,
                'mods' => $mods,
            ])->create([
                'beatmap_id' => static::$beatmap,
                'user_id' => $otherUser,
            ]),
            'otherUser2' => $scoreFactory->withData($defaultData, [
                'total_score' => 1150,
                'mods' => $mods,
            ])->create([
                'beatmap_id' => static::$beatmap,
                'user_id' => User::factory()->state(['country_acronym' => Country::factory()]),
            ]),
            'otherUser3SameCountry' => $scoreFactory->withData($defaultData, [
                'total_score' => 1130,
                'mods' => $unrelatedMods,
            ])->create([
                'beatmap_id' => static::$beatmap,
                'user_id' => User::factory()->state(['country_acronym' => static::$user->country_acronym]),
            ]),
            'user' => $scoreFactory->withData($defaultData, ['total_score' => 1100])->create([
                'beatmap_id' => static::$beatmap,
                'user_id' => static::$user,
            ]),
            'userMods' => $scoreFactory->withData($defaultData, [
                'total_score' => 1050,
                'mods' => $mods,
            ])->create([
                'beatmap_id' => static::$beatmap,
                'user_id' => static::$user,
            ]),
        ];

        static::reindexScores();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        (new static())->refreshApplication();
        Beatmap::truncate();
        Beatmapset::truncate();
        Country::truncate();
        Genre::truncate();
        Group::truncate();
        Language::truncate();
        Score::truncate();
        User::truncate();
        UserGroup::truncate();
        UserGroupEvent::truncate();
        UserRelation::truncate();
        (new ScoreSearch())->deleteAll();
    }

    /**
     * @dataProvider dataProviderForTestUserRank
     */
    public function testUserRank(string $key, ?array $params, int $rank): void
    {
        $score = static::$scores[$key]->fresh();

        $this->assertSame($rank, $score->userRank($params));
    }

    public function dataProviderForTestUserRank(): array
    {
        return [
            ['user', null, 4],
            ['user', ['type' => 'country'], 2],
            ['userMods', ['mods' => ['DT', 'HD']], 3],
        ];
    }
}
