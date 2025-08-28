<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmapset;

class NegativeBoostTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [['q' => 'apple'], [2, 1, 0], true],
            [['q' => 'apple -too'], [1, 2, 0], true],
            [['q' => '-too'], [3, 2, 1, 0], true], // no effect because all the scores are 0
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            // use something besides empty string so it doesn't match empty string.
            $factory = Beatmapset::factory()->consistent()->state(['artist' => 'a', 'creator' => 'a'])->ranked()->withBeatmaps();
            static::$beatmapsets = [
                $factory->create(['tags' => 'too hoos', 'title' => 'Good Apple']),
                $factory->create(['tags' => 'fruit cake', 'title' => 'Apple']),
                $factory->create(['tags' => 'too hoos', 'title' => 'Apple']),
                $factory->create(['tags' => 'hoo', 'title' => 'Orange']),
            ];
        });
        parent::setUpBeforeClass();
    }
}
