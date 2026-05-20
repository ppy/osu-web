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
            ['test background 1.osu', [
                'audioFilename' => 'audio.mp3',
                'previewTime' => -1,
                'backgroundImage' => 'bg.jpg',
            ]],
            ['test background 2.osu', [
                'audioFilename' => 'audio.mp3',
                'previewTime' => 73743,
                'backgroundImage' => 'arrow.png',
            ]],
            ['test background 3.osu', [
                'audioFilename' => 'audio.mp3',
                'previewTime' => -1,
                'backgroundImage' => null,
            ]],
        ];
    }

    #[DataProvider('dataProviderForTestFindBackground')]
    public function testFindBackground(string $osuFilename, ?array $expectedAttributes): void
    {
        $path = __DIR__.'/beatmap_examples/'.$osuFilename;
        $parsed = new BeatmapFile(file_get_contents($path));

        foreach ($expectedAttributes as $key => $expectedValue) {
            $this->assertSame($expectedValue, $parsed->$key);
        }
    }
}
