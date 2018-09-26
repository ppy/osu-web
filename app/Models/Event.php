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

use Carbon\Carbon;
use Sentry;

class Event extends Model
{
    public $parsed = false;

    public $patterns = [
        'achievement' => "!^(?:<b>)+<a href='(?<userUrl>.+?)'>(?<userName>.+?)</a>(?:</b>)+ unlocked the \"<b>(?<achievementName>.+?)</b>\" achievement\!$!",
        'beatmapPlaycount' => "!^<a href='(?<beatmapUrl>.+?)'>(?<beatmapTitle>.+?)</a> has been played (?<count>[\d,]+) times\!$!",
        'beatmapsetApprove' => "!^<a href='(?<beatmapsetUrl>.+?)'>(?<beatmapsetTitle>.+?)</a> by <b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has just been (?<approval>ranked|approved|qualified|loved)\!$!",
        'beatmapsetDelete' => "!^<a href='(?<beatmapsetUrl>.+?)'>(?<beatmapsetTitle>.*?)</a> has been deleted.$!",
        'beatmapsetRevive' => "!^<a href='(?<beatmapsetUrl>.+?)'>(?<beatmapsetTitle>.*?)</a> has been revived from eternal slumber(?: by <b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b>)?\.$!",
        'beatmapsetUpdate' => "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has updated the beatmap \"<a href='(?<beatmapsetUrl>.+?)'>(?<beatmapsetTitle>.*?)</a>\"$!",
        'beatmapsetUpload' => "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has submitted a new beatmap \"<a href='(?<beatmapsetUrl>.+?)'>(?<beatmapsetTitle>.*?)</a>\"$!",
        'medal' => "!^(?:<b>)+<a href='(?<userUrl>.+?)'>(?<userName>.+?)</a>(?:</b>)+ unlocked the \"<b>(?<achievementName>.+?)</b>\" medal\!$!",
        'rank' => "!^<img src='/images/(?<scoreRank>.+?)_small\.png'/> <b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> achieved (?:<b>)?rank #(?<rank>\d+?)(?:</b>)? on <a href='(?<beatmapUrl>.+?)'>(?<beatmapTitle>.+?)</a> \((?<mode>.+?)\)$!",
        'rankLost' => "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has lost first place on <a href='(?<beatmapUrl>.+?)'>(?<beatmapTitle>.+?)</a> \((?<mode>.+?)\)$!",
        'userSupportAgain' => "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has once again chosen to support osu\! - thanks for your generosity\!$!",
        'userSupportFirst' => "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has become an osu\! supporter - thanks for your generosity\!$!",
        'userSupportGift' => "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has received the gift of osu\! supporter\!$!",
        'usernameChange' => "!^<b><a href='(?<userUrl>.+?)'>(?<previousUsername>.+?)</a></b> has changed their username to (?<userName>.+)\!$!",
    ];

    protected $table = 'osu_events';
    protected $primaryKey = 'event_id';

    protected $dates = ['date'];
    public $timestamps = false;

    public static function generate($type, $options)
    {
        switch ($type) {
            case 'beatmapsetApprove':
                $beatmapset = $options['beatmapset'];

                $beatmapsetUrl = e(route('beatmapsets.show', $beatmapset, false));
                $beatmapsetTitle = e($beatmapset->artist.' - '.$beatmapset->title);
                $userName = e($beatmapset->user->username);
                $userUrl = e(route('users.show', $beatmapset->user, false));
                $approval = e($beatmapset->status());

                $params = [
                    'text' => "<a href='{$beatmapsetUrl}'>{$beatmapsetTitle}</a> by <b><a href='{$userUrl}'>{$userName}</a></b> has just been {$approval}!",
                    'beatmap_id' => 0,
                    'beatmapset_id' => $beatmapset->getKey(),
                    'user_id' => $beatmapset->user->getKey(),
                    'private' => false,
                    'epicfactor' => 8,
                ];

                break;

            case 'usernameChange':
                $user = static::userParams($options['user']);
                $oldUsername = e($options['history']->username_last);
                $newUsername = e($options['history']->username);
                $params = [
                    'text' => "<b><a href='{$user['url']}'>{$oldUsername}</a></b> has changed their username to {$newUsername}!",
                    'user_id' => $user['id'],
                    'date' => $options['history']->timestamp,
                    'private' => false,
                    'epicfactor' => 4,
                ];

                break;

            case 'userSupportGift':
                $user = static::userParams($options['user']);
                $params = [
                    'text' => "<b><a href='{$user['url']}'>{$user['username']}</a></b> has received the gift of osu! supporter!",
                    'user_id' => $user['id'],
                    'date' => $options['date'],
                    'private' => false,
                    'epicfactor' => 2,
                ];

                break;

            case 'userSupportFirst':
                $user = static::userParams($options['user']);
                $params = [
                    'text' => "<b><a href='{$user['url']}'>{$user['username']}</a></b> has become an osu! supporter - thanks for your generosity!",
                    'user_id' => $user['id'],
                    'date' => $options['date'],
                    'private' => false,
                    'epicfactor' => 2,
                ];

                break;

            case 'userSupportAgain':
                $user = static::userParams($options['user']);
                $params = [
                    'text' => "<b><a href='{$user['url']}'>{$user['username']}</a></b> has once again chosen to support osu! - thanks for your generosity!",
                    'user_id' => $user['id'],
                    'date' => $options['date'],
                    'private' => false,
                    'epicfactor' => 2,
                ];

                break;
        }

        if (isset($params)) {
            if (!isset($params['date'])) {
                $params['date'] = Carbon::now();
            }

            return static::create($params);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id', 'beatmap_id');
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id', 'beatmapset_id');
    }

    public function arrayBeatmap($matches)
    {
        $beatmapTitle = presence($matches['beatmapTitle'], '(no title)');

        return [
            'title' => html_entity_decode_better($beatmapTitle),
            'url' => html_entity_decode_better($matches['beatmapUrl']),
        ];
    }

    public function arrayBeatmapset($matches)
    {
        $beatmapsetTitle = presence($matches['beatmapsetTitle'], '(no title)');

        return [
            'title' => html_entity_decode_better($beatmapsetTitle),
            'url' => html_entity_decode_better($matches['beatmapsetUrl']),
        ];
    }

    public function arrayUser($matches)
    {
        if (isset($matches['userName'])) {
            $username = html_entity_decode_better($matches['userName']);
            $userUrl = html_entity_decode_better($matches['userUrl']);
        } else {
            $user = $this->user;
            $username = $user->username;
            $userUrl = route('users.show', $user->user_id);
        }

        return [
            'username' => $username,
            'url' => $userUrl,
        ];
    }

    public function stringMode($mode)
    {
        switch ($mode) {
            case 'osu!mania': return 'mania';
            case 'Taiko': return 'taiko';
            case 'osu!': return 'osu';
            case 'Catch the Beat': return 'fruits';
        }
    }

    public function parseFailure()
    {
        Sentry::captureMessage('Failed parsing event', ['log'], [
            'extra' => [
                'event' => $this->toArray(),
            ],
        ]);

        return ['parse_error' => true];
    }

    public function parseMatchesAchievement($matches)
    {
        $achievement = Achievement::where(['name' => $matches['achievementName']])->first();
        if ($achievement === null) {
            return $this->parseFailure();
        }

        return [
            'achievement' => [
                'slug' => $achievement->slug,
                'name' => $achievement->name,
            ],
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesBeatmapPlaycount($matches)
    {
        $count = intval(str_replace(',', '', $matches['count']));

        return [
            'beatmap' => $this->arrayBeatmap($matches),
            'count' => $count,
        ];
    }

    public function parseMatchesBeatmapsetApprove($matches)
    {
        return [
            'approval' => $matches['approval'],
            'beatmapset' => $this->arrayBeatmapset($matches),
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesBeatmapsetDelete($matches)
    {
        return [
            'beatmapset' => $this->arrayBeatmapset($matches),
        ];
    }

    public function parseMatchesBeatmapsetRevive($matches)
    {
        return [
            'beatmapset' => $this->arrayBeatmapset($matches),
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesBeatmapsetUpdate($matches)
    {
        return [
            'beatmapset' => $this->arrayBeatmapset($matches),
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesBeatmapsetUpload($matches)
    {
        return [
            'beatmapset' => $this->arrayBeatmapset($matches),
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesMedal($matches)
    {
        $this->type = 'achievement';

        return $this->parseMatchesAchievement($matches);
    }

    public function parseMatchesRank($matches)
    {
        $mode = $this->stringMode($matches['mode']);
        if ($mode === null) {
            return $this->parseFailure();
        }

        return [
            'scoreRank' => $matches['scoreRank'],
            'rank' => intval($matches['rank']),
            'mode' => $mode,
            'beatmap' => $this->arrayBeatmap($matches),
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesRankLost($matches)
    {
        $mode = $this->stringMode($matches['mode']);
        if ($mode === null) {
            return $this->parseFailure();
        }

        return [
            'mode' => $mode,
            'beatmap' => $this->arrayBeatmap($matches),
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesUsernameChange($matches)
    {
        return [
            'user' => array_merge(
                $this->arrayUser($matches),
                ['previousUsername' => html_entity_decode_better($matches['previousUsername'])]
            ),
        ];
    }

    public function parseMatchesUserSupportAgain($matches)
    {
        return [
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesUserSupportFirst($matches)
    {
        return [
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesUserSupportGift($matches)
    {
        return [
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parse()
    {
        if (!$this->parsed) {
            foreach ($this->patterns as $name => $pattern) {
                if (preg_match($pattern, $this->text, $matches) !== 1) {
                    continue;
                }

                $this->type = $name;
                $fname = 'parseMatches'.ucfirst($name);

                $this->details = $this->$fname($matches);
                break;
            }

            if ($this->details === null) {
                $this->details = $this->parseFailure($matches);
            }

            $this->parsed = true;
        }

        return $this;
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('date', 'desc')->limit(5);
    }

    private static function userParams($user)
    {
        return [
            'id' => $user->getKey(),
            'username' => e($user->username),
            'url' => e(route('users.show', $user, false)),
        ];
    }
}
