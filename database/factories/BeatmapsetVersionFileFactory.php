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

    private static function randomExt(): string
    {
        return '.'.array_rand_val([
            'jpg',
            'mp3',
            'osb',
            'osu',
            'png',
        ]);
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
            'filename' => fn (): string => $this->faker->word().static::randomExt(),
            'version_id' => BeatmapsetVersion::factory(),
        ];
    }
}
