<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmapset;

class StatusRangeFilterTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            // default behaviour
            [['q' => 'status=graveyard'], []],
            [['q' => 'status=wip'], []],
            [['q' => 'status=pending'], []],
            [['q' => 'status=ranked'], [3]],
            [['q' => 'status=approved'], [4]],
            [['q' => 'status=qualified'], []],
            [['q' => 'status=loved'], [6]],

            [['s' => 'any', 'q' => 'status=graveyard'], [0]],
            [['s' => 'any', 'q' => 'status=wip'], [1]],
            [['s' => 'any', 'q' => 'status=pending'], [2]],
            [['s' => 'any', 'q' => 'status=ranked'], [3]],
            [['s' => 'any', 'q' => 'status=approved'], [4]],
            [['s' => 'any', 'q' => 'status=qualified'], [5]],
            [['s' => 'any', 'q' => 'status=loved'], [6]],

            // weird, but still...
            [['q' => 'status>ranked'], [6, 4]],
            [['s' => 'qualified', 'q' => 'status>ranked'], [5], ['queued_at', 'approved_date', 'id']],
            [['s' => 'ranked', 'q' => 'status>ranked'], [4]],

            [['s' => 'ranked', 'q' => '-status=approved'], [3]],
            [['q' => '-status>ranked'], [3]],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            static::$beatmapsets = [];
            $factory = Beatmapset::factory()->withBeatmaps();
            foreach (Beatmapset::STATES as $_state => $value) {
                static::$beatmapsets[] = $factory->state(['approved' => $value])->create();
            }
        });

        parent::setUpBeforeClass();
    }
}
