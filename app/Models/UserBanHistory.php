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

class UserBanHistory extends Model
{
    protected $table = 'osu_user_banhistory';
    protected $primaryKey = 'ban_id';

    protected $dates = ['timestamp'];
    public $timestamps = false;

    protected $casts = [
        'ban_id' => 'integer',
        'ban_status' => 'integer',
        'banner_id' => 'integer',
        'period' => 'integer',
        'reason' => 'string',
        'supporting_url' => 'string',
        'user_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function endTime()
    {
        return $this->timestamp->addSeconds($this->period);
    }

    public function scopeBans($query)
    {
        return $query->where('ban_status', '>', 0)->orderBy('timestamp', 'desc');
    }
}
