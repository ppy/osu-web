<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

class Log extends Model
{
    const LOG_FORUM_MOD = 1;

    protected $table = 'phpbb_log';
    protected $primaryKey = 'log_id';

    public $timestamps = false;
    protected $dates = ['log_time'];
    protected $dateFormat = 'U';

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
        return $this->belongsTo(Forum\Forum::class, 'forum_id');
    }

    public function topic()
    {
        return $this->belongsTo(Forum\Topic::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reportee()
    {
        return $this->belongsTo(User::class, 'reportee_id');
    }

    public static function log($params)
    {
        $permittedParams = [
            'user_id',
            'reportee_id',
            'log_type',
            'forum_id',
            'topic_id',
            'log_ip',
            'log_operation',
            'log_data',
            'log_time',
        ];

        $params = array_only($params, $permittedParams);

        if (array_get($params, 'reportee_id') === null) {
            $params['reportee_id'] = '0';
        }

        return static::create($params);
    }
}
