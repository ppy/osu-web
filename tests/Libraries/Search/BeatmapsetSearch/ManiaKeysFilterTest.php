<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmap;
use App\Models\Beatmapset;

class ManiaKeysFilterTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [['q' => 'keys=7'], [1, 3]],
            [['q' => '-keys=7'], [2]],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        static::withDbAccess(function () {
            $beatmapsetFactory = Beatmapset::factory()->ranked();
            $beatmapFactory = Beatmap::factory()->ruleset('mania')->state(['approved' => Beatmapset::STATES['ranked']]);

            static::$beatmapsets = [
                $beatmapsetFactory->withBeatmaps('osu')->create(),
                $beatmapsetFactory->has($beatmapFactory->state(['diff_size' => 7]))->create(),
                $beatmapsetFactory->has($beatmapFactory->state(['diff_size' => 4]))->create(),
                $beatmapsetFactory
                    ->has($beatmapFactory->state(['diff_size' => 4]))
                    ->has($beatmapFactory->state(['diff_size' => 7]))
                    ->create(),
            ];
            static::refresh();
        });
    }
}
