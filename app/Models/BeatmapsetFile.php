<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $file_id
 * @property int $file_size
 * @property string $sha2_hash
 * @property-read \Illuminate\Database\Eloquent\Collection $versionFiles BeatmapsetVersionFile
 */
class BeatmapsetFile extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'file_id';

    public function versionFiles(): HasMany
    {
        return $this->hasMany(BeatmapsetVersionFile::class);
    }
}
