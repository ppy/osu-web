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

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Request;

class Log extends Model
{
    const LOG_FORUM_MOD = 1;

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
        return $this->belongsTo(User::class, 'reportee_id');
    }

    public static function logModerateForumTopic($operation, $topic, $user = null)
    {
        return static::log([
            'log_type' => static::LOG_FORUM_MOD,
            'log_operation' => $operation,
            'log_data' => [$topic->topic_title],

            'user_id' => ($user === null ? null : $user->user_id),
            'forum_id' => $topic->forum_id,
            'topic_id' => $topic->topic_id,
        ]);
    }

    public static function logModerateForumPost($operation, $post, $user = null)
    {
        // ideally should log post_id as well but current phpbb logging doesn't
        // log it and I'm just matching with whatever it's doing. Except post
        // title - phpbb uses actual post title which are all empty for recent
        // posts but this one use topic's.
        return static::logModerateForumTopic($operation, $post->topic, $user);
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

        if (array_get($params, 'user_id') === null) {
            $params['user_id'] = (Auth::check() === true ? Auth::user()->user_id : '0');
        }

        if (array_get($params, 'reportee_id') === null) {
            $params['reportee_id'] = '0';
        }

        if (array_get($params, 'log_ip') === null) {
            $params['log_ip'] = Request::ip();
        }

        if (array_get($params, 'log_time') === null) {
            $params['log_time'] = Carbon::now();
        }

        return static::create($params);
    }
}
