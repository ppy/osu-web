<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

/**
 * @property string|null $group_indicator
 * @property int $id
 * @property int $room_id
 * @property int $season_id
 */
class SeasonRoom extends Model
{
    public $timestamps = false;
}
