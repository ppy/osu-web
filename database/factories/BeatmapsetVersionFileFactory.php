<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BeatmapsetFile;
use App\Models\BeatmapsetVersion;
use App\Models\BeatmapsetVersionFile;

class BeatmapsetVersionFileFactory extends Factory
{
    protected $model = BeatmapsetVersionFile::class;

    private static function randomFilename(): string
    {
        $ext = '.'.array_rand_val([
            'jpg',
            'mp3',
            'osb',
            'osu',
            'png',
        ]);

        static $chars = [...range('A', 'Z'), ...range('a', 'z'), ...range('0', '9'), ''];

        return implode(array_map(
            fn (): string => array_rand_val($chars),
            array_fill(0, 32, ''),
        )).$ext;
    }

    public function copyFrom(BeatmapsetVersionFile $versionFile): static
    {
        return $this->state([
            'file_id' => $versionFile->file_id,
            'filename' => $versionFile->filename,
        ]);
    }

    public function definition(): array
    {
        return [
            'file_id' => BeatmapsetFile::factory(),
            'filename' => static::randomFilename(...),
            'version_id' => BeatmapsetVersion::factory(),
        ];
    }
}
