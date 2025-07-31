<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmapset;
use App\Models\User;

class CreatorFilterTest extends TestCase
{
    protected array $defaultExpectedSort = ['_score', 'id'];

    public static function dataProvider(): array
    {
        return [
            'include lookup user' => [['q' => 'creator=mapper'], [1, 0]],
            'include non-lookup user' => [['q' => 'creator=someone'], [0, 3]],
            'exclude lookup user' => [['q' => '-creator=mapper'], [4, 3, 2], ['approved_date', 'id']],
            'exclude non-lookup user' => [['q' => '-creator=someone'], [4, 2, 1], ['approved_date', 'id']],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->fixedStrings()->withBeatmaps(beatmapState: ['version' => 'test'])->ranked();
            $mapper1 = User::factory()->create(['username' => 'mapper']);
            $mapper2 = User::factory()->create(['username' => 'another_mapper']);

            static::$beatmapsets = [
                $factory->withBeatmaps(guestMapper: $mapper1, beatmapState: ['version' => 'test2'])->create(['creator' => 'someone']),
                $factory->create(['user_id' => $mapper1]),
                $factory->create(['user_id' => $mapper2]),
                $factory->create(['creator' => 'someone_else']),
                $factory->create(['creator' => 'unknown_mapper']),
            ];
        });

        parent::setUpBeforeClass();
    }
}
