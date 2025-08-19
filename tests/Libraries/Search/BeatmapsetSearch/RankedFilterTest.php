<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmapset;
use DateTime;
use DateTimeInterface;

class RankedFilterTest extends TestCase
{
    public static function dataProvider(): array
    {
        // Includes created and updated date tests.
        static $keys = ['created', 'ranked', 'updated'];

        $data = [];
        foreach ($keys as $key) {
            // BeatmapsetQueryParserTest will handle the other date formats
            $data[] = [['q' => "{$key}=2024"], [2, 3, 4]];
            $data[] = [['q' => "{$key}=2024-02"], [2, 3]];
            $data[] = [['q' => "{$key}=2024-02-28"], [3]];
            $data[] = [['q' => "{$key}=2024"], [2, 3, 4]];
            $data[] = [['q' => "{$key}>2023"], [2, 3, 4]];
            $data[] = [['q' => "{$key}>=2023"], [1, 2, 3, 4]];
            $data[] = [['q' => "{$key}<2023"], [0]];
            $data[] = [['q' => "{$key}<=2023"], [0, 1]];
        }

        return $data;
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->withBeatmaps();
            $helper = fn (DateTimeInterface $date) => $factory->ranked($date)->state([
                'last_update' => $date,
                'submit_date' => $date,
            ]);
            static::$beatmapsets = [
                $helper(new DateTime('2022-02-25'))->state(['approved' => Beatmapset::STATES['approved']])->create(),
                $helper(new DateTime('2023-02-26'))->state(['approved' => Beatmapset::STATES['loved']])->create(),
                $helper(new DateTime('2024-02-27'))->create(),
                $helper(new DateTime('2024-02-28'))->create(),
                $helper(new DateTime('2024-03-05'))->create(),
            ];
        });

        parent::setUpBeforeClass();
    }
}
