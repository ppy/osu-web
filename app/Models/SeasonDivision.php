<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

/**
 * @property int $id
 * @property string $image_url
 * @property string $name
 * @property int $season_id
 * @property double $threshold
 */
class SeasonDivision extends Model
{
    public $timestamps = false;
}
