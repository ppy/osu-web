<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmapset;
use Carbon\CarbonImmutable;

// Ranked filter, and the date related parts of addSimpleFilters().
class DateFilterTest extends TestCase
{
    public static function dataProvider(): array
    {
        static $keys = ['created', 'ranked', 'updated'];

        $data = [];
        foreach ($keys as $index => $key) {
            // BeatmapsetQueryParserTest will test the other date formats are equivalent.
            $year = 2023 + $index;

            $data[] = [['q' => "{$key}={$year}"], [2, 3, 4]];
            $data[] = [['q' => "{$key}={$year}-02"], [2, 3]];
            $data[] = [['q' => "{$key}={$year}-02-28"], [3]];
            $data[] = [['q' => "{$key}={$year}"], [2, 3, 4]];

            $year = 2022 + $index;
            $data[] = [['q' => "{$key}>{$year}"], [2, 3, 4]];
            $data[] = [['q' => "{$key}>={$year}"], [1, 2, 3, 4]];
            $data[] = [['q' => "{$key}<{$year}"], [0]];
            $data[] = [['q' => "{$key}<={$year}"], [0, 1]];
        }

        return $data;
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->withBeatmaps();
            $helper = fn (CarbonImmutable $date) => $factory->ranked($date)->state([
                'last_update' => $date->addYearNoOverflow(1),
                'submit_date' => $date->addYearNoOverflow(-1),
            ]);

            static::$beatmapsets = [
                $helper(new CarbonImmutable('2022-02-25'))->state(['approved' => Beatmapset::STATES['approved']])->create(),
                $helper(new CarbonImmutable('2023-02-26'))->state(['approved' => Beatmapset::STATES['loved']])->create(),
                $helper(new CarbonImmutable('2024-02-27'))->create(),
                $helper(new CarbonImmutable('2024-02-28'))->create(),
                $helper(new CarbonImmutable('2024-03-05'))->create(),
            ];
        });

        parent::setUpBeforeClass();
    }
}
