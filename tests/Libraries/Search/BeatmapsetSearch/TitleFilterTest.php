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
            [['q' => 'best'], [0, 4, 1, 3, 2], true],
            [['q' => 'best beatmap'], [1, 3, 2, 0, 4], true],
            [['q' => '"best beatmap"'], [1, 3, 2], true],
            [['q' => '-best'], []],
            [['q' => '-best -beatmap'], []],
            [['q' => '-"best beatmap"'], [4, 0], true],

            [['q' => 'title=best'], [0, 1, 3, 2], true],
            [['q' => 'title="best beatmap"'], [1, 3, 2], true],
            [['q' => 'title="the beatmap"'], [2, 3], true],
            [['q' => 'title=""best beatmap""'], [1, 3, 2], true],
            [['q' => 'title=""the beatmap""'], []],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->consistent()->ranked()->withBeatmaps();
            static::$beatmapsets = [
                $factory->create(['title' => 'best']),
                $factory->create(['title' => 'best beatmap']),
                $factory->create(['title' => 'the best beatmap']),
                $factory->create(['title' => 'the best beatmap', 'title_unicode' => 'ダ best beatmap']), // scores slightly better in prefix matching.
                // this will score better in the 'best' test due to the term having lower frequency in the artist field.
                $factory->create(['artist' => 'the best artist']),
            ];
        });

        parent::setUpBeforeClass();
    }
}
