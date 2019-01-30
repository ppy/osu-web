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
 * @property int $change_id
 * @property \Carbon\Carbon|null $timestamp
 * @property mixed $type
 * @property int $user_id
 * @property string $username
 * @property string|null $username_last
 */
class UsernameChangeHistory extends Model
{
    protected $table = 'osu_username_change_history';
    protected $primaryKey = 'change_id';

    protected $dates = ['timestamp'];
    public $timestamps = false;

    public function scopeVisible($query)
    {
        $query->whereIn('type', ['support', 'paid']);
    }
}
