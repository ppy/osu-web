<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\ReplayViewCount;

/**
 * @property int $play_count
 * @property int $score_id
 * @property int $version
 */
class Mania extends Model
{
    protected $table = 'osu_replays_mania';
}
