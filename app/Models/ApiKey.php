<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
