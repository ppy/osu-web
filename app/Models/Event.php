<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
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

class Event extends Model
{
    const PATTERN_ACHIEVEMENT = "!^(?:<b>)+<a href='(?<userUrl>.+?)'>(?<userName>.+?)</a>(?:</b>)+ unlocked the \"<b>(?<achievementName>.+?)</b>\" achievement\!$!";
    const PATTERN_BEATMAP_PLAYCOUNT = "!^<a href='(?<beatmapUrl>.+?)'>(?<beatmapTitle>.+?)</a> has been played (?<count>[\d,]+) times\!$!";
    const PATTERN_BEATMAP_SET_APPROVAL = "!^<a href='(?<beatmapSetUrl>.+?)'>(?<beatmapSetTitle>.+?)</a> by <b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has just been (?<approval>ranked|approved|qualified)\!$!";
    const PATTERN_BEATMAP_UPDATE = "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has updated the beatmap \"<a href='(?<beatmapUrl>.+?)'>(?<beatmapTitle>.+?)</a>\"$!";
    const PATTERN_RANK = "!^<img src='/images/(?<scoreRank>.+?)_small\.png'/> <b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> achieved (?:<b>)?rank #(?<rank>\d+?)(?:</b>)? on <a href='(?<beatmapUrl>.+?)'>(?<beatmapTitle>.+?)</a> \((?<mode>.+?)\)$!";
    const PATTERN_RANK_LOST = "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has lost first place on <a href='(?<beatmapUrl>.+?)'>(?<beatmapTitle>.+?)</a> \((?<mode>.+?)\)$!";
    const PATTERN_USERNAME_CHANGE = "!^<b><a href='(?<userUrl>.+?)'>(?<previousUsername>.+?)</a></b> has changed their username to (?<userName>.+)\!$!";
    const PATTERN_USER_SUPPORT_AGAIN = "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has once again chosen to support osu\! - thanks for your generosity\!$!";

    protected $table = 'osu_events';
    protected $primaryKey = 'event_id';

    protected $dates = ['date'];
    public $timestamps = false;

    protected $casts = [
        'event_id' => 'integer',
        'beatmap_id' => 'integer',
        'beatmapset_id' => 'integer',
        'user_id' => 'integer',
        'epicfactor' => 'integer',
        'private' => 'integer',
    ];

    protected $appends = ['details'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id', 'beatmap_id');
    }

    public function beatmapSet()
    {
        return $this->belongsTo(BeatmapSet::class, 'beatmapset_id', 'beatmapset_id');
    }

    public function getDetailsAttribute()
    {
        return $this->parseText();
    }

    public function parseFailure()
    {
        return [];
    }

    public function parseMatchesAchievement($matches)
    {
        $achievement = Achievement::where(['name' => $matches['achievementName']])->first();
        if ($achievement === null) {
            return $this->parseFailure();
        }

        return [
            'type' => 'achievement',
            'achievement' => [
                'slug' => $achievement->slug,
                'name' => $achievement->name,
            ],
            'user' => [
                'username' => $matches['userName'],
                'url' => $matches['userUrl'],
            ],
        ];
    }

    public function parseMatchesBeatmapPlaycount($matches)
    {
        $count = intval(str_replace(',', '', $matches['count']));

        return [
            'type' => 'beatmapPlaycount',
            'beatmap' => [
                'title' => $matches['beatmapTitle'],
                'url' => $matches['beatmapUrl'],
            ],
            'count' => $count,
        ];
    }

    public function parseMatchesBeatmapSetApproval($matches)
    {
        $approval = $matches['approval'];
        if ($approval === 'ranked') {
            $approval = 'qualified';
        }

        return [
            'type' => 'beatmapSetApproval',
            'approval' => $approval,
            'beatmapSet' => [
                'title' => $matches['beatmapSetTitle'],
                'url' => $matches['beatmapSetUrl'],
            ],
            'user' => [
                'username' => $matches['userName'],
                'url' => $matches['userUrl'],
            ],
        ];
    }

    public function parseMatchesBeatmapUpdate($matches)
    {
        return [
            'type' => 'beatmapUpdate',
            'beatmap' => [
                'title' => $matches['beatmapTitle'],
                'url' => $matches['beatmapUrl'],
            ],
            'user' => [
                'username' => $matches['userName'],
                'url' => $matches['userUrl'],
            ],
        ];
    }

    public function parseMatchesRank($matches)
    {
        $scoreRank = str_replace('x', 'ss', strtolower($matches['scoreRank']));

        switch ($matches['mode']) {
            case 'osu!mania': $mode = 'mania'; break;
            case 'Taiko': $mode = 'taiko'; break;
            case 'osu!': $mode = 'osu'; break;
            case 'Catch the Beat': $mode = 'ctb'; break;
            default: return $this->parseFailure();
        }

        return [
            'type' => 'rank',
            'scoreRank' => $scoreRank,
            'rank' => intval($matches['rank']),
            'mode' => $mode,
            'beatmap' => [
                'title' => $matches['beatmapTitle'],
                'url' => $matches['beatmapUrl'],
            ],
            'user' => [
                'username' => $matches['userName'],
                'url' => $matches['userUrl'],
            ],
        ];
    }

    public function parseMatchesRankLost($matches)
    {
        switch ($matches['mode']) {
            case 'osu!mania': $mode = 'mania'; break;
            case 'Taiko': $mode = 'taiko'; break;
            case 'osu!': $mode = 'osu'; break;
            case 'Catch the Beat': $mode = 'ctb'; break;
            default: return $this->parseFailure();
        }

        return [
            'type' => 'rankLost',
            'mode' => $mode,
            'beatmap' => [
                'title' => $matches['beatmapTitle'],
                'url' => $matches['beatmapUrl'],
            ],
            'user' => [
                'username' => $matches['userName'],
                'url' => $matches['userUrl'],
            ],
        ];
    }

    public function parseMatchesUsernameChange($matches)
    {
        return [
            'type' => 'usernameChange',
            'user' => [
                'previousUsername' => $matches['previousUsername'],
                'username' => $matches['userName'],
                'url' => $matches['userUrl'],
            ],
        ];
    }

    public function parseMatchesUserSupportAgain($matches)
    {
        return [
            'type' => 'userSupportAgain',
            'user' => [
                'username' => $matches['userName'],
                'url' => $matches['userUrl'],
            ],
        ];
    }

    public function parseText()
    {
        if (preg_match(static::PATTERN_RANK, $this->text, $matches) === 1) {
            return $this->parseMatchesRank($matches);
        } elseif (preg_match(static::PATTERN_RANK_LOST, $this->text, $matches) === 1) {
            return $this->parseMatchesRankLost($matches);
        } elseif (preg_match(static::PATTERN_ACHIEVEMENT, $this->text, $matches) === 1) {
            return $this->parseMatchesAchievement($matches);
        } elseif (preg_match(static::PATTERN_BEATMAP_UPDATE, $this->text, $matches) === 1) {
            return $this->parseMatchesBeatmapUpdate($matches);
        } elseif (preg_match(static::PATTERN_BEATMAP_PLAYCOUNT, $this->text, $matches) === 1) {
            return $this->parseMatchesBeatmapPlaycount($matches);
        } elseif (preg_match(static::PATTERN_BEATMAP_SET_APPROVAL, $this->text, $matches) === 1) {
            return $this->parseMatchesBeatmapSetApproval($matches);
        } elseif (preg_match(static::PATTERN_USERNAME_CHANGE, $this->text, $matches) === 1) {
            return $this->parseMatchesUsernameChange($matches);
        } elseif (preg_match(static::PATTERN_USER_SUPPORT_AGAIN, $this->text, $matches) === 1) {
            return $this->parseMatchesUserSupportAgain($matches);
        }

        return $this->parseFailure();
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('date', 'desc')->limit(5);
    }
}
