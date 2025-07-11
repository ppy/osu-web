<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Jobs;

use App\Jobs\RemoveBeatmapsetSoloScores;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Solo\Score;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class RemoveBeatmapsetSoloScoresDbTest extends TestCase
{
    public static function dataProviderForTestHandleUserStatsCountConvertedMania(): array
    {
        return [[4], [6], [7]];
    }

    #[DataProvider('dataProviderForTestHandleUserStatsCountConvertedMania')]
    public function testHandleUserStatsCountConvertedMania(int $keys): void
    {
        $beatmapset = Beatmapset::factory()->ranked()->create();
        $beatmap = Beatmap::factory()->ranked()->convertsToManiaKeys($keys)->create([
            'beatmapset_id' => $beatmapset,
        ]);
        $user = User::factory()->create();
        $score = Score::factory()->create([
            'beatmap_id' => $beatmap->getKey(),
            'user_id' => $user->getKey(),
            'ruleset_id' => Beatmap::MODES['mania'],
            'rank' => 'A',
        ]);
        $column = 'a_rank_count';
        $user->statisticsMania()->create([$column => 1]);
        $user->statisticsMania4k()->create([$column => 1]);
        $user->statisticsMania7k()->create([$column => 1]);

        $this->expectCountChange(fn () => $user->statisticsMania->fresh()->$column, -1);
        $this->expectCountChange(fn () => $user->statisticsMania4k->fresh()->$column, $keys === 4 ? -1 : 0);
        $this->expectCountChange(fn () => $user->statisticsMania7k->fresh()->$column, $keys === 7 ? -1 : 0);

        new RemoveBeatmapsetSoloScores($beatmapset, true)->handle();
    }
}
