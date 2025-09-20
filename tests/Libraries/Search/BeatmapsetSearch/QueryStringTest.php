<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmapset;

class QueryStringTest extends TestCase
{
    public static function dataProvider(): array
    {
        // TODO: support scoring order in tests.
        return [
            [['q' => ''], [0, 1, 2, 3]],
            [['q' => '2'], [1]], // id only search.
            [['q' => '2 3'], []], // putting more than one id becomes a normal string search.
            [['q' => 'triangles'], [0, 1, 3]],
            [['q' => '-triangles'], [2]],
            [['q' => 'triangles -revival'], [0, 3]],
            [['q' => 'cross circle'], [2, 3]],
            [['q' => 'cross -circle'], []], // exclusion shouldn't add new matches.
            [['q' => 'tri'], [0, 1, 3]],
            [['q' => 'tri -circ'], [0, 1, 3]],
            [['q' => 'tri -circle'], [0, 1, 3]],
            [['q' => '-tri'], [0, 1, 2, 3]],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            // use something besides empty string so it doesn't match empty string.
            $factory = Beatmapset::factory()->state(['artist' => 'a', 'creator' => 'a'])->ranked()->withBeatmaps();
            static::$beatmapsets = [
                $factory->create(['title' => 'Triangles']),
                $factory->create(['title' => 'Triangles Revival']),
                $factory->create(['title' => 'Circle overload']),
                $factory->create(['title' => 'Triangles circles squares']),
            ];
        });
        parent::setUpBeforeClass();
    }
}
