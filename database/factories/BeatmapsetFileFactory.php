<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BeatmapsetFile;

class BeatmapsetFileFactory extends Factory
{
    protected $model = BeatmapsetFile::class;

    private static function generateContent(int $size): string
    {
        return str_repeat('a', $size);
    }

    public function configure(): static
    {
        return $this->afterCreating(function (BeatmapsetFile $file) {
            BeatmapsetFile::storage()->put($file->path(), static::generateContent($file->file_size));
        });
    }

    public function definition(): array
    {
        return [
            'file_size' => rand(10, 100),
            'sha2_hash' => fn (array $attrs): string => hash(
                'sha256',
                static::generateContent($attrs['file_size']),
                true
            ),
        ];
    }
}
