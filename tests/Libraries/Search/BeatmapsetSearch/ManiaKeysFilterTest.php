<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmapset;

class ManiaKeysFilterTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [['q' => 'keys=7'], [3, 1]],
            [['q' => '-keys=7'], [2]],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->ranked();

            static::$beatmapsets = [
                $factory->withBeatmaps('osu', beatmapState: ['diff_size' => 7])->create(),
                $factory->withBeatmaps('mania', beatmapState: ['diff_size' => 7])->create(),
                $factory->withBeatmaps('mania', beatmapState: ['diff_size' => 4])->create(),
                $factory
                    ->withBeatmaps('mania', beatmapState: ['diff_size' => 4])
                    ->withBeatmaps('mania', beatmapState: ['diff_size' => 7])
                    ->create(),
            ];
        });

        parent::setUpBeforeClass();
    }
}
