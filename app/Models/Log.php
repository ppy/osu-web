<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Forum\Forum $forum
 * @property int $forum_id
 * @property mixed $log_data
 * @property int $log_id
 * @property string $log_ip
 * @property string $log_operation
 * @property int $log_time
 * @property int $log_type
 * @property User $reportee
 * @property int $reportee_id
 * @property Forum\Topic $topic
 * @property int $topic_id
 * @property User $user
 * @property int $user_id
 */
class Log extends Model
{
    const LOG_FORUM_ADMIN = 0;
    const LOG_FORUM_MOD = 1;
    const LOG_FORUM_CRITICAL = 2;
    const LOG_USERS = 3;
    const LOG_COMMENT_MOD = 4;
    const LOG_BEATMAPSET_MOD = 5;
    const LOG_USER_MOD = 6;

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
