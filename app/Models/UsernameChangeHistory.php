<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property int $change_id
 * @property \Carbon\Carbon|null $timestamp
 * @property mixed $type
 * @property int $user_id
 * @property string $username
 * @property string|null $username_last
 */
class UsernameChangeHistory extends Model
{
    public $timestamps = false;

    protected $casts = ['timestamp' => 'datetime'];
    protected $table = 'osu_username_change_history';
    protected $primaryKey = 'change_id';

    public function scopeVisible($query)
    {
        $query->whereIn('type', ['support', 'paid', 'admin']);
    }
}
