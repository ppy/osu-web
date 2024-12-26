<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property int $id
 * @property float $factor
 * @property int $season_id
 */
class SeasonScoreFactor extends Model
{
    public $timestamps = false;
}
