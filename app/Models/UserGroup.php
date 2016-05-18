<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'phpbb_user_group';
    public $timestamps = false;

    protected $casts = [
        'group_id' => 'integer',
    ];

    const REGULAR = 2;
    const GMT = 4;
    const ADMIN = 5;
    const BAT = 7;
    const DEV = 11;
    const MAT = 14;
    const ALUMNI = 16;
    const HAX = 17;
    const MOD = 18;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
