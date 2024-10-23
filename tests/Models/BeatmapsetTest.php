<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Exceptions\AuthorizationException;
use App\Exceptions\InvariantException;
use App\Exceptions\UnsupportedNominationException;
use App\Jobs\CheckBeatmapsetCovers;
use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Libraries\Beatmapset\ChangeBeatmapOwners;
use App\Libraries\Beatmapset\NominateBeatmapset;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\BeatmapsetNomination;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Bus;
use Database\Factories\BeatmapsetFactory;
use Queue;
use Tests\TestCase;

class BeatmapsetTest extends TestCase
{
    public static function disqualifyOrResetNominationsDataProvider()
    {
        return [
            ['pending', BeatmapsetResetNominations::class],
            ['qualified', BeatmapsetDisqualify::class],
        ];
    }

    public static function dataProviderForTestRank(): array
    {
        return [
            ['pending', false],
            ['qualified', true],
        ];
    }

    public static function mainRulesetHybridBeatmapsetSameCountDataProvider()
    {
        return [
            [[
                [['osu', 'taiko'], null],
                [['taiko'], 'taiko'],
            ]],
            [[
                [['osu', 'taiko'], null],
                [['taiko', 'fruits'], 'taiko'],
            ]],
            [[
                [['osu', 'taiko'], null],
                [['fruits', 'mania'], null],
            ]],
            [[
                [['fruits'], 'fruits'],
                [['osu'], 'fruits'],
            ]],
        ];
    }

    public static function mainRulesetHybridBeatmapsetWithGuestMappersSameCountDataProvider()
    {
        return [
            [[
                [['osu', 'taiko'], null],
                [['taiko'], null, 'too_many_non_main_ruleset'],
            ]],
            [[
                [['osu', 'taiko'], null],
                [['taiko', 'fruits'], null, 'too_many_non_main_ruleset'],
            ]],
            [[
                [['osu', 'taiko'], null],
                [['fruits', 'mania'], null],
                [['fruits'], 'fruits'],
            ]],
            [[
                [['fruits'], 'fruits'],
                [['mania'], 'fruits'],
            ]],
        ];
    }

    public static function nominateDataProvider()
    {
        return [
            'bng nominate same ruleset' => ['bng', ['osu'], 'osu', true],
            'bng nominate different ruleset' => ['bng', ['osu'], 'taiko', false],
            'nat defaults to all rulesets' => ['nat', [], 'osu', true],
            'nat nominate same ruleset' => ['nat', ['osu'], 'osu', true],
            'nat nominate different ruleset' => ['nat', ['osu'], 'taiko', false],
        ];
    }

    public static function qualifyingNominationsDataProvider(): array
    {
        // existing nominations, qualifying nomination, expected
        return [
            'Nomination requires at least one full nominator' => ['bng_limited', 'bng_limited', false],

            // limited bngs can be the qualifying nomination
            ['bng', 'bng_limited', true],
            ['nat', 'bng_limited', true],

            ['bng_limited', 'bng', true],
            ['bng_limited', 'nat', true],
        ];
    }

    public static function qualifyingNominationsHybridDataProvider(): array
    {
        // existing nominations, qualifying nomination, expected
        return [
            'Nomination requires at least one full nominator' => ['bng_limited', 'bng_limited', false],
            'Limited BNs cannot nominate the hybrid mode #1' => ['bng', 'bng_limited', false],
            'Limited BNs cannot nominate the hybrid mode #2' => ['nat', 'bng_limited', false],

            ['bng_limited', 'bng', true],
            ['bng_limited', 'nat', true],
        ];
    }

    public static function rankWithOpenIssueDataProvider()
    {
        return [
            ['problem'],
            ['suggestion'],
        ];
    }

    public function testInvalidStatePending()
    {
        $user = User::factory()->withGroup('nat')->create();
        $beatmapset = $this->beatmapsetFactory()->qualified()->withBeatmaps()->create();

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage(osu_trans('beatmaps.nominations.incorrect_state'));

        $beatmapset->fresh()->nominate($user, $beatmapset->playmodesStr());
    }

    public function testInvalidStateRequiredHype()
    {
        config_set('osu.beatmapset.required_hype', 2);

        $user = User::factory()->withGroup('nat')->create();
        $beatmapset = $this->beatmapsetFactory()->withBeatmaps()->withHypes(1)->create();

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage(osu_trans('beatmaps.nominations.not_enough_hype'));

        $beatmapset->fresh()->nominate($user, $beatmapset->playmodesStr());
    }

    public function testInvalidStateUnresolvedIssues()
    {
        $user = User::factory()->withGroup('nat')->create();

        $beatmapset = $this->beatmapsetFactory()
            ->withBeatmaps()
            ->has(BeatmapDiscussion::factory()->general()->problem())
            ->create();

        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage(osu_trans('beatmaps.nominations.unresolved_issues'));

        $beatmapset->fresh()->nominate($user, $beatmapset->playmodesStr());
    }

    public function testLove()
    {
        $user = User::factory()->create();
        $beatmapset = $this->beatmapsetFactory()->withBeatmaps()->create();
        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $this->expectCountChange(fn () => $beatmapset->bssProcessQueues()->count(), 1);
        $this->expectCountChange(fn () => Notification::count(), 1);
        $this->expectCountChange(fn () => UserNotification::count(), 1);

        $beatmapset = $beatmapset->fresh();
        $beatmapset->love($user);

        $beatmapset = $beatmapset->fresh();
        $this->assertTrue($beatmapset->isLoved());
        $this->assertSame('loved', $beatmapset->beatmaps()->first()->status());

        Bus::assertDispatched(CheckBeatmapsetCovers::class);
    }

    public function testLoveBeatmapApprovedStates(): void
    {
        $user = User::factory()->create();
        $beatmapset = $this->beatmapsetFactory()->withBeatmaps()->create();

        $specifiedBeatmap = $beatmapset->beatmaps()->first();
        $beatmapset->beatmaps()->saveMany([
            $graveyardBeatmap = Beatmap::factory()->make(['approved' => Beatmapset::STATES['graveyard']]),
            $pendingBeatmap = Beatmap::factory()->make(['approved' => Beatmapset::STATES['pending']]),
            $wipBeatmap = Beatmap::factory()->make(['approved' => Beatmapset::STATES['wip']]),
            $rankedBeatmap = Beatmap::factory()->make(['approved' => Beatmapset::STATES['ranked']]),
        ]);

        $beatmapset->fresh()->love($user, [$specifiedBeatmap->getKey()]);

        $this->assertTrue($beatmapset->fresh()->isLoved());
        $this->assertSame('loved', $specifiedBeatmap->fresh()->status());
        $this->assertSame('graveyard', $graveyardBeatmap->fresh()->status());
        $this->assertSame('graveyard', $pendingBeatmap->fresh()->status());
        $this->assertSame('graveyard', $wipBeatmap->fresh()->status());
        $this->assertSame('ranked', $rankedBeatmap->fresh()->status());

        Bus::assertDispatched(CheckBeatmapsetCovers::class);
    }

    public function testMainRulesetSingleBeatmap()
    {
        $beatmapset = $this->beatmapsetFactory()->withBeatmaps('taiko')->create();

        $this->assertSame('taiko', $beatmapset->mainRuleset());
    }

    public function testMainRulesetHybridBeatmapset()
    {
        $beatmapset = $this->beatmapsetFactory()
            ->withBeatmaps('osu', 1)
            ->withBeatmaps('taiko', 2)
            ->withBeatmaps('fruits', 3)
            ->withBeatmaps('mania', 1)
            ->create();

        $this->assertSame('fruits', $beatmapset->mainRuleset());
    }

    /**
     * @dataProvider mainRulesetHybridBeatmapsetSameCountDataProvider
     */
    public function testMainRulesetHybridBeatmapsetSameCount(array $steps)
    {
        $userFactory = User::factory()->withGroup('bng', ['osu', 'taiko', 'fruits', 'mania']);

        $beatmapset = $this->beatmapsetFactory()
            ->withBeatmaps('osu')
            ->withBeatmaps('taiko')
            ->withBeatmaps('fruits')
            ->withBeatmaps('mania')
            ->create();

        $this->assertSame(null, $beatmapset->mainRuleset());

        foreach ($steps as $step) {
            $nominatedRulesets = $step[0];
            $expectedMainRuleset = $step[1];

            $beatmapset->fresh()->nominate($userFactory->create(), $nominatedRulesets);

            $this->assertSame($expectedMainRuleset, $beatmapset->fresh()->mainRuleset());
        }
    }

    public function testMainRulesetHybridBeatmapsetWithGuestMappers()
    {
        $guest = User::factory()->create();

        $beatmapset = $this->beatmapsetFactory()
            ->withBeatmaps('osu', 1, $guest)
            ->withBeatmaps('taiko', 3, $guest)
            ->withBeatmaps('taiko', 1)
            ->withBeatmaps('fruits', 2, $guest)
            ->withBeatmaps('fruits', 2)
            ->withBeatmaps('mania', 1)
            ->create();

        $this->assertSame('fruits', $beatmapset->mainRuleset());
    }

    /**
     * @dataProvider mainRulesetHybridBeatmapsetWithGuestMappersSameCountDataProvider
     */
    public function testMainRulesetHybridBeatmapsetWithGuestMappersSameCount(array $steps)
    {
        $userFactory = User::factory()->withGroup('bng', ['osu', 'taiko', 'fruits', 'mania']);
        $guest = User::factory()->create();

        // possible main ruleset will be catch or mania.
        $beatmapset = $this->beatmapsetFactory()
            ->withBeatmaps('osu', 1)
            ->withBeatmaps('taiko', 1, $guest)
            ->withBeatmaps('taiko', 1)
            ->withBeatmaps('fruits', 2, $guest)
            ->withBeatmaps('fruits', 2)
            ->withBeatmaps('mania', 2, $guest)
            ->withBeatmaps('mania', 2)
            ->create();

        $this->assertSame(null, $beatmapset->mainRuleset());

        foreach ($steps as $step) {
            $nominatedRulesets = $step[0];
            $expectedMainRuleset = $step[1];
            $expectedErrorMessage = $step[2] ?? null;

            if ($expectedErrorMessage !== null) {
                $this->expectException(InvariantException::class);
                $this->expectExceptionMessage(osu_trans("beatmapsets.nominate.{$expectedErrorMessage}"));
            }

            $beatmapset->fresh()->nominate($userFactory->create(), $nominatedRulesets);

            $this->assertSame($expectedMainRuleset, $beatmapset->fresh()->mainRuleset());
        }
    }

    public function testNominationsByType()
    {
        $beatmapset = $this->beatmapsetFactory()
            ->withBeatmaps('osu')
            ->withBeatmaps('taiko')
            ->withBeatmaps('fruits')
            ->withBeatmaps('mania')
            ->create();

        $userFactory = User::factory()->withGroup('bng', ['osu', 'taiko', 'fruits', 'mania']);
        $countFilter = fn ($array, $mode) => array_filter($array, fn ($item) => $item === $mode);

        $beatmapset->fresh()->nominate($userFactory->create(), ['osu']);
        $this->assertCount(1, $beatmapset->nominationsByType()['full']);
        $this->assertCount(1, $countFilter($beatmapset->nominationsByType()['full'], 'osu'));

        $beatmapset->fresh()->nominate($userFactory->create(), ['taiko']);
        $this->assertCount(2, $beatmapset->nominationsByType()['full']);
        $this->assertCount(1, $countFilter($beatmapset->nominationsByType()['full'], 'taiko'));

        $beatmapset->fresh()->nominate($userFactory->create(), ['fruits']);
        $this->assertCount(3, $beatmapset->nominationsByType()['full']);
        $this->assertCount(1, $countFilter($beatmapset->nominationsByType()['full'], 'fruits'));

        $beatmapset->fresh()->nominate($userFactory->create(), ['mania']);
        $this->assertCount(4, $beatmapset->nominationsByType()['full']);
        $this->assertCount(1, $countFilter($beatmapset->nominationsByType()['full'], 'mania'));

        $this->assertCount(0, $beatmapset->nominationsByType()['limited']);

        $beatmapset->fresh()->nominate(
            User::factory()->withGroup('bng_limited', ['osu'])->create(),
            ['osu']
        );

        $beatmapset = $beatmapset->fresh();
        $this->assertCount(4, $beatmapset->nominationsByType()['full']);
        $this->assertCount(1, $beatmapset->nominationsByType()['limited']);
        $this->assertCount(1, $countFilter($beatmapset->nominationsByType()['limited'], 'osu'));
    }

    //region single-playmode beatmap sets

    /**
     * @dataProvider nominateDataProvider
     */
    public function testNominate(string $group, array $groupPlaymodes, string $ruleset, bool $success)
    {
        $beatmapset = $this->beatmapsetFactory()->withBeatmaps($ruleset)->create();
        $user = User::factory()->withGroup($group, $groupPlaymodes)->create();
        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);
        $nominatedModes = [$ruleset];

        $this->assertNotificationChanges($success);
        $this->assertNominationChanges($beatmapset, $success);

        $this->expectExceptionCallable(
            fn () => $beatmapset->fresh()->nominate($user, $nominatedModes),
            $success ? null : InvariantException::class
        );

        $beatmapset = $beatmapset->fresh();

        if ($success) {
            $this->assertSame($nominatedModes, $beatmapset->beatmapsetNominations()->current()->first()->modes);
        }

        // Assertions that nomination doesn't qualify
        $this->assertTrue($beatmapset->fresh()->isPending());
        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
    }

    public function testNominateMainRulesetInvariant()
    {
        $beatmapset = $this->beatmapsetFactory()
            ->withBeatmaps('osu')
            ->withBeatmaps('taiko')
            ->withNominations(['osu', 'taiko'], 1)
            ->create();

        $user = User::factory()->withGroup('bng', ['osu', 'taiko'])->create();

        $this->assertNominationChanges($beatmapset, false);

        $this->expectExceptionCallable(
            fn () => $beatmapset->fresh()->nominate($user, ['osu', 'taiko']),
            InvariantException::class,
            osu_trans('beatmapsets.nominate.too_many_non_main_ruleset')
        );

        $this->assertTrue($beatmapset->fresh()->isPending());
        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
    }

    public function testQualify()
    {
        $beatmapset = $this->beatmapsetFactory()->withBeatmaps()->create();
        $user = User::factory()->withGroup('bng', $beatmapset->playmodesStr())->create();
        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $this->expectCountChange(fn () => $beatmapset->bssProcessQueues()->count(), 1);
        $this->assertNotificationChanges();

        $beatmapset->fresh()->qualify($user);

        $this->assertTrue($beatmapset->fresh()->isQualified());

        Bus::assertDispatched(CheckBeatmapsetCovers::class);
    }

    public function testNominateWithDefaultMetadata()
    {
        $beatmapset = $this->beatmapsetFactory()->withBeatmaps()->state([
            'genre_id' => Genre::UNSPECIFIED,
            'language_id' => Language::UNSPECIFIED,
        ])->create();
        $nominator = User::factory()->withGroup('bng', $beatmapset->playmodesStr())->create();

        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage(osu_trans('authorization.beatmap_discussion.nominate.set_metadata'));
        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();
    }

    /**
     * @dataProvider qualifyingNominationsDataProvider
     */
    public function testQualifyingNominations(string $initialGroup, string $qualifyingGroup, bool $success)
    {
        $ruleset = array_rand(Beatmap::MODES);
        $beatmapset = $this->beatmapsetFactory()->withBeatmaps($ruleset)->create();
        $this->fillNominationsExceptLastForMainRuleset($beatmapset, $initialGroup);

        $nominator = User::factory()->withGroup($qualifyingGroup, [$ruleset])->create();

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();

        $this->expectCountChange(fn () => $beatmapset->bssProcessQueues()->count(), $success ? 1 : 0);

        $this->expectExceptionCallable(
            fn () => $beatmapset->fresh()->nominate($nominator, [$ruleset]),
            $success ? null : InvariantException::class
        );

        $this->assertSame($success, $beatmapset->fresh()->isQualified());

        if ($success) {
            Bus::assertDispatched(CheckBeatmapsetCovers::class);
        } else {
            Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
        }
    }

    /**
     * @dataProvider dataProviderForTestRank
     */
    public function testRank(string $state, bool $success): void
    {
        $beatmapset = $this->beatmapsetFactory()->withBeatmaps()->$state()->create();
        $otherUser = User::factory()->create();
        $beatmap = $beatmapset->beatmaps()->first();
        $beatmap->scoresBest()->create([
            'user_id' => $otherUser->getKey(),
        ]);

        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $this->expectCountChange(fn () => $beatmapset->bssProcessQueues()->count(), $success ? 1 : 0);
        $this->expectCountChange(fn () => $beatmap->scoresBest()->count(), $success ? -1 : 0);
        $this->assertNotificationChanges($success);

        $res = $beatmapset->rank();

        $this->assertSame($success, $res);
        $this->assertSame($success, $beatmapset->fresh()->isRanked());

        if ($success) {
            Bus::assertDispatched(CheckBeatmapsetCovers::class);
        } else {
            Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
        }
    }

    /**
     * @dataProvider rankWithOpenIssueDataProvider
     */
    public function testRankWithOpenIssue(string $type): void
    {
        $beatmapset = $this->beatmapsetFactory()->withBeatmaps()
            ->qualified()
            ->has(BeatmapDiscussion::factory()->general()->messageType($type))->create();

        $this->expectCountChange(fn () => $beatmapset->bssProcessQueues()->count(), 0);
        $this->assertNotificationChanges(false);

        $this->assertFalse($beatmapset->rank());
        $this->assertFalse($beatmapset->fresh()->isRanked());

        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
    }

    public function testGlobalScopeActive()
    {
        $beatmapset = Beatmapset::factory()->inactive()->create();
        $id = $beatmapset->getKey();

        $this->assertNull(Beatmapset::find($id)); // global scope
        $this->assertNull(Beatmapset::withoutGlobalScopes()->active()->find($id)); // scope still applies after removing global scope
        $this->assertTrue($beatmapset->is(Beatmapset::withoutGlobalScopes()->find($id))); // no global scopes
    }

    public function testGlobalScopeSoftDelete()
    {
        $beatmapset = Beatmapset::factory()->inactive()->deleted()->create();
        $id = $beatmapset->getKey();

        $this->assertNull(Beatmapset::withTrashed()->find($id));
    }
    //endregion

    //region multi-playmode beatmap sets (aka hybrid)
    public function testHybridLegacyNominate(): void
    {
        $user = User::factory()->withGroup('bng', ['osu'])->create();
        $beatmapset = $this->createHybridBeatmapset('taiko');

        // create legacy nomination event to enable legacy nomination mode
        BeatmapsetNomination::factory()->create([
            'beatmapset_id' => $beatmapset,
            'user_id' => User::factory()->withGroup('bng', $beatmapset->playmodesStr()),
        ]);

        $beatmapset->refreshCache();

        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $this->assertNotificationChanges(false);
        $this->assertNominationChanges($beatmapset, false);
        $this->expectException(UnsupportedNominationException::class);

        $beatmapset->fresh()->nominate($user);
    }

    public function testHybridLegacyQualify(): void
    {
        $beatmapset = $this->createHybridBeatmapset('taiko');

        // create legacy nomination event to enable legacy nomination mode
        BeatmapsetNomination::factory()->create([
            'beatmapset_id' => $beatmapset,
            'user_id' => User::factory()->withGroup('bng', $beatmapset->playmodesStr()),
        ]);

        $beatmapset->refreshCache();

        $this->expectException(UnsupportedNominationException::class);
        // fill with legacy nominations
        $count = $GLOBALS['cfg']['osu']['beatmapset']['required_nominations'] * $beatmapset->playmodeCount() - $beatmapset->currentNominationCount() - 1;
        for ($i = 0; $i < $count; $i++) {
            $beatmapset->fresh()->nominate(User::factory()->withGroup('bng', ['osu'])->create());
        }
    }

    public function testHybridNominateFullNominationRequired(): void
    {
        $user = User::factory()->withGroup('bng_limited', ['osu', 'taiko'])->create();
        $beatmapset = $this->createHybridBeatmapset('taiko');

        $this->assertNominationChanges($beatmapset, false);

        $this->expectExceptionCallable(
            fn () => $beatmapset->fresh()->nominate($user, ['osu']),
            InvariantException::class,
            osu_trans('beatmapsets.nominate.full_nomination_required')
        );
    }

    public function testHybridNominateWithBngLimitedMultipleRulesets(): void
    {
        $user = User::factory()->withGroup('bng_limited', ['osu', 'taiko'])->create();
        $beatmapset = $this->createHybridBeatmapset();
        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $this->assertNotificationChanges(false);
        $this->assertNominationChanges($beatmapset, false);

        $this->expectExceptionCallable(
            fn () => $beatmapset->fresh()->nominate($user, ['osu', 'taiko']),
            InvariantException::class,
            osu_trans('beatmapsets.nominate.bng_limited_too_many_rulesets')
        );

        $this->assertTrue($beatmapset->fresh()->isPending());
        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
    }

    public function testHybridNominateWithNullPlaymode(): void
    {
        $user = User::factory()->withGroup('bng', ['osu'])->create();
        $beatmapset = $this->createHybridBeatmapset('taiko');
        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $this->assertNotificationChanges(false);
        $this->assertNominationChanges($beatmapset, false);

        $this->expectExceptionCallable(
            fn () => $beatmapset->fresh()->nominate($user, []),
            InvariantException::class,
            osu_trans('beatmapsets.nominate.hybrid_requires_modes')
        );

        $this->assertTrue($beatmapset->fresh()->isPending());
        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
    }

    public function testHybridNominateWithNoPlaymodePermission(): void
    {
        $user = User::factory()->withGroup('bng', ['osu'])->create();
        $beatmapset = $this->createHybridBeatmapset('taiko');
        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $this->assertNotificationChanges(false);
        $this->assertNominationChanges($beatmapset, false);

        $this->expectExceptionCallable(
            fn () => $beatmapset->fresh()->nominate($user, ['taiko']),
            InvariantException::class,
            osu_trans('beatmapsets.nominate.incorrect_mode', ['mode' => 'taiko'])
        );

        $this->assertTrue($beatmapset->fresh()->isPending());
        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
    }

    public function testHybridNominateWithPlaymodePermissionSingleMode(): void
    {
        $user = User::factory()->withGroup('bng', ['osu'])->create();
        $beatmapset = $this->createHybridBeatmapset('taiko');
        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $this->assertNotificationChanges();
        $this->assertNominationChanges($beatmapset);

        $beatmapset->fresh()->nominate($user, ['osu']);

        $this->assertTrue($beatmapset->fresh()->isPending());
        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
    }

    public function testHybridNominateWithPlaymodePermissionTooMany(): void
    {
        $user = User::factory()->withGroup('bng', ['osu'])->create();
        $beatmapset = $this->createHybridBeatmapset('taiko');

        $this->fillNominationsExceptLastForMainRuleset($beatmapset, 'bng');

        $beatmapset->fresh()->nominate(
            User::factory()->withGroup('bng', ['osu'])->create(),
            ['osu']
        );

        $this->assertNotificationChanges(false);
        $this->assertNominationChanges($beatmapset, false);

        $this->expectExceptionCallable(
            fn () => $beatmapset->fresh()->nominate($user, ['osu']),
            InvariantException::class,
            osu_trans('beatmapsets.nominate.too_many_non_main_ruleset')
        );

        $this->assertTrue($beatmapset->fresh()->isPending());
        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
    }

    public function testHybridNominateWithPlaymodePermissionMultipleModes(): void
    {
        $user = User::factory()->withGroup('bng', ['osu', 'taiko'])->create();
        $beatmapset = $this->createHybridBeatmapset('taiko');
        $otherUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $otherUser->getKey()]);

        $this->assertNotificationChanges();
        $this->assertNominationChanges($beatmapset, ['osu', 'taiko']);

        $beatmapset->fresh()->nominate($user, ['osu', 'taiko']);

        $this->assertTrue($beatmapset->fresh()->isPending());
        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
    }

    public function testQualifyingNominationBngLimited()
    {
        $beatmapset = $this->createHybridBeatmapset();
        $beatmapset->fresh()->nominate(User::factory()->withGroup('bng', ['osu', 'taiko'])->create(), ['osu', 'taiko']);
        $nominator = User::factory()->withGroup('bng_limited', ['osu', 'taiko'])->create();

        $this->expectCountChange(fn () => $beatmapset->bssProcessQueues()->count(), 1);

        $beatmapset->fresh()->nominate($nominator, ['taiko']);

        $this->assertTrue($beatmapset->fresh()->isQualified());
        Bus::assertDispatched(CheckBeatmapsetCovers::class);
    }

    /**
     * @dataProvider qualifyingNominationsHybridDataProvider
     */
    public function testQualifyingNominationsHybrid(string $initialGroup, string $qualifyingGroup, bool $success)
    {
        $nominator = User::factory()->withGroup($qualifyingGroup, ['osu', 'taiko'])->create();
        $beatmapset = $this->createHybridBeatmapset('taiko');

        $this->fillNominationsExceptLastForMainRuleset($beatmapset, $initialGroup);

        priv_check_user($nominator, 'BeatmapsetNominate', $beatmapset)->ensureCan();

        $this->expectCountChange(fn () => $beatmapset->bssProcessQueues()->count(), $success ? 1 : 0);

        $this->expectExceptionCallable(
            fn () => $beatmapset->fresh()->nominate($nominator, ['osu', 'taiko']),
            $success ? null : InvariantException::class
        );

        $this->assertSame($success, $beatmapset->fresh()->isQualified());

        if ($success) {
            Bus::assertDispatched(CheckBeatmapsetCovers::class);
        } else {
            Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
        }
    }

    public function testQualifyingNominationSteps()
    {
        $bngFactory = User::factory()->withGroup('bng', ['taiko', 'fruits']);
        $bngLimitedFactory = User::factory()->withGroup('bng_limited', ['taiko', 'fruits']);
        $beatmapset = $this->createHybridBeatmapset(null, ['taiko', 'fruits']);

        $beatmapset->fresh()->nominate($bngFactory->create(), ['fruits']);
        $beatmapset->fresh()->nominate($bngLimitedFactory->create(), ['fruits']);

        $this->assertTrue($beatmapset->fresh()->isPending());

        $beatmapset->fresh()->nominate($bngFactory->create(), ['taiko']);

        $this->assertTrue($beatmapset->fresh()->isQualified());
    }

    //endregion

    //region disqualification

    /**
     * @dataProvider disqualifyOrResetNominationsDataProvider
     */
    public function testDisqualifyOrResetNominations(string $state, string $pushed)
    {
        $user = User::factory()->withGroup('bng')->create();
        $beatmapset = Beatmapset::factory()->owner()->withDiscussion()->$state()->create();
        $discussion = $beatmapset->beatmapDiscussions()->first(); // contents only needed for logging.

        Queue::fake();

        $beatmapset->disqualifyOrResetNominations($user, $discussion);

        Queue::assertPushed($pushed);
    }

    //endregion

    public function testChangingOwnerDoesNotQualify()
    {
        $guest = User::factory()->create();
        $bngUser1 = User::factory()->withGroup('bng', ['osu', 'taiko'])->create();
        $bngUser2 = User::factory()->withGroup('bng', ['osu', 'taiko'])->create();
        $bngLimitedUser = User::factory()->withGroup('bng_limited', ['osu', 'taiko'])->create();
        $natUser = User::factory()->withGroup('nat')->create();

        // make taiko tha main ruleset
        $beatmapset = $this->beatmapsetFactory()
            ->withBeatmaps('taiko', 1)
            ->withBeatmaps('taiko', 1)
            ->withBeatmaps('osu', 1)
            ->withBeatmaps('osu', 1, $guest)
            ->create();

        $this->assertSame('taiko', $beatmapset->mainRuleset());

        // valid nomination for taiko and osu
        $beatmapset->fresh()->nominate($bngLimitedUser, ['taiko']);
        $beatmapset->fresh()->nominate($bngUser1, ['osu']);

        // main ruleset should now be osu
        (new ChangeBeatmapOwners(
            $beatmapset->beatmaps()->where('playmode', 1)->first(),
            [$guest->getKey()],
            $natUser)
        )->handle();

        (new ChangeBeatmapOwners(
            $beatmapset->beatmaps()->where('playmode', 0)->last(),
            [$beatmapset->user_id],
            $natUser)
        )->handle();

        $beatmapset->refresh();

        $this->assertSame('osu', $beatmapset->mainRuleset());

        // nomination should not trigger qualification
        $this->expectExceptionCallable(
            fn () => $beatmapset->fresh()->nominate($bngUser2, ['osu']),
            InvariantException::class,
            osu_trans('beatmapsets.nominate.invalid_limited_nomination')
        );

        $this->assertFalse($beatmapset->fresh()->isQualified());
        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Genre::factory()->create(['genre_id' => Genre::UNSPECIFIED]);
        Language::factory()->create(['language_id' => Language::UNSPECIFIED]);

        Bus::fake([CheckBeatmapsetCovers::class]);
    }

    private function beatmapsetFactory(): BeatmapsetFactory
    {
        return Beatmapset::factory()->owner()->pending();
    }

    private function createHybridBeatmapset(string $mainRuleset = null, array $rulesets = ['osu', 'taiko']): Beatmapset
    {
        $factory = $this->beatmapsetFactory();

        foreach ($rulesets as $ruleset) {
            $factory = $factory->withBeatmaps($ruleset, $mainRuleset === $ruleset ? 2 : 1);
        }

        return $factory->create();
    }

    private function fillNominationsExceptLastForMainRuleset(Beatmapset $beatmapset, string $group): void
    {
        $ruleset = $beatmapset->mainRuleset();
        if ($ruleset === null) {
            throw new \Exception('Cannot fill nominations without main ruleset.');
        }

        $count = NominateBeatmapset::requiredNominationsConfig()['main_ruleset'] - 1;
        for ($i = 0; $i < $count; $i++) {
            $beatmapset->nominate(User::factory()->withGroup($group, [$ruleset])->create(), [$ruleset]);
        }
    }

    private function assertNominationChanges(Beatmapset $beatmapset, bool|array $success = true)
    {
        $count = is_array($success)
            ? count($success)
            : ($success ? 1 : 0);

        $this->expectCountChange(fn () => $beatmapset->fresh()->nominations, $count, 'nominations');
        $this->expectCountChange(fn () => $beatmapset->fresh()->beatmapsetNominations()->current()->count(), $success ? 1 : 0, 'nominations count');
    }

    private function assertNotificationChanges(bool $success = true)
    {
        $this->expectCountChange(fn () => Notification::count(), $success ? 1 : 0, 'Notification count');
        $this->expectCountChange(fn () => UserNotification::count(), $success ? 1 : 0, 'UserNotification count');
    }
}
