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

class Event extends Model
{
    public $parsed = false;

    public $patterns = [
        'achievement' => "!^(?:<b>)+<a href='(?<userUrl>.+?)'>(?<userName>.+?)</a>(?:</b>)+ unlocked the \"<b>(?<achievementName>.+?)</b>\" achievement\!$!",
        'beatmapPlaycount' => "!^<a href='(?<beatmapUrl>.+?)'>(?<beatmapTitle>.+?)</a> has been played (?<count>[\d,]+) times\!$!",
        'beatmapSetApprove' => "!^<a href='(?<beatmapSetUrl>.+?)'>(?<beatmapSetTitle>.+?)</a> by <b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has just been (?<approval>ranked|approved|qualified)\!$!",
        'beatmapSetDelete' => "!^<a href='(?<beatmapSetUrl>.+?)'>(?<beatmapSetTitle>.*?)</a> has been deleted.$!",
        'beatmapSetRevive' => "!^<a href='(?<beatmapSetUrl>.+?)'>(?<beatmapSetTitle>.*?)</a> has been revived from eternal slumber(?: by <b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b>)?\.$!",
        'beatmapSetUpdate' => "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has updated the beatmap \"<a href='(?<beatmapSetUrl>.+?)'>(?<beatmapSetTitle>.*?)</a>\"$!",
        'beatmapSetUpload' => "!^<b><a href='(?<userUrl>.+?)'>(?<userName>.+?)</a></b> has submitted a new beatmap \"<a href='(?<beatmapSetUrl>.+?)'>(?<beatmapSetTitle>.*?)</a>\"$!",
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

    protected $casts = [
        'event_id' => 'integer',
        'beatmap_id' => 'integer',
        'beatmapset_id' => 'integer',
        'user_id' => 'integer',
        'epicfactor' => 'integer',
        'private' => 'integer',
    ];

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

    public function arrayBeatmap($matches)
    {
        $beatmapTitle = presence($matches['beatmapTitle'], '(no title)');

        return [
            'title' => html_entity_decode($beatmapTitle),
            'url' => html_entity_decode($matches['beatmapUrl']),
        ];
    }

    public function arrayBeatmapSet($matches)
    {
        $beatmapSetTitle = presence($matches['beatmapSetTitle'], '(no title)');

        return [
            'title' => html_entity_decode($beatmapSetTitle),
            'url' => html_entity_decode($matches['beatmapSetUrl']),
        ];
    }

    public function arrayUser($matches)
    {
        if (isset($matches['userName'])) {
            $username = html_entity_decode($matches['userName']);
            $userUrl = html_entity_decode($matches['userUrl']);
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
            case 'Catch the Beat': return 'ctb';
        }
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

    public function parseMatchesBeatmapSetApprove($matches)
    {
        $approval = $matches['approval'];
        if ($approval === 'ranked') {
            $approval = 'qualified';
        }

        return [
            'approval' => $approval,
            'beatmapSet' => $this->arrayBeatmapSet($matches),
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesBeatmapSetDelete($matches)
    {
        return [
            'beatmapSet' => $this->arrayBeatmapSet($matches),
        ];
    }

    public function parseMatchesBeatmapSetRevive($matches)
    {
        return [
            'beatmapSet' => $this->arrayBeatmapSet($matches),
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesBeatmapSetUpdate($matches)
    {
        return [
            'beatmapSet' => $this->arrayBeatmapSet($matches),
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesBeatmapSetUpload($matches)
    {
        return [
            'beatmapSet' => $this->arrayBeatmapSet($matches),
            'user' => $this->arrayUser($matches),
        ];
    }

    public function parseMatchesRank($matches)
    {
        $scoreRank = str_replace('x', 'ss', strtolower($matches['scoreRank']));

        $mode = $this->stringMode($matches['mode']);
        if ($mode === null) {
            return $this->parseFailure();
        }

        return [
            'scoreRank' => $scoreRank,
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
                ['previousUsername' => html_entity_decode($matches['previousUsername'])]
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
}
