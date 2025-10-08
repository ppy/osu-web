<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read Beatmapset $beatmapset
 * @property int $beatmapset_id
 * @property \Carbon\Carbon $created_at
 * @property int $previous_version_id
 * @property-read BeatmapsetVersion $previousVersion
 * @property int $version_id
 * @property \Illuminate\Database\Eloquent\Collection<BeatmapsetVersionFile> $versionFiles
 */
class BeatmapsetVersion extends Model
{
    const UPDATED_AT = null;

    protected $primaryKey = 'version_id';

    public function beatmapset(): BelongsTo
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function previousVersion(): BelongsTo
    {
        return $this->belongsTo(static::class, 'previous_version_id');
    }

    public function versionFiles(): HasMany
    {
        return $this->hasMany(BeatmapsetVersionFile::class);
    }

    public function changes(): array
    {
        $previous = $this->previousVersion;
        if ($previous === null) {
            $added = $this->versionFiles->all();
        } else {
            $previousVersionFilesByFilename = $previous->versionFiles->keyBy('filename');
            $currentVersionFiles = $this->versionFiles;

            $added = [];
            $updated = [];
            foreach ($currentVersionFiles as $versionFile) {
                $previousVersionFile = $previousVersionFilesByFilename[$versionFile->filename] ?? null;
                if ($previousVersionFile === null) {
                    $added[] = $versionFile;
                } else {
                    // no update otherwise
                    if ($previousVersionFile->file_id !== $versionFile->file_id) {
                        $updated[] = $versionFile;
                    }
                    $previousVersionFilesByFilename->forget($versionFile->filename);
                }
            }

            $removed = $previousVersionFilesByFilename->values()->all();
        }

        return [
            'added' => $added ?? [],
            'removed' => $removed ?? [],
            'updated' => $updated ?? [],
        ];
    }
}
