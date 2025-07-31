<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmapset;
use App\Models\User;

class CreatorFilterTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            'include lookup user' => [['q' => 'creator=mapper'], [0, 1]],
            'include non-lookup user' => [['q' => 'creator=someone'], [0, 3]],
            'exclude lookup user' => [['q' => '-creator=mapper'], [2, 3, 4]],
            'exclude non-lookup user' => [['q' => '-creator=someone'], [1, 2, 4]],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->withBeatmaps()->ranked();
            $mapper1 = User::factory()->create(['username' => 'mapper']);
            $mapper2 = User::factory()->create(['username' => 'another_mapper']);

            static::$beatmapsets = [
                $factory->withBeatmaps(guestMapper: $mapper1)->create(['creator' => 'someone']),
                $factory->create(['user_id' => $mapper1]),
                $factory->create(['user_id' => $mapper2]),
                $factory->create(['creator' => 'someone_else']),
                $factory->create(['creator' => 'unknown_mapper']),
            ];
        });

        parent::setUpBeforeClass();
    }
}
