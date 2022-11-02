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
use App\Models\Solo\Score as SoloScore;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupEvent;
use App\Models\UserRelation;
use Artisan;
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
        (new static())->refreshApplication();
        static::$user = User::factory()->create(['osu_subscriber' => true]);
        static::$otherUser = User::factory()->create(['country_acronym' => Country::factory()]);
        $friend = User::factory()->create(['country_acronym' => Country::factory()]);
        static::$beatmap = Beatmap::factory()->qualified()->create();

        $countryAcronym = static::$user->country_acronym;

        static::$scores = [];
        $scoreFactory = SoloScore::factory();
        foreach (['solo' => 0, 'legacy' => null] as $type => $buildId) {
            $defaultData = ['build_id' => $buildId];

            static::$scores = array_merge(static::$scores, [
                "{$type}:user" => $scoreFactory->withData($defaultData, ['total_score' => 1100])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => static::$user,
                ]),
                "{$type}:userMods" => $scoreFactory->withData($defaultData, [
                    'total_score' => 1050,
                    'mods' => static::defaultMods(['DT', 'HD']),
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => static::$user,
                ]),
                "{$type}:userModsNC" => $scoreFactory->withData($defaultData, [
                    'total_score' => 1050,
                    'mods' => static::defaultMods(['NC']),
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => static::$user,
                ]),
                "{$type}:otherUserModsNCPFHigherScore" => $scoreFactory->withData($defaultData, [
                    'total_score' => 1010,
                    'mods' => static::defaultMods(['NC', 'PF']),
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => static::$otherUser,
                ]),
                "{$type}:userModsLowerScore" => $scoreFactory->withData($defaultData, [
                    'total_score' => 1000,
                    'mods' => static::defaultMods(['DT', 'HD']),
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => static::$user,
                ]),
                "{$type}:friend" => $scoreFactory->withData($defaultData, ['total_score' => 1000])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => $friend,
                ]),
                // With preference mods
                "{$type}:otherUser" => $scoreFactory->withData($defaultData, [
                    'total_score' => 1000,
                    'mods' => static::defaultMods(['PF']),
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => static::$otherUser,
                ]),
                "{$type}:otherUserMods" => $scoreFactory->withData($defaultData, [
                    'total_score' => 1000,
                    'mods' => static::defaultMods(['HD', 'PF', 'NC']),
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => static::$otherUser,
                ]),
                "{$type}:otherUserModsExtraNonPreferences" => $scoreFactory->withData($defaultData, [
                    'total_score' => 1000,
                    'mods' => static::defaultMods(['DT', 'HD', 'HR']),
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => static::$otherUser,
                ]),
                "{$type}:otherUserModsUnrelated" => $scoreFactory->withData($defaultData, [
                    'total_score' => 1000,
                    'mods' => static::defaultMods(['FL']),
                ])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => static::$otherUser,
                ]),
                // Same total score but achieved later so it should come up after earlier score
                "{$type}:otherUser2Later" => $scoreFactory->withData($defaultData, ['total_score' => 1000])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => User::factory()->state(['country_acronym' => Country::factory()]),
                ]),
                "{$type}:otherUser3SameCountry" => $scoreFactory->withData($defaultData, ['total_score' => 1000])->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => true,
                    'user_id' => User::factory()->state(['country_acronym' => $countryAcronym]),
                ]),
                // Non-preserved score should be filtered out
                "{$type}:nonPreserved" => $scoreFactory->withData($defaultData)->create([
                    'beatmap_id' => static::$beatmap,
                    'preserve' => false,
                    'user_id' => User::factory()->state(['country_acronym' => Country::factory()]),
                ]),
                // Unrelated score
                "{$type}:unrelated" => $scoreFactory->withData($defaultData)->create([
                    'user_id' => User::factory()->state(['country_acronym' => Country::factory()]),
                ]),
            ]);
        }

        UserRelation::create([
            'friend' => true,
            'user_id' => static::$user->getKey(),
            'zebra_id' => $friend->getKey(),
        ]);

        Artisan::call('es:index-scores:queue', [
            '--all' => true,
            '--no-interaction' => true,
        ]);
        (new ScoreSearch())->indexWait();
    }

    public static function tearDownAfterClass(): void
    {
        (new static())->refreshApplication();
        Beatmap::truncate();
        Beatmapset::truncate();
        Country::truncate();
        Genre::truncate();
        Group::truncate();
        Language::truncate();
        SoloScore::truncate();
        User::truncate();
        UserGroup::truncate();
        UserGroupEvent::truncate();
        UserRelation::truncate();
        (new ScoreSearch())->deleteAll();
    }

    private static function defaultMods(array $modNames): array
    {
        return array_map(
            fn ($modName) => [
                'acronym' => $modName,
                'settings' => [],
            ],
            $modNames,
        );
    }

    /**
     * @dataProvider dataProviderForTestQuery
     * @group EsSoloScores
     */
    public function testQuery(array $scoreKeys, array $params)
    {
        $resp = $this->actingAs(static::$user)
            ->json('GET', route('beatmaps.solo-scores', static::$beatmap), $params)
            ->assertSuccessful();

        $json = json_decode($resp->getContent(), true);
        $this->assertSame(count($scoreKeys), count($json['scores']));
        foreach ($json['scores'] as $i => $jsonScore) {
            $this->assertSame(static::$scores[$scoreKeys[$i]]->getKey(), $jsonScore['id']);
        }
    }

    public function dataProviderForTestQuery(): array
    {
        return [
            'no parameters' => [[
                'solo:user',
                'solo:otherUserModsNCPFHigherScore',
                'solo:friend',
                'solo:otherUser2Later',
                'solo:otherUser3SameCountry',
            ], []],
            'by country' => [[
                'solo:user',
                'solo:otherUser3SameCountry',
            ], ['type' => 'country']],
            'by friend' => [[
                'solo:user',
                'solo:friend',
            ], ['type' => 'friend']],
            'mods filter' => [[
                'solo:userMods',
                'solo:otherUserMods',
            ], ['mods' => ['DT', 'HD']]],
            'mods with implied filter' => [[
                'solo:userModsNC',
                'solo:otherUserModsNCPFHigherScore',
            ], ['mods' => ['NC']]],
            'mods with nomods' => [[
                'solo:user',
                'solo:otherUserModsNCPFHigherScore',
                'solo:friend',
                'solo:otherUser2Later',
                'solo:otherUser3SameCountry',
            ], ['mods' => ['NC', 'NM']]],
            'nomods filter' => [[
                'solo:user',
                'solo:friend',
                'solo:otherUser',
                'solo:otherUser2Later',
                'solo:otherUser3SameCountry',
            ], ['mods' => ['NM']]],
        ];
    }
}
