<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property string $api_key
 * @property string $app_name
 * @property string $app_url
 * @property int $enabled
 * @property int $hit_count
 * @property int $key
 * @property int $miss_count
 * @property int $revoked
 * @property int $user_id
 */
class ApiKey extends Model
{
    protected $table = 'osu_apikeys';
    protected $primaryKey = 'key';
    public $timestamps = false;
}
