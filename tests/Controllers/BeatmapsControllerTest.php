<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\Country;
use App\Models\Score\Best\Model as ScoreBest;
use App\Models\User;
use App\Models\UserRelation;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class BeatmapsControllerTest extends TestCase
{
    private $user;
    private $beatmap;

    /**
     * @group RequiresBeatmapDifficultyLookupCache
     */
    public function testAttributes(): void
    {
        $beatmap = $this->createExistingOsuBeatmap();

        $this->actAsScopedUser(User::factory()->create(), ['public']);

        $this->post(route('api.beatmaps.attributes', ['beatmap' => $beatmap->getKey()]), [
            'mods' => 1,
        ])
            ->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->has('attributes.star_rating')
                    ->has('attributes.max_combo')
                    ->etc());
    }

    public function testAttributesInvalidRuleset(): void
    {
        $beatmap = $this->createExistingOsuBeatmap();

        $this->actAsScopedUser(User::factory()->create(), ['public']);

        $this->post(route('api.beatmaps.attributes', ['beatmap' => $beatmap->getKey(), 'ruleset' => 'invalid']))
            ->assertStatus(422);
    }

    public function testAttributesInvalidRulesetId(): void
    {
        $beatmap = $this->createExistingOsuBeatmap();

        $this->actAsScopedUser(User::factory()->create(), ['public']);

        $this->post(route('api.beatmaps.attributes', ['beatmap' => $beatmap->getKey(), 'ruleset_id' => 1000]))
            ->assertStatus(422);
    }

    public function testAttributesInvalidConversion(): void
    {
        $beatmap = $this->createExistingFruitsBeatmap();

        $this->actAsScopedUser(User::factory()->create(), ['public']);

        $this->post(route('api.beatmaps.attributes', ['beatmap' => $beatmap->getKey(), 'ruleset' => 'mania']))
            ->assertStatus(422);
    }

    public function testIndexForApi(): void
    {
        $beatmap = Beatmap::factory()->create();
        $beatmapB = Beatmap::factory()->create();
        $beatmapC = Beatmap::factory()->create();
        $beatmapC->beatmapset->update(['active' => false]);

        $this->actAsScopedUser(User::factory()->create(), ['*']);

        $this
            ->get(route('api.beatmaps.index', ['ids' => [$beatmap->getKey(), $beatmapB->getKey(), $beatmapC->getKey()]]))
            ->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->where('beatmaps.0.id', $beatmap->getKey())
                    ->where('beatmaps.1.id', $beatmapB->getKey())
                    ->missing('beatmaps.2')
                    ->etc());
    }

    public function testIndexForApiMissingParameter(): void
    {
        $this->actAsScopedUser(User::factory()->create(), ['*']);

        $this
            ->get(route('api.beatmaps.index'))
            ->assertSuccessful();
    }

    public function testInvalidMode()
    {
        $this->json('GET', route('beatmaps.scores', $this->beatmap), [
            'mode' => 'nope',
        ])->assertStatus(404);
    }

    /**
     * @dataProvider dataProviderForTestLookupForApi
     */
    public function testLookupForApi(string $key, callable $valueFn): void
    {
        $beatmap = Beatmap::factory()->create();

        $this->actAsScopedUser(User::factory()->create(), ['*']);

        $this
            ->get(route('api.beatmaps.lookup', [$key => $valueFn($beatmap)]))
            ->assertSuccessful()
            ->assertJsonPath('id', $beatmap->getKey());
    }

    /**
     * Make sure the lookup stops when finding beatmap from one of the parameters
     */
    public function testLookupMultipleParamsForApi(): void
    {
        $beatmap = Beatmap::factory()->create();

        $this->actAsScopedUser(User::factory()->create(), ['*']);

        $this
            ->get(route('api.beatmaps.lookup', [
                'checksum' => '',
                'id' => (string) $beatmap->getKey(),
                'filename' => '',
            ]))
            ->assertSuccessful()
            ->assertJsonPath('id', $beatmap->getKey());
    }

    /**
     * Checks whether HTTP 403 is thrown when a logged out
     * user tries to access the non-general (country or friend ranking)
     * scoreboards.
     */
    public function testScoresNonGeneralLoggedOut()
    {
        $this->json('GET', route('beatmaps.scores', $this->beatmap), [
            'type' => 'country',
        ])->assertStatus(422)
        ->assertJson(['error' => osu_trans('errors.supporter_only')]);
    }

    /**
     * Checks whether an error is thrown when an user without supporter
     * tries to access supporter-only scoreboards.
     */
    public function testScoresNonGeneralSupporter()
    {
        $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', $this->beatmap), [
                'type' => 'country',
            ])->assertStatus(422)
            ->assertJson(['error' => osu_trans('errors.supporter_only')]);

        $this->user->osu_subscriber = true;
        $this->user->save();

        $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', $this->beatmap), [
                'type' => 'country',
            ])->assertStatus(200);
    }

    public function testScores()
    {
        $scoreClass = ScoreBest::getClassByRulesetId($this->beatmap->playmode);
        $scores = [
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'score' => 1100,
                'user_id' => $this->user,
            ]),
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'score' => 1000,
            ]),
            // Same total score but achieved later so it should come up after earlier score
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'score' => 1000,
            ]),
        ];
        // Hidden score should be filtered out
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
            'hidden' => true,
            'score' => 800,
        ]);
        // Another score from scores[0] user (should be filtered out)
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
            'score' => 800,
            'user_id' => $this->user,
        ]);
        // Unrelated score
        ScoreBest::getClass(array_rand(Beatmap::MODES))::factory()->create();

        $resp = $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', $this->beatmap))
            ->assertSuccessful();

        $this->assertSameScoresFromResponse($scores, $resp);
    }

    public function testScoresByCountry()
    {
        $countryAcronym = $this->user->country_acronym;
        $scoreClass = ScoreBest::getClassByRulesetId($this->beatmap->playmode);
        $scores = [
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'country_acronym' => $countryAcronym,
                'score' => 1100,
                'user_id' => $this->user,
            ]),
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'score' => 1000,
                'country_acronym' => $countryAcronym,
                'user_id' => User::factory()->state(['country_acronym' => $countryAcronym]),
            ]),
        ];
        $otherCountry = Country::factory()->create();
        $otherCountryAcronym = $otherCountry->acronym;
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
            'country_acronym' => $otherCountryAcronym,
            'user_id' => User::factory()->state(['country_acronym' => $otherCountryAcronym]),
        ]);

        $this->user->update(['osu_subscriber' => true]);
        $resp = $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', ['beatmap' => $this->beatmap, 'type' => 'country']))
            ->assertSuccessful();

        $this->assertSameScoresFromResponse($scores, $resp);
    }

    public function testScoresByFriend()
    {
        $friend = User::factory()->create();
        $scoreClass = ScoreBest::getClassByRulesetId($this->beatmap->playmode);
        $scores = [
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'score' => 1100,
                'user_id' => $friend,
            ]),
            // Own score is included
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'score' => 1000,
                'user_id' => $this->user,
            ]),
        ];
        UserRelation::create([
            'friend' => true,
            'user_id' => $this->user->getKey(),
            'zebra_id' => $friend->getKey(),
        ]);
        // Non-friend score is filtered out
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
        ]);

        $this->user->update(['osu_subscriber' => true]);
        $resp = $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', ['beatmap' => $this->beatmap, 'type' => 'friend']))
            ->assertSuccessful();

        $this->assertSameScoresFromResponse($scores, $resp);
    }

    public function testScoresModsFilter()
    {
        $modsHelper = app('mods');
        $scoreClass = ScoreBest::getClassByRulesetId($this->beatmap->playmode);
        $scores = [
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'enabled_mods' => $modsHelper->idsToBitset(['DT', 'HD']),
                'score' => 1500,
            ]),
            // Score with preference mods is included
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'enabled_mods' => $modsHelper->idsToBitset(['DT', 'HD', 'NC', 'PF']),
                'score' => 1100,
                'user_id' => $this->user,
            ]),
        ];
        // No mod is filtered out
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
            'enabled_mods' => 0,
        ]);
        // Unrelated mod is filtered out
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
            'enabled_mods' => $modsHelper->idsToBitset(['FL']),
        ]);
        // Extra non-preference mod is filtered out
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
            'enabled_mods' => $modsHelper->idsToBitset(['DT', 'HD', 'HR']),
        ]);
        // From same user but lower score is filtered out
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
            'enabled_mods' => $modsHelper->idsToBitset(['DT', 'HD']),
            'score' => 1000,
            'user_id' => $this->user,
        ]);

        $this->user->update(['osu_subscriber' => true]);
        $resp = $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', ['beatmap' => $this->beatmap, 'mods' => ['DT', 'HD']]))
            ->assertSuccessful();

        $this->assertSameScoresFromResponse($scores, $resp);
    }

    public function testScoresModsWithImpliedFilter()
    {
        $modsHelper = app('mods');
        $scoreClass = ScoreBest::getClassByRulesetId($this->beatmap->playmode);
        $scores = [
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'enabled_mods' => $modsHelper->idsToBitset(['DT', 'NC']),
                'score' => 1500,
            ]),
            // Score with preference mods is included
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'enabled_mods' => $modsHelper->idsToBitset(['DT', 'NC', 'PF']),
                'score' => 1100,
                'user_id' => $this->user,
            ]),
        ];
        // No mod is filtered out
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
            'enabled_mods' => 0,
        ]);

        $this->user->update(['osu_subscriber' => true]);
        $resp = $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', ['beatmap' => $this->beatmap, 'mods' => ['NC']]))
            ->assertSuccessful();

        $this->assertSameScoresFromResponse($scores, $resp);
    }

    public function testScoresModsWithNomodsFilter()
    {
        $modsHelper = app('mods');
        $scoreClass = ScoreBest::getClassByRulesetId($this->beatmap->playmode);
        $scores = [
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'enabled_mods' => $modsHelper->idsToBitset(['DT', 'NC']),
                'score' => 1500,
            ]),
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'enabled_mods' => 0,
                'score' => 1100,
                'user_id' => $this->user,
            ]),
        ];
        // With unrelated mod
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
            'enabled_mods' => $modsHelper->idsToBitset(['DT', 'NC', 'HD']),
            'score' => 1500,
        ]);

        $this->user->update(['osu_subscriber' => true]);
        $resp = $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', ['beatmap' => $this->beatmap, 'mods' => ['DT', 'NC', 'NM']]))
            ->assertSuccessful();

        $this->assertSameScoresFromResponse($scores, $resp);
    }

    public function testScoresNomodsFilter()
    {
        $modsHelper = app('mods');
        $scoreClass = ScoreBest::getClassByRulesetId($this->beatmap->playmode);
        $scores = [
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'score' => 1500,
                'enabled_mods' => 0,
            ]),
            // Preference mod is included
            $scoreClass::factory()->create([
                'beatmap_id' => $this->beatmap,
                'score' => 1100,
                'user_id' => $this->user,
                'enabled_mods' => $modsHelper->idsToBitset(['PF']),
            ]),
        ];
        // Non-preference mod is filtered out
        $scoreClass::factory()->create([
            'beatmap_id' => $this->beatmap,
            'enabled_mods' => $modsHelper->idsToBitset(['DT']),
        ]);

        $this->user->update(['osu_subscriber' => true]);
        $resp = $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', ['beatmap' => $this->beatmap, 'mods' => ['NM']]))
            ->assertSuccessful();

        $this->assertSameScoresFromResponse($scores, $resp);
    }

    public function testShowForApi()
    {
        $beatmap = Beatmap::factory()->create();

        $this->actAsScopedUser(User::factory()->create(), ['*']);

        $this
            ->get(route('api.beatmaps.show', ['beatmap' => $beatmap->getKey()]))
            ->assertSuccessful()
            ->assertJsonPath('id', $beatmap->getKey());
    }

    public function testUpdateOwner(): void
    {
        $otherUser = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $this->user,
        ]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapsetEventCount = BeatmapsetEvent::count();

        $this->actingAsVerified($this->user)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => $otherUser->getKey()],
            ])->assertSuccessful();

        $this->assertSame($otherUser->getKey(), $this->beatmap->fresh()->user_id);
        $this->assertSame($beatmapsetEventCount + 1, BeatmapsetEvent::count());
    }

    public function testUpdateOwnerInvalidState(): void
    {
        $otherUser = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['qualified'],
            'user_id' => $this->user,
        ]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapsetEventCount = BeatmapsetEvent::count();

        $this->actingAsVerified($this->user)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => $otherUser->getKey()],
            ])->assertStatus(403);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
        $this->assertSame($beatmapsetEventCount, BeatmapsetEvent::count());
    }

    public function testUpdateOwnerInvalidUser(): void
    {
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $this->user,
        ]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapsetEventCount = BeatmapsetEvent::count();

        $this->actingAsVerified($this->user)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => User::max('user_id') + 1],
            ])->assertStatus(422);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
        $this->assertSame($beatmapsetEventCount, BeatmapsetEvent::count());
    }

    /**
     * @dataProvider dataProviderForTestUpdateOwnerLoved
     */
    public function testUpdateOwnerLoved(int $approved, bool $ok): void
    {
        $moderator = User::factory()->withGroup('loved')->create();
        $this->beatmap->beatmapset->update([
            'approved' => $approved,
            'approved_date' => now(),
        ]);

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), $ok ? 1 : 0);
        $expectedOwner = $ok ? $this->user->getKey() : $this->beatmap->fresh()->user_id;

        $this->actingAsVerified($moderator)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => $this->user->getKey()],
            ])->assertStatus($ok ? 200 : 403);

        $this->assertSame($expectedOwner, $this->beatmap->fresh()->user_id);
    }

    public function testUpdateOwnerModerator(): void
    {
        $moderator = User::factory()->withGroup('nat')->create();
        $this->beatmap->beatmapset->update([
            'approved' => Beatmapset::STATES['ranked'],
            'approved_date' => now(),
        ]);

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 1);

        $this->actingAsVerified($moderator)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => $this->user->getKey()],
            ])->assertSuccessful();

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
    }

    public function testUpdateOwnerNotOwner(): void
    {
        $otherUser = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create(['user_id' => $this->user]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapsetEventCount = BeatmapsetEvent::count();

        $this->actingAsVerified($otherUser)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => $otherUser->getKey()],
            ])->assertStatus(403);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
        $this->assertSame($beatmapsetEventCount, BeatmapsetEvent::count());
    }

    public function testUpdateOwnerSameOwner(): void
    {
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $this->user,
        ]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapsetEventCount = BeatmapsetEvent::count();

        $this->actingAsVerified($this->user)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => $this->user->getKey()],
            ])->assertStatus(422);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
        $this->assertSame($beatmapsetEventCount, BeatmapsetEvent::count());
    }

    public static function dataProviderForTestLookupForApi(): array
    {
        return [
            'checksum' => ['checksum', fn (Beatmap $b) => $b->checksum],
            'filename' => ['filename', fn (Beatmap $b) => $b->filename],
            'id' => ['id', fn (Beatmap $b) => $b->getKey()],
        ];
    }

    public static function dataProviderForTestUpdateOwnerLoved(): array
    {
        return [
            [Beatmapset::STATES['graveyard'], true],
            [Beatmapset::STATES['loved'], true],
            [Beatmapset::STATES['ranked'], false],
            [Beatmapset::STATES['wip'], false],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->beatmap = Beatmap::factory()->qualified()->create();
    }

    private function assertSameScoresFromResponse(array $scores, TestResponse $response): void
    {
        $json = json_decode($response->getContent(), true);
        $this->assertSame(count($scores), count($json['scores']));
        foreach ($json['scores'] as $i => $jsonScore) {
            $this->assertSame($scores[$i]->getKey(), $jsonScore['id']);
        }
    }

    private function createExistingFruitsBeatmap()
    {
        return Beatmap::factory()->create([
            'beatmap_id' => 2177697,
            'beatmapset_id' => Beatmapset::factory(['beatmapset_id' => 918591]),
            'playmode' => Beatmap::MODES['fruits'],
        ]);
    }

    private function createExistingOsuBeatmap()
    {
        return Beatmap::factory()->create([
            'beatmap_id' => 567606,
            'beatmapset_id' => Beatmapset::factory(['beatmapset_id' => 246416]),
        ]);
    }
}
