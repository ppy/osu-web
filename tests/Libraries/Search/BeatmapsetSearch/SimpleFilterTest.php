<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use Illuminate\Database\Eloquent\Factories\Sequence;

class SimpleFilterTest extends TestCase
{
    // Date tests in DateFilterTest
    private const KEYS = [
        'ar' => 'diff_approach',
        'bpm' => 'bpm',
        'circles' => 'countNormal',
        'cs' => 'diff_size',
        'hp' => 'diff_drain',
        'length' => 'total_length',
        'od' => 'diff_overall',
        'sliders' => 'countSlider',
        'stars' => 'difficultyrating',
    ];

    public static function dataProvider(): array
    {
        $data = [];
        foreach (array_keys(static::KEYS) as $offset => $key) {
            $value = $offset + 2;
            $data[] = [['q' => "{$key}={$value}"], [0, 1]];
            $data[] = [['q' => "{$key}>{$value}"], [1, 2]];
            $data[] = [['q' => "{$key}>={$value}"], [0, 1, 2]];
            $data[] = [['q' => "{$key}<{$value}"], [0]];
            $data[] = [['q' => "{$key}<={$value}"], [0, 1]];
        }

        $data[] = [['q' => 'od>9 ar<3'], []];

        $data[] = [['q' => 'favourites=150'], []]; // if you really want an exact number of favourites...
        $data[] = [['q' => 'favourites>200'], [2]];
        $data[] = [['q' => 'favourites>=200'], [1, 2]];
        $data[] = [['q' => 'favourites<200'], [0]];
        $data[] = [['q' => 'favourites<=200'], [0, 1]];

        $data[] = [['q' => 'od>7'], [0, 1, 2]];
        $data[] = [['q' => 'od>7 favourites>123'], [1, 2]];

        // no matches because there is no beatmap that matches both conditions
        // even though the beatmapset has both in different beatmaps.
        $data[] = [['q' => 'od>=9 ar<3'], []];

        return $data;
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->ranked();
            $beatmapFactory = Beatmap::factory()->ranked()->ruleset('osu');
            $baseValues = array_flip(array_values(static::KEYS));
            $offsetValues = fn (int $offset): array => array_map(fn (int $value): int => $value + $offset, $baseValues);

            static::$beatmapsets = [
                $factory
                    ->has($beatmapFactory
                        ->count(2)
                        ->state(new Sequence(fn (Sequence $sequence): array => $offsetValues($sequence->index + 1))))
                    ->create(['favourite_count' => 100]),
                // this beatmapset has beatmaps with values overlapping the first.
                $factory
                    ->has($beatmapFactory
                        ->count(2)
                        ->state(new Sequence(fn (Sequence $sequence): array => $offsetValues($sequence->index + 2))))
                    ->create(['favourite_count' => 200]),
                $factory
                    ->has($beatmapFactory->state($offsetValues(4)))
                    ->create(['favourite_count' => 300]),
            ];
        });

        parent::setUpBeforeClass();
    }
}
