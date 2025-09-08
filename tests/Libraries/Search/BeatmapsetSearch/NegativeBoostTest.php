<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Libraries\Search\BeatmapsetSearch;
use App\Libraries\Search\BeatmapsetSearchRequestParams;
use App\Models\Beatmapset;
use PHPUnit\Framework\Attributes\DataProvider;

class NegativeBoostTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [['q' => 'apple'], [2, 1, 0]],
            [['q' => 'apple -too'], [1, 2, 0]],
            [['q' => '-too'], [3, 2, 1, 0]], // no effect because all the scores are 0
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            // use something besides empty string so it doesn't match empty string.
            $factory = Beatmapset::factory()->state(['artist' => 'a', 'creator' => 'a', 'favourite_count' => 0])->ranked()->withBeatmaps();
            static::$beatmapsets = [
                $factory->create(['tags' => 'too hoos', 'title' => 'Good Apple']),
                $factory->create(['tags' => 'fruit cake', 'title' => 'Apple']),
                $factory->create(['tags' => 'too hoos', 'title' => 'Apple']),
                $factory->create(['tags' => 'hoo', 'title' => 'Orange']),
            ];
        });
        parent::setUpBeforeClass();
    }

    #[DataProvider('dataProvider')]
    public function testSearch(array $params, array $expected): void
    {
        $this->assertEquals(
            array_map(fn (int $index) => static::$beatmapsets[$index]->getKey(), $expected),
            new BeatmapsetSearch(new BeatmapsetSearchRequestParams($params))->response()->ids()
        );
    }
}
