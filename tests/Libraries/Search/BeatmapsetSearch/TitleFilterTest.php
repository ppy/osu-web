<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmapset;

class TitleFilterTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [['q' => 'best'], [0, 1, 2, 3, 4]],
            [['q' => 'best beatmap'], [3, 2, 1, 0, 4], true],
            [['q' => '"best beatmap"'], [3, 2, 1], true],
            [['q' => '-best'], []],
            [['q' => '-best -beatmap'], []],
            [['q' => '-"best beatmap"'], [0, 4]],

            [['q' => 'title=best'], [0, 1, 2, 3]],
            [['q' => 'title="best beatmap"'], [1, 2, 3]],
            [['q' => 'title="the beatmap"'], [1, 2], true],
            [['q' => 'title=""best beatmap""'], [3, 2, 1], true],
            [['q' => 'title=""the beatmap""'], []],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->consistent()->ranked()->withBeatmaps();
            static::$beatmapsets = [
                $factory->create(['title' => 'best']),
                $factory->create(['title' => 'the best beatmap']),
                $factory->create(['title' => 'the best beatmap', 'title_unicode' => 'ダ best beatmap']), // scores slightly better in prefix matching.
                $factory->create(['title' => 'best beatmap']),
                $factory->create(['artist' => 'the best artist']),
            ];
        });

        parent::setUpBeforeClass();
    }
}
