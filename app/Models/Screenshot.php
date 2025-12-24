<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Carbon\Carbon;

/**
 * @property int $screenshot_id
 * @property int $user_id
 * @property User $user
 * @property Carbon $timestamp
 * @property int $hits
 * @property Carbon $last_access
 * @property bool $deleted
 */
class Screenshot extends Model
{
    public $timestamps = false;
    protected $table = 'osu_screenshots';
    protected $primaryKey = 'screenshot_id';

    protected $casts = [
        'timestamp' => 'datetime',
        'last_access' => 'datetime',
        'deleted' => 'boolean',
    ];
}
