<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmap;
use App\Models\Beatmapset;

class ConvertsFilterTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [['q' => 'cs=4'], [1, 2]],
            [['m' => 0, 'q' => 'cs=4'], [1]],
            [['m' => 3, 'q' => 'cs=4'], [2]],
            [['q' => '-cs=4'], [0, 3]],
            [['m' => 0, 'q' => '-cs=4'], [0]],
            [['m' => 3, 'q' => '-cs=4'], [3]],

            [['c' => 'converts', 'q' => 'cs=4',], [0, 1, 2]],
            [['c' => 'converts', 'q' => '-cs=4',], [3]],
            [['c' => 'converts', 'm' => 0, 'q' => 'cs=4',], [1]],
            [['c' => 'converts', 'm' => 3, 'q' => 'cs=4'], [0, 2]],
            [['c' => 'converts', 'm' => 0, 'q' => '-cs=4'], [0]],
            [['c' => 'converts', 'm' => 3, 'q' => '-cs=4'], [1, 3]],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->ranked();
            $beatmapFactory = Beatmap::factory()->ranked();
            static::$beatmapsets = [
                $factory
                    ->has($beatmapFactory
                        ->ruleset('osu')
                        ->state([
                            // converted to mania diff_size 4
                            'countNormal' => 1,
                            'countSlider' => 1,
                            'countSpinner' => 1,
                            'diff_size' => 1,
                            'diff_overall' => 1,
                        ]))
                    ->create(),

                $factory
                    ->has($beatmapFactory
                        ->ruleset('osu')
                        ->state([
                            // converted to mania diff_size 7
                            'countNormal' => 100,
                            'countSlider' => 1,
                            'countSpinner' => 1,
                            'diff_size' => 4,
                            'diff_overall' => 4,
                        ]))
                    ->create(),

                $factory
                    ->has($beatmapFactory
                        ->ruleset('mania')
                        ->state([
                            'countNormal' => 1,
                            'countSlider' => 1,
                            'countSpinner' => 1,
                            'diff_size' => 4,
                            'diff_overall' => 1,
                        ]))
                    ->create(),

                $factory
                    ->has($beatmapFactory
                        ->ruleset('mania')
                        ->state([
                            'countNormal' => 100,
                            'countSlider' => 1,
                            'countSpinner' => 1,
                            'diff_size' => 7,
                            'diff_overall' => 1,
                        ]))
                    ->create(),
            ];
        });

        parent::setUpBeforeClass();
    }
}
