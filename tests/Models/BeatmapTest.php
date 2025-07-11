<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Beatmap;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BeatmapTest extends TestCase
{
    public static function dataProviderForTestFactoryConvertsToManiaKeys(): array
    {
        return [[4], [6], [7]];
    }

    #[DataProvider('dataProviderForTestFactoryConvertsToManiaKeys')]
    public function testFactoryConvertsToManiaKeys(int $keys): void
    {
        $beatmap = Beatmap::factory()->convertsToManiaKeys($keys)->make();
        $beatmap->convert = true;
        $beatmap->playmode = Beatmap::MODES['mania'];

        $this->assertSame($keys, $beatmap->diff_size);
    }
}
