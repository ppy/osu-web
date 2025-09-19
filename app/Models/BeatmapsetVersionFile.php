<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read BeatmapsetFile $file
 * @property int $file_id
 * @property string $filename
 * @property int $id
 * @property-read BeatmapsetVersion $version
 * @property int $version_id
 */
class BeatmapsetVersionFile extends Model
{
    public $timestamps = false;

    public function file(): BelongsTo
    {
        return $this->belongsTo(BeatmapsetFile::class, 'file_id');
    }

    public function version(): BelongsTo
    {
        return $this->belongsTo(BeatmapsetVersion::class, 'version_id');
    }
}
