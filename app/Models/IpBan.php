<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property int $active
 * @property int $ip
 * @property int $length
 * @property \Carbon\Carbon $timestamp
 * @property int|null $user_id
 */
class IpBan extends Model
{
    protected $table = 'osu_ip_bans';
    protected $primaryKey = 'ip';
    protected $dates = ['timestamp'];

    public $timestamps = false;
}
