<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property int $beatmap_id
 * @property int $mode_id
 * @property float $ss_ratio
 * @property float $relative_playcount
 * @property int $unique_users
 * @property float $average_accuracy
 * @property \Carbon\Carbon|null $last_update
 */
class BeatmapModeStats extends Model
{
    protected $table = 'osu_beatmap_mode_stats';
    protected $dates = ['last_update'];
    protected $primaryKeys = ['beatmap_id', 'mode_id'];
}
