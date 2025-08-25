<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmap;
use App\Models\Beatmapset;

class DifficultyFilterTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [['q' => 'hard'], [], ['_score', 'id']],

            [['q' => 'difficulty=hard'], [2, 1]],
            [['q' => 'difficulty="very mapper"'], [2]],
            [['q' => 'difficulty="very hard"'], []],
            [['q' => 'difficulty=""very easy""'], [0]],

            [['q' => '-difficulty=hard'], [0]],
            [['q' => '-difficulty="very mapper"'], [1]],
            [['q' => '-difficulty="very hard"'], []],
            [['q' => '-difficulty=""very easy""'], [2, 1]],
            [['q' => '-difficulty="hard easy"'], []],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->ranked();
            $beatmapFactory = Beatmap::factory()
                ->state(fn (array $attr, Beatmapset $set) => [
                    'approved' => $set->approved,
                    'user_id' => $set->user_id,
                ]);

            static::$beatmapsets = [
                $factory
                    ->has($beatmapFactory->state(['version' => 'very easy']))
                    ->has($beatmapFactory->state(['version' => 'normal']))
                    ->create(),
                $factory
                    ->has($beatmapFactory->state(['version' => 'normal']))
                    ->has($beatmapFactory->state(['version' => 'hard']))
                    ->create(),
                $factory
                    ->has($beatmapFactory->state(['version' => 'mapper name very nice']))
                    ->has($beatmapFactory->state(['version' => 'hard']))
                    ->create(),
            ];
        });

        parent::setUpBeforeClass();
    }
}
