<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Libraries\Search\ScoreSearch;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Group;
use App\Models\Language;
use App\Models\OAuth;
use App\Models\Solo\Score as SoloScore;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupEvent;
use App\Models\UserRelation;
use Tests\TestCase;

class BeatmapsControllerSoloScoresTest extends TestCase
{
    protected $connectionsToTransact = [];

    private static Beatmap $beatmap;
    private static User $otherUser;
    private static array $scores;
    private static User $user;

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            static::$user = User::factory()->create(['osu_subscriber' => true]);
            static::$otherUser = User::factory()->create(['country_acronym' => Country::factory()]);
            $friend = User::factory()->create(['country_acronym' => Country::factory()]);
            static::$beatmap = Beatmap::factory()->qualified()->create();

            $countryAcronym = static::$user->country_acronym;

            $otherUser2 = User::factory()->create(['country_acronym' => Country::factory()]);
            $otherUser3SameCountry = User::factory()->create(['country_acronym' => $countryAcronym]);

            static::$scores = [];
            $scoreFactory = SoloScore::factory()->state(['build_id' => 0]);
            foreach (['solo' => false, 'legacy' => true] as $type => $isLegacy) {
                $scoreFactory = $scoreFactory->state([
                    'legacy_score_id' => $isLegacy ? rand() : null,
                ]);
                $makeMods = fn (array $modNames): array => array_map(
                    fn (string $modName): array => [
                        'acronym' => $modName,
                        'settings' => [],
                    ],
                    [...$modNames, ...($isLegacy ? ['CL'] : [])],
                );

                $makeTotalScores = fn (int $totalScore): array => [
                    'legacy_total_score' => $totalScore * ($isLegacy ? 1 : 0),
                    'total_score' => $totalScore + ($isLegacy ? -1 : 0),
                ];

                static::$scores = [
                    ...static::$scores,
                    "{$type}:userModsLowerScore" => $scoreFactory->withData([
                        'mods' => $makeMods(['DT', 'HD']),
                    ])->create([
                        ...$makeTotalScores(1000),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => static::$user,
                    ]),
                    "{$type}:otherUserModsNCPFHigherScore" => $scoreFactory->withData([
                        'mods' => $makeMods(['NC', 'PF']),
                    ])->create([
                        ...$makeTotalScores(1010),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => static::$otherUser,
                    ]),
                    "{$type}:userMods" => $scoreFactory->withData([
                        'mods' => $makeMods(['DT', 'HD']),
                    ])->create([
                        ...$makeTotalScores(1050),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => static::$user,
                    ]),
                    "{$type}:userModsNC" => $scoreFactory->withData([
                        'mods' => $makeMods(['NC']),
                    ])->create([
                        ...$makeTotalScores(1050),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => static::$user,
                    ]),
                    "{$type}:user" => $scoreFactory->create([
                        ...$makeTotalScores(1100),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => static::$user,
                    ]),
                    "{$type}:friend" => $scoreFactory->create([
                        ...$makeTotalScores(1000),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => $friend,
                    ]),
                    // With preference mods
                    "{$type}:otherUser" => $scoreFactory->withData([
                        'mods' => $makeMods(['PF']),
                    ])->create([
                        ...$makeTotalScores(1000),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => static::$otherUser,
                    ]),
                    "{$type}:otherUserMods" => $scoreFactory->withData([
                        'mods' => $makeMods(['HD', 'PF', 'NC']),
                    ])->create([
                        ...$makeTotalScores(1000),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => static::$otherUser,
                    ]),
                    "{$type}:otherUserModsExtraNonPreferences" => $scoreFactory->withData([
                        'mods' => $makeMods(['DT', 'HD', 'HR']),
                    ])->create([
                        ...$makeTotalScores(1000),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => static::$otherUser,
                    ]),
                    "{$type}:otherUserModsUnrelated" => $scoreFactory->withData([
                        'mods' => $makeMods(['FL']),
                    ])->create([
                        ...$makeTotalScores(1000),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => static::$otherUser,
                    ]),
                    // Same total score but achieved later so it should come up after earlier score
                    "{$type}:otherUser2Later" => $scoreFactory->create([
                        ...$makeTotalScores(1000),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => $otherUser2,
                    ]),
                    "{$type}:otherUser3SameCountry" => $scoreFactory->create([
                        ...$makeTotalScores(1000),
                        'beatmap_id' => static::$beatmap,
                        'preserve' => true,
                        'user_id' => $otherUser3SameCountry,
                    ]),
                    // Non-preserved score should be filtered out
                    "{$type}:nonPreserved" => $scoreFactory->create([
                        'beatmap_id' => static::$beatmap,
                        'preserve' => false,
                        'user_id' => User::factory()->state(['country_acronym' => Country::factory()]),
                    ]),
                    // Unrelated score
                    "{$type}:unrelated" => $scoreFactory->create([
                        'user_id' => User::factory()->state(['country_acronym' => Country::factory()]),
                    ]),
                ];
            }

            UserRelation::create([
                'friend' => true,
                'user_id' => static::$user->getKey(),
                'zebra_id' => $friend->getKey(),
            ]);

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
            OAuth\Client::truncate();
            OAuth\Token::truncate();
            SoloScore::truncate();
            User::truncate();
            UserGroup::truncate();
            UserGroupEvent::truncate();
            UserRelation::truncate();
            (new ScoreSearch())->deleteAll();
        });
    }

    /**
     * @dataProvider dataProviderForTestQuery
     * @group RequiresScoreIndexer
     */
    public function testQuery(array $scoreKeys, array $params, string $route)
    {
        $resp = $this->actingAs(static::$user)
            ->json('GET', route("beatmaps.{$route}", static::$beatmap), $params)
            ->assertSuccessful();

        $json = json_decode($resp->getContent(), true);
        $this->assertSame(count($scoreKeys), count($json['scores']));
        foreach ($json['scores'] as $i => $jsonScore) {
            $this->assertSame(static::$scores[$scoreKeys[$i]]->getKey(), $jsonScore['id']);
        }
    }

    /**
     * @group RequiresScoreIndexer
     */
    public function testUserScore()
    {
        $url = route('api.beatmaps.user.score', [
            'beatmap' => static::$beatmap->getKey(),
            'legacy_only' => 1,
            'mods' => ['DT', 'HD'],
            'user' => static::$user->getKey(),
        ]);
        $this->actAsScopedUser(static::$user);
        $this
            ->json('GET', $url)
            ->assertJsonPath('score.id', static::$scores['legacy:userMods']->legacy_score_id);
    }

    /**
     * @group RequiresScoreIndexer
     */
    public function testUserScoreInvalidRulesetName()
    {
        $url = route('api.beatmaps.user.score', [
            'beatmap' => static::$beatmap->getKey(),
            'legacy_only' => 1,
            'mode' => '_invalid',
            'mods' => ['DT', 'HD'],
            'user' => static::$user->getKey(),
        ]);
        $this->actAsScopedUser(static::$user);
        $this
            ->json('GET', $url)
            ->assertStatus(422);
    }

    /**
     * @group RequiresScoreIndexer
     */
    public function testUserScoreAll()
    {
        $url = route('api.beatmaps.user.scores', [
            'beatmap' => static::$beatmap->getKey(),
            'legacy_only' => 1,
            'user' => static::$user->getKey(),
        ]);
        $this->actAsScopedUser(static::$user);
        $this
            ->json('GET', $url)
            ->assertJsonCount(4, 'scores')
            ->assertJsonPath(
                'scores.*.id',
                array_map(fn (string $key): int => static::$scores[$key]->legacy_score_id, [
                    'legacy:user',
                    'legacy:userMods',
                    'legacy:userModsNC',
                    'legacy:userModsLowerScore',
                ])
            );
    }

    public static function dataProviderForTestQuery(): array
    {
        $ret = [];
        foreach (['solo' => 'solo-scores', 'legacy' => 'scores'] as $type => $route) {
            $ret = array_merge($ret, [
                "{$type}: no parameters" => [[
                    "{$type}:user",
                    "{$type}:otherUserModsNCPFHigherScore",
                    "{$type}:friend",
                    "{$type}:otherUser2Later",
                    "{$type}:otherUser3SameCountry",
                ], [], $route],
                "{$type}: by country" => [[
                    "{$type}:user",
                    "{$type}:otherUser3SameCountry",
                ], ['type' => 'country'], $route],
                "{$type}: by friend" => [[
                    "{$type}:user",
                    "{$type}:friend",
                ], ['type' => 'friend'], $route],
                "{$type}: mods filter" => [[
                    "{$type}:userMods",
                    "{$type}:otherUserMods",
                ], ['mods' => ['DT', 'HD']], $route],
                "{$type}: mods with implied filter" => [[
                    "{$type}:userModsNC",
                    "{$type}:otherUserModsNCPFHigherScore",
                ], ['mods' => ['NC']], $route],
                "{$type}: mods with nomods" => [[
                    "{$type}:user",
                    "{$type}:otherUserModsNCPFHigherScore",
                    "{$type}:friend",
                    "{$type}:otherUser2Later",
                    "{$type}:otherUser3SameCountry",
                ], ['mods' => ['NC', 'NM']], $route],
                "{$type}: nomods filter" => [[
                    "{$type}:user",
                    "{$type}:friend",
                    "{$type}:otherUser",
                    "{$type}:otherUser2Later",
                    "{$type}:otherUser3SameCountry",
                ], ['mods' => ['NM']], $route],
            ]);
        }

        return $ret;
    }
}
