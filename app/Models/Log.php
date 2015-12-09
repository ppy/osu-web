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

class Log extends Model
{
    protected $table = 'phpbb_log';
    protected $primaryKey = 'log_id';
    protected $guarded = [];

    public $timestamps = false;
    protected $dates = ['log_time'];
    protected $dateFormat = 'U';

    protected $casts = [
        'log_id' => 'integer',
        'log_type' => 'integer',

        'forum_id' => 'integer',
        'topic_id' => 'integer',

        'user_id' => 'integer',
        'reportee_id' => 'integer',
    ];

    public function getLogDataAttribute($value)
    {
        if (presence($value) === null) {
            return [];
        }

        return unserialize($value);
    }

    public function setLogDataAttribute($value)
    {
        $this->attributes['log_data'] = serialize($value);
    }

    public function forum()
    {
        return $this->belongsTo(Forum\Forum::class);
    }

    public function topic()
    {
        return $this->belongsTo(Forum\Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reportee()
    {
        return $this->belongsTo(User::class, 'reportee_id', 'user_id');
    }
}
