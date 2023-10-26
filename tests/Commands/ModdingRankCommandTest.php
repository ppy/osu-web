<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Commands;

use App\Exceptions\InvariantException;
use App\Libraries\Ruleset;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapMirror;
use App\Models\Beatmapset;
use App\Models\Solo\Score;
use Artisan;
use Carbon\Carbon;
use Database\Factories\Factory;
use LaravelRedis;
use Tests\TestCase;

class ModdingRankCommandTest extends TestCase
{
    /**
     * @dataProvider rankDataProvider
     */
    public function testRank(int $qualifiedDaysAgo, int $expected): void
    {
        $this->beatmapset(Ruleset::osu, $qualifiedDaysAgo)->create();

        $this->expectCountChange(fn () => Beatmapset::ranked()->count(), $expected);

        $this->artisan('modding:rank', ['--no-wait' => true]);
    }

    public function testRankOpenIssue(): void
    {
        $beatmapset = $this->beatmapset(Ruleset::osu)
            ->has(BeatmapDiscussion::factory()->general()->problem())
            ->create();

        $this->expectCountChange(fn () => Beatmapset::ranked()->count(), 0);

        $this->artisan('modding:rank', ['--no-wait' => true]);
    }

    public function testRankQuota(): void
    {
        $this->beatmapset(Ruleset::osu)->count(2)->create();

        $this->expectCountChange(fn () => Beatmapset::qualified()->count(), -2);
        $this->expectCountChange(fn () => Beatmapset::ranked()->count(), 2);

        $this->artisan('modding:rank', ['--no-wait' => true]);
    }

    public function testRankQuotaSeparateRuleset(): void
    {
        foreach (Ruleset::cases() as $ruleset) {
            $this->beatmapset($ruleset)->create();
        }

        $this->expectCountChange(fn () => Beatmapset::ranked()->count(), count(Ruleset::cases()));

        $this->artisan('modding:rank', ['--no-wait' => true]);
    }


    public function rankDataProvider()
    {
        // 1 day ago isn't used because it might or might not be equal to the cutoff depending on how fast it runs.
        return [
            [0, 0],
            [2, 1],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('osu.beatmapset.minimum_days_for_rank', 1);
        config()->set('osu.beatmapset.rank_per_day', 2);

        BeatmapMirror::factory()->default()->create();
    }

    /**
     * @return Factory<Beatmapset>
     */
    protected function beatmapset(Ruleset $ruleset, int $qualifiedDaysAgo = 2): Factory
    {
        return Beatmapset::factory()
            ->owner()
            ->qualified(now()->subDays($qualifiedDaysAgo))
            ->state(['download_disabled' => true])
            ->has(Beatmap::factory()->ruleset($ruleset));
    }
}
