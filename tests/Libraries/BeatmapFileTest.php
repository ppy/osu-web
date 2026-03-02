<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Libraries\BeatmapFile;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BeatmapFileTest extends TestCase
{
    public static function dataProviderForTestFindBackground(): array
    {
        return [
            ['test background 1.osu', 'bg.jpg'],
            ['test background 2.osu', 'arrow.png'],
            ['test background 3.osu', null],
        ];
    }

    #[DataProvider('dataProviderForTestFindBackground')]
    public function testFindBackground(string $osuFilename, ?string $expectedFilename): void
    {
        $path = __DIR__.'/beatmap_examples/'.$osuFilename;

        $this->assertSame($expectedFilename, BeatmapFile::findBackground(file_get_contents($path)));
    }
}
