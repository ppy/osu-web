<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Commands;

use App\Console\Commands\ModdingRankCommand;
use App\Enums\Ruleset;
use App\Jobs\CheckBeatmapsetCovers;
use App\Jobs\Notifications\BeatmapsetRank;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use Bus;
use Database\Factories\BeatmapsetFactory;
use Tests\TestCase;

class ModdingRankCommandTest extends TestCase
{
    public function testCountOnly(): void
    {
        $this->beatmapset([Ruleset::osu])->create();

        $this->expectCountChange(fn () => Beatmapset::ranked()->count(), 0);

        $this->artisan('modding:rank', ['--count-only' => true]);

        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
        Bus::assertNotDispatched(BeatmapsetRank::class);
    }

    /**
     * @dataProvider rankDataProvider
     */
    public function testRank(int $qualifiedDaysAgo, int $expected): void
    {
        $this->beatmapset([Ruleset::osu], $qualifiedDaysAgo)->create();

        $this->expectCountChange(fn () => Beatmapset::ranked()->count(), $expected);

        $this->artisan('modding:rank', ['--no-wait' => true]);

        Bus::assertDispatchedTimes(CheckBeatmapsetCovers::class, $expected);
        Bus::assertDispatchedTimes(BeatmapsetRank::class, $expected);
    }

    /**
     * @dataProvider rankHybridDataProvider
     */
    public function testRankHybrid(array $beatmapsetRulesets, array $expectedCounts): void
    {
        foreach ($beatmapsetRulesets as $rulesets) {
            $this->beatmapset($rulesets)->create();
        }

        foreach (Ruleset::cases() as $ruleset) {
            $this->assertSame($expectedCounts[$ruleset->value], ModdingRankCommand::getStats($ruleset)['inQueue']);
        }
    }

    public function testRankOpenIssue(): void
    {
        $this->beatmapset([Ruleset::osu])
            ->has(BeatmapDiscussion::factory()->general()->problem())
            ->create();

        $this->expectCountChange(fn () => Beatmapset::ranked()->count(), 0);

        $this->artisan('modding:rank', ['--no-wait' => true]);

        Bus::assertNotDispatched(CheckBeatmapsetCovers::class);
        Bus::assertNotDispatched(BeatmapsetRank::class);
    }

    public function testRankQuota(): void
    {
        $this->beatmapset([Ruleset::osu])->count(3)->create();

        $this->expectCountChange(fn () => Beatmapset::qualified()->count(), -2);
        $this->expectCountChange(fn () => Beatmapset::ranked()->count(), 2);

        $this->artisan('modding:rank', ['--no-wait' => true]);

        Bus::assertDispatched(CheckBeatmapsetCovers::class);
        Bus::assertDispatched(BeatmapsetRank::class);
    }

    public function testRankQuotaSeparateRuleset(): void
    {
        foreach (Ruleset::cases() as $ruleset) {
            $this->beatmapset([$ruleset])->create();
        }

        $count = count(Ruleset::cases());
        $this->expectCountChange(fn () => Beatmapset::ranked()->count(), $count);

        $this->artisan('modding:rank', ['--no-wait' => true]);

        Bus::assertDispatchedTimes(CheckBeatmapsetCovers::class, $count);
        Bus::assertDispatchedTimes(BeatmapsetRank::class, $count);
    }


    public static function rankDataProvider()
    {
        // 1 day ago isn't used because it might or might not be equal to the cutoff depending on how fast it runs.
        return [
            [0, 0],
            [2, 1],
        ];
    }

    public static function rankHybridDataProvider()
    {
        return [
            // hybrid counts as ruleset with lowest enum value
            [[[Ruleset::osu, Ruleset::taiko, Ruleset::catch, Ruleset::mania]], [1, 0, 0, 0]],
            [[[Ruleset::taiko, Ruleset::catch, Ruleset::mania]], [0, 1, 0, 0]],
            [[[Ruleset::catch, Ruleset::mania]], [0, 0, 1, 0]],
            [[[Ruleset::mania]], [0, 0, 0, 1]],

            // not comprehensive
            [[[Ruleset::osu, Ruleset::taiko], [Ruleset::osu]], [2, 0, 0, 0]],
            [[[Ruleset::osu, Ruleset::taiko], [Ruleset::taiko]], [1, 1, 0, 0]],
            [[[Ruleset::mania, Ruleset::taiko], [Ruleset::taiko]], [0, 2, 0, 0]],
            [[[Ruleset::mania, Ruleset::taiko], [Ruleset::mania]], [0, 1, 0, 1]],
            [[[Ruleset::catch, Ruleset::taiko], [Ruleset::mania]], [0, 1, 0, 1]],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        config_set('osu.beatmapset.minimum_days_for_rank', 1);
        config_set('osu.beatmapset.rank_per_day', 2);

        Bus::fake([BeatmapsetRank::class, CheckBeatmapsetCovers::class]);
    }

    /**
     * @param Ruleset[] $rulesets
     */
    protected function beatmapset(array $rulesets, int $qualifiedDaysAgo = 2): BeatmapsetFactory
    {
        $factory = Beatmapset::factory()
            ->owner()
            ->qualified(now()->subDays($qualifiedDaysAgo));

        foreach ($rulesets as $ruleset) {
            $factory = $factory->has(Beatmap::factory()->ruleset($ruleset->legacyName()));
        }

        return $factory;
    }
}
