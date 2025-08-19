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
    public static function dataProvider(): array
    {
        // Date tests in RankedFilterTest
        static $keys = ['ar', 'bpm', 'circles', 'cs', 'hp', 'length', 'od', 'sliders', 'stars'];

        $data = [];
        foreach ($keys as $key) {
            $data[] = [['q' => "{$key}=2"], [0, 1]];
            $data[] = [['q' => "{$key}>2"], [1, 2]];
            $data[] = [['q' => "{$key}>=2"], [0, 1, 2]];
            $data[] = [['q' => "{$key}<2"], [0]];
            $data[] = [['q' => "{$key}<=2"], [0, 1]];
            $data[] = [['q' => "{$key}>2 {$key}=1"], [0]]; // same key overrides
        }

        $data[] = [['q' => 'od>3 ar<3'], []];

        $data[] = [['q' => 'favourites=150'], []]; // if you really want an exact number of favourites...
        $data[] = [['q' => 'favourites>200'], [2]];
        $data[] = [['q' => 'favourites>=200'], [1, 2]];
        $data[] = [['q' => 'favourites<200'], [0]];
        $data[] = [['q' => 'favourites<=200'], [0, 1]];

        $data[] = [['q' => 'od>1'], [0, 1, 2]];
        $data[] = [['q' => 'od>1 favourites>123'], [1, 2]];

        // no matches because there is no beatmap that matches both conditions
        // even though the beatmapset has both in different beatmaps.
        $data[] = [['q' => 'od>=3 ar<3'], []];

        return $data;
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->ranked();
            $beatmapFactory = Beatmap::factory()->ranked()->ruleset('osu');
            static::$beatmapsets = [
                $factory
                    ->has($beatmapFactory
                        ->count(2)
                        ->state(new Sequence(fn (Sequence $sequence): array => [
                            'total_length' => 1 + $sequence->index,
                            'hit_length' => 1 + $sequence->index,
                            'countNormal' => 1 + $sequence->index,
                            'countSlider' => 1 + $sequence->index,
                            'bpm' => 1 + $sequence->index,
                            'diff_approach' => 1 + $sequence->index,
                            'diff_drain' => 1 + $sequence->index,
                            'diff_overall' => 1 + $sequence->index,
                            'diff_size' => 1 + $sequence->index,
                            'difficultyrating' => 1 + $sequence->index,
                        ])))
                    ->create(['favourite_count' => 100]),
                // this beatmapset has beatmaps with values overlapping the first.
                $factory
                    ->has($beatmapFactory
                        ->count(2)
                        ->state(new Sequence(fn (Sequence $sequence): array => [
                            'total_length' => 2 + $sequence->index,
                            'hit_length' => 2 + $sequence->index,
                            'countNormal' => 2 + $sequence->index,
                            'countSlider' => 2 + $sequence->index,
                            'bpm' => 2 + $sequence->index,
                            'diff_approach' => 2 + $sequence->index,
                            'diff_drain' => 2 + $sequence->index,
                            'diff_overall' => 2 + $sequence->index,
                            'diff_size' => 2 + $sequence->index,
                            'difficultyrating' => 2 + $sequence->index,
                        ])))
                    ->create(['favourite_count' => 200]),
                $factory
                    ->has($beatmapFactory
                        ->state([
                            'total_length' => 4,
                            'hit_length' => 4,
                            'countNormal' => 4,
                            'countSlider' => 4,
                            'bpm' => 4,
                            'diff_approach' => 4,
                            'diff_drain' => 4,
                            'diff_overall' => 4,
                            'diff_size' => 4,
                            'difficultyrating' => 4,
                        ]))
                    ->create(['favourite_count' => 300]),
            ];
        });

        parent::setUpBeforeClass();
    }
}
