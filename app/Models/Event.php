<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Models\Traits\WithDbCursorHelper;
use Carbon\Carbon;
use Sentry\State\Scope;

/**
 * @property Beatmap $beatmap
 * @property int|null $beatmap_id
 * @property Beatmapset $beatmapset
 * @property int|null $beatmapset_id
 * @property \Carbon\Carbon $date
 * @property int $epicfactor
 * @property int $event_id
 * @property bool|null $legacy_score_event
 * @property int $private
 * @property string $text
 * @property string|null $text_clean
 * @property User $user
 * @property int|null $user_id
 */
class Event extends Model
{
    use WithDbCursorHelper;

    protected const DEFAULT_SORT = 'id_desc';
    protected const SORTS = [
        'id_asc' => [
            ['column' => 'event_id', 'order' => 'ASC'],
        ],
        'id_desc' => [
            ['column' => 'event_id', 'order' => 'DESC'],
        ],
    ];

    public ?array $details = null;
    public $parsed = false;
    public ?string $type = null;

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

    public $timestamps = false;

    protected $casts = ['date' => 'datetime'];
    protected $primaryKey = 'event_id';
    protected $table = 'osu_events';

    public static function generate($type, $options)
    {
        switch ($type) {
            case 'achievement':
                $achievement = $options['achievement'];
                $user = $options['user'];

                // not escaped because it's not in the old system either
                $achievementName = $achievement->name;
                $userLink = static::userLink($options['user']);

                $params = [
                    // taken from medal
                    'text' => "<b>{$userLink['html']}</b> unlocked the \"<b>{$achievementName}</b>\" medal!",
                    'user_id' => $user->getKey(),
                    'private' => false,
                    'epicfactor' => 4,
                ];

                break;

            case 'beatmapsetApprove':
                $beatmapset = $options['beatmapset'];
                $beatmapsetLink = static::beatmapsetLink($beatmapset);
                $userLink = static::userLink($options['beatmapset']->user);
                $approval = e($beatmapset->status());

                $template = '%s by %s has just been %s!';
                $params = [
                    'text' => sprintf($template, $beatmapsetLink['html'], tag('b', [], $userLink['html']), $approval),
                    'text_clean' => sprintf($template, $beatmapsetLink['clean'], $userLink['clean'], $approval),
                    'beatmap_id' => 0,
                    'beatmapset_id' => $beatmapset->getKey(),
                    'user_id' => $beatmapset->user->getKey(),
                    'private' => false,
                    'epicfactor' => 8,
                ];

                break;

            case 'beatmapsetDelete':
                $beatmapset = $options['beatmapset'];
                $beatmapsetLink = static::beatmapsetLink($beatmapset);

                $params = [
                    'text' => "{$beatmapsetLink['html']} has been deleted.",
                    'beatmapset_id' => $beatmapset->getKey(),
                    'user_id' => $options['user']->getKey(),
                    'private' => false,
                    'epicfactor' => 1,
                ];

                break;

            case 'beatmapsetRevive':
                $beatmapset = $options['beatmapset'];
                $beatmapsetLink = static::beatmapsetLink($beatmapset);
                $userLink = static::userLink($beatmapset->user);

                $template = '%s has been revived from eternal slumber by %s.';
                $params = [
                    'text' => sprintf($template, $beatmapsetLink['html'], tag('b', [], $userLink['html'])),
                    'text_clean' => sprintf($template, $beatmapsetLink['clean'], $userLink['clean']),
                    'beatmapset_id' => $beatmapset->getKey(),
                    'user_id' => $beatmapset->user->getKey(),
                    'private' => false,
                    'epicfactor' => 5,
                ];

                break;

            case 'beatmapsetUpdate':
                $beatmapset = $options['beatmapset'];
                $beatmapsetLink = static::beatmapsetLink($beatmapset);
                // retrieved separately from options because it doesn't necessarily need to be the same user
                // as $beatmapset->user in some cases (see: direct guest difficulty update)
                $user = $options['user'];
                $userLink = static::userLink($user);

                $template = '%s has updated the beatmap "%s"';
                $params = [
                    'text' => sprintf($template, tag('b', [], $userLink['html']), $beatmapsetLink['html']),
                    'text_clean' => sprintf($template, $userLink['clean'], $beatmapsetLink['clean']),
                    'beatmapset_id' => $beatmapset->getKey(),
                    'user_id' => $user->getKey(),
                    'private' => false,
                    'epicfactor' => 2,
                ];

                break;

            case 'beatmapsetUpload':
                $beatmapset = $options['beatmapset'];
                $beatmapsetLink = static::beatmapsetLink($beatmapset);
                $userLink = static::userLink($beatmapset->user);

                $template = '%s has submitted a new beatmap "%s"';
                $params = [
                    'text' => sprintf($template, tag('b', [], $userLink['html']), $beatmapsetLink['html']),
                    'text_clean' => sprintf($template, $userLink['clean'], $beatmapsetLink['clean']),
                    'beatmapset_id' => $beatmapset->getKey(),
                    'user_id' => $beatmapset->user->getKey(),
                    'private' => false,
                    'epicfactor' => 4,
                ];

                break;

            case 'rank':
                $beatmap = $options['beatmap'];
                $ruleset = $options['ruleset'];
                $rulesetName = trans("beatmaps.mode.{$ruleset}");
                $beatmapLink = static::beatmapLink($beatmap, $ruleset);
                $user = $options['user'];
                $userLink = static::userLink($user);
                $positionAfter = $options['position_after'];
                $positionText = $positionAfter <= 50 ? "<b>rank #{$positionAfter}</b>" : "rank #{$positionAfter}";
                $rank = $options['rank'];
                $legacyScoreEvent = $options['legacy_score_event'];

                $params = [
                    'text' => "<img src='/images/{$rank}_small.png'/> <b>{$userLink['html']}</b> achieved {$positionText} on {$beatmapLink['html']} ({$rulesetName})",
                    'text_clean' => "{$userLink['clean']} achieved rank #{$positionAfter} on {$beatmapLink['clean']} ({$rulesetName})",
                    'beatmap_id' => $beatmap->getKey(),
                    'beatmapset_id' => $beatmap->beatmapset->getKey(),
                    'user_id' => $user->getKey(),
                    'private' => false,
                    // copy-pasted from https://github.com/peppy/osu-web-10/blob/2821062bbb668bc85fd655bd1c777d6e610c51b7/www/web/osu-submit-20190809.php#L1208
                    'epicfactor' => ($positionAfter === 1 && $ruleset === 'osu' && $beatmap->passcount > 250 ? 8 : ($positionAfter < 10 ? 4 : ($positionAfter < 40 ? 2 : 1))),
                    'legacy_score_event' => $legacyScoreEvent,
                ];
                break;

            case 'rankLost':
                $beatmap = $options['beatmap'];
                $ruleset = $options['ruleset'];
                $user = $options['user'];
                $legacyScoreEvent = $options['legacy_score_event'];

                $rulesetName = trans("beatmaps.mode.{$ruleset}");
                $beatmapLink = static::beatmapLink($beatmap, $ruleset);
                $userLink = static::userLink($user);

                $template = '%s has lost first place on %s (%s)';
                $params = [
                    'text' => sprintf($template, tag('b', [], $userLink['html']), $beatmapLink['html'], $rulesetName),
                    'text_clean' => sprintf($template, $userLink['clean'], $beatmapLink['clean'], $rulesetName),
                    'beatmap_id' => $beatmap->getKey(),
                    'beatmapset_id' => $beatmap->beatmapset->getKey(),
                    'user_id' => $user->getKey(),
                    'private' => false,
                    'epicfactor' => 2,
                    'legacy_score_event' => $legacyScoreEvent,
                ];
                break;

            case 'usernameChange':
                $user = $options['user'];
                $history = $options['history'];
                $userLink = static::userLink($user, $history);
                $newUsername = e($history->username);
                $params = [
                    'text' => "<b>{$userLink['html']}</b> has changed their username to {$newUsername}!",
                    'user_id' => $user->getKey(),
                    'date' => $history->timestamp,
                    'private' => false,
                    'epicfactor' => 4,
                ];

                break;

            case 'userSupportGift':
                $user = $options['user'];
                $userLink = static::userLink($user);
                $params = [
                    'text' => "<b>{$userLink['html']}</b> has received the gift of osu! supporter!",
                    'user_id' => $user->getKey(),
                    'date' => $options['date'],
                    'private' => false,
                    'epicfactor' => 2,
                ];

                break;

            case 'userSupportFirst':
                $user = $options['user'];
                $userLink = static::userLink($user);
                $params = [
                    'text' => "<b>{$userLink['html']}</b> has become an osu! supporter - thanks for your generosity!",
                    'user_id' => $user->getKey(),
                    'date' => $options['date'],
                    'private' => false,
                    'epicfactor' => 2,
                ];

                break;

            case 'userSupportAgain':
                $user = $options['user'];
                $userLink = static::userLink($user);
                $params = [
                    'text' => "<b>{$userLink['html']}</b> has once again chosen to support osu! - thanks for your generosity!",
                    'user_id' => $user->getKey(),
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
            case 'osu!mania':
                return 'mania';
            case 'Taiko':
            case 'osu!taiko':
                return 'taiko';
            case 'osu!':
                return 'osu';
            case 'Catch the Beat':
            case 'osu!catch':
                return 'fruits';
        }
    }

    public function parseFailure($reason)
    {
        app('sentry')->getClient()->captureMessage(
            'Failed parsing event',
            null,
            (new Scope())
                ->setTag('reason', $reason)
                ->setExtra('event', $this->toArray())
        );

        return ['parse_error' => true];
    }

    public function parseMatchesAchievement($matches)
    {
        $achievement = app('medals')->byNameIncludeDisabled($matches['achievementName']);
        if ($achievement === null) {
            return $this->parseFailure("unknown achievement ({$matches['achievementName']})");
        }

        return [
            'achievement' => json_item($achievement, 'Achievement'),
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
            return $this->parseFailure("unknown mode ({$matches['mode']})");
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
            return $this->parseFailure("unknown mode ({$matches['mode']})");
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
                $this->details = $this->parseFailure('no matching pattern');
            }

            $this->parsed = true;
        }

        return $this;
    }

    public function scopeRecent($query, null | true $legacyOnly)
    {
        return $query->orderBy('event_id', 'desc')
            ->whereNull('legacy_score_event')
            ->orWhere('legacy_score_event', '=', $legacyOnly === true)
            ->limit(5);
    }

    private static function userLink($user, $usernameChange = null)
    {
        $url = route('users.show', $user, false);
        $username = $usernameChange->username_last ?? $user->username;
        return [
            'html' => sprintf('<a href=\'%s\'>%s</a>', e($url), e($username)),
            'clean' => "[{$GLOBALS['cfg']['app']['url']}{$url} {$username}]",
        ];
    }

    private static function beatmapsetLink($beatmapset)
    {
        $url = route('beatmapsets.show', $beatmapset, false);
        $title = $beatmapset->artist.' - '.$beatmapset->title;
        return [
            'html' => sprintf('<a href=\'%s\'>%s</a>', e($url), e($title)),
            'clean' => "[{$GLOBALS['cfg']['app']['url']}{$url} {$title}]",
        ];
    }

    private static function beatmapLink($beatmap, $ruleset)
    {
        $url = route('beatmaps.show', ['beatmap' => $beatmap, 'ruleset' => $ruleset], false);
        $title = "{$beatmap->beatmapset->artist} - {$beatmap->beatmapset->title} [{$beatmap->version}]";
        return [
            'html' => sprintf('<a href=\'%s\'>%s</a>', e($url), e($title)),
            'clean' => "[{$GLOBALS['cfg']['app']['url']}{$url} {$title}]",
        ];
    }
}
