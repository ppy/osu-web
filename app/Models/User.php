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

use App\Transformers\UserTransformer;
use Cache;
use Carbon\Carbon;
use DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\Messageable;
use App\Models\Chat\PrivateMessage;

class User extends Model implements AuthenticatableContract, Messageable
{
    use Authenticatable;

    protected $table = 'phpbb_users';
    protected $primaryKey = 'user_id';
    protected $guarded = [];

    protected $dates = ['user_regdate', 'user_lastvisit', 'user_lastpost_time'];
    protected $dateFormat = 'U';
    public $timestamps = false;

    protected $visible = ['user_id', 'username', 'username_clean', 'user_rank', 'osu_playstyle', 'user_colour'];

    protected $casts = [
        'osu_subscriber' => 'boolean',
        'user_timezone', 'float',
    ];

    public $flags;
    private $groupIds;
    private $_supportLength = null;

    const ANONYMOUS = 1; // Anonymous (guest)
    const PEPPY = 2; // blue-name
    const SYSTEM = 3; // BanchoBot
    const DEFAULT_RANK = 2; // blank/missing rank
    const GITHUB = 2382019; // github callback user

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getBanchoKey()
    {
        return $this->bancho_key;
    }

    public function usernameChangeCost()
    {
        $changesToDate = $this->usernameChangeHistory()
            ->whereIn('type', ['support', 'paid'])
            ->count();

        switch ($changesToDate) {
            case 0: return 0;
            case 1: return 8;
            case 2: return 16;
            case 3: return 32;
            case 4: return 64;
            default: return 100;
        }
    }

    public static function checkWhenUsernameAvailable($username)
    {
        $user = self::whereIn('username', [str_replace(' ', '_', $username), str_replace('_', ' ', $username)])->first();

        if ($user === null) {
            $lastUsage = UsernameChangeHistory::where('username_last', $username)
                ->orderBy('change_id', 'desc')
                ->first();

            if ($lastUsage === null) {
                return Carbon::now();
            }

            return Carbon::parse($lastUsage->timestamp)->addMonths(6);
        }

        if ($user->group_id !== 2 || $user->user_type === 1) {
            //reserved usernames
            return Carbon::now()->addYears(10);
        }

        $playCount = array_reduce(array_keys(Beatmap::MODES), function ($result, $mode) use ($user) {
            return $result + $user->statistics($mode, true)->value('playcount');
        }, 0);

        return $user->user_lastvisit
            ->addMonths(6)                 //base inactivity period for all accounts
            ->addDays($playCount * 0.75);  //bonus based on playcount
    }

    public static function validateUsername($username)
    {
        if ($username !== trim($username)) {
            return ["Username can't start or end with spaces!"];
        }

        if (strlen($username) < 3) {
            return ['The requested username is too short.'];
        }

        if (strlen($username) > 15) {
            return ['The requested username is too long.'];
        }

        if (strpos($username, '  ') !== false || !preg_match('#^[A-Za-z0-9-\[\]_ ]+$#u', $username)) {
            return ['The requested username contains invalid characters.'];
        }

        if (strpos($username, '_') !== false && strpos($username, ' ') !== false) {
            return ['Please use either underscores or spaces, not both!'];
        }

        foreach (model_pluck(DB::table('phpbb_disallow'), 'disallow_username') as $check) {
            if (preg_match('#^'.str_replace('%', '.*?', preg_quote($check, '#')).'$#i', $username)) {
                return ['This username choice is not allowed.'];
            }
        }

        if (($availableDate = self::checkWhenUsernameAvailable($username)) > Carbon::now()) {
            $remaining = Carbon::now()->diff($availableDate, false);

            if ($remaining->days > 365 * 2) {
                //no need to mention the inactivity period of the account is actively in use.
                return ['Username is already in use!'];
            } elseif ($remaining->days > 0) {
                return ["This username will be available for use in <strong>{$remaining->days}</strong> days."];
            } elseif ($remaining->h > 0) {
                return ["This username will be available for use in <strong>{$remaining->h}</strong> hours."];
            } else {
                return ['This username will be available for use any minute now!'];
            }
        }

        return [];
    }

    public function validateUsernameChangeTo($username)
    {
        if (!$this->hasSupported()) {
            return ["You must have <a href='http://osu.ppy.sh/p/support'>supported osu!</a> to change your name!"];
        }

        if ($username === $this->username) {
            return ['This is already your username, silly!'];
        }

        return self::validateUsername($username);
    }

    // verify that an api key is correct

    public function verify($key)
    {
        return $this->api->api_key === $key;
    }

    public static function lookup($username_or_id, $lookup_type = null, $find_all = false)
    {
        if (!present($username_or_id)) {
            return;
        }

        switch ($lookup_type) {
            case 'string':
                $user = self::where('username', $username_or_id)->orWhere('username_clean', $username_or_id);
                break;

            case 'id':
                $user = self::where('user_id', $username_or_id);
                break;

            default:
                if (is_numeric($username_or_id)) {
                    $user = self::where('user_id', $username_or_id);
                } else {
                    $user = self::where('username', $username_or_id)->orWhere('username_clean', $username_or_id);
                }
                break;
        }

        if (!$find_all) {
            $user = $user->where('user_type', 0)->where('user_warnings', 0);
        }

        return $user->first();
    }

    public function getUserAvatarAttribute($value)
    {
        if (!present($value)) {
            return 'https://s.ppy.sh/images/blank.jpg';
        } else {
            $value = str_replace('_', '?', $value);

            return "https://a.ppy.sh/{$value}";
        }
    }

    public function getCountryAcronymAttribute($value)
    {
        return presence($value);
    }

    public function getUserFromAttribute($value)
    {
        return presence($value);
    }

    public function getIsSpecialAttribute()
    {
        return $this->user_id !== null && presence($this->user_colour) !== null;
    }

    public function getUserBirthdayAttribute($value)
    {
        if (presence($value) === null) {
            return;
        }

        $date = explode('-', $value);
        $date = array_map(function ($x) {
            return intval(trim($x));
        }, $date);
        if ($date[2] === 0) {
            return;
        }

        return Carbon::create($date[2], $date[1], $date[0]);
    }

    public function getAgeAttribute()
    {
        if ($this->user_birthday === null) {
            return;
        }

        return $this->user_birthday->age;
    }

    public function getUserTwitterAttribute($value)
    {
        return presence(ltrim($value, '@'));
    }

    public function getUserLastfmAttribute($value)
    {
        return presence($value);
    }

    public function getUserMsnmAttribute($value)
    {
        return presence($value);
    }

    public function getOsuPlaystyleAttribute($value)
    {
        $value = intval($value);

        $styles = [];

        $mappings = [
            'mouse' => 1,
            'keyboard' => 2,
            'tablet' => 4,
            'touch' => 8,
        ];

        foreach ($mappings as $type => $bit) {
            if (($value & $bit) !== 0) {
                $styles[] = $type;
            }
        }

        if (empty($styles)) {
            return;
        }

        return $styles;
    }

    // return a user's API details

    public function getApiDetails($user = null)
    {
        return $this->api;
    }

    public function getApiKey()
    {
        return $this->api->api_key;
    }

    public function setApiKey($key)
    {
        $this->api->api_key = $key;
        $this->api->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Modding System-specific functions.
    |--------------------------------------------------------------------------
    |
    | This checks to see if a user is in a specified group.
    | You should try to be specific and not use the UserGroup:: constants.
    |
    */

    public function ownsMod(Mod $mod)
    {
        return $this->user_id === $mod->user_id;
    }

    public function canEditMod(Mod $mod)
    {
        return $this->isDev()
            or $this->isAdmin()
            or $this->isGMT()
            or $this->isQAT()
            or $this->ownsMod($mod);
    }

    public function ownsSet(Beatmapset $set)
    {
        return $set->user_id === $this->user_id;
    }

    /*
    |--------------------------------------------------------------------------
    | Permission Checker Functions
    |--------------------------------------------------------------------------
    |
    | This checks to see if a user is in a specified group.
    | You should try to be specific.
    |
    */

    public function isQAT()
    {
        return $this->isGroup(UserGroup::GROUPS['qat']);
    }

    public function isAdmin()
    {
        return $this->isGroup(UserGroup::GROUPS['admin']);
    }

    public function isGMT()
    {
        return $this->isGroup(UserGroup::GROUPS['gmt']);
    }

    public function isBNG()
    {
        return $this->isGroup(UserGroup::GROUPS['bng']);
    }

    public function isHax()
    {
        return $this->isGroup(UserGroup::GROUPS['hax']);
    }

    public function isDev()
    {
        return $this->isGroup(UserGroup::GROUPS['dev']);
    }

    public function isMod()
    {
        return $this->isGroup(UserGroup::GROUPS['mod']);
    }

    public function isAlumni()
    {
        return $this->isGroup(UserGroup::GROUPS['alumni']);
    }

    public function isRegistered()
    {
        return $this->isGroup(UserGroup::GROUPS['default']);
    }

    public function hasSupported()
    {
        return $this->osu_subscriptionexpiry !== null;
    }

    public function isSupporter()
    {
        return $this->osu_subscriber === true;
    }

    public function isPrivileged()
    {
        return $this->isAdmin()
            || $this->isDev()
            || $this->isMod()
            || $this->isGMT()
            || $this->isBNG()
            || $this->isQAT();
    }

    public function isBanned()
    {
        return $this->user_type === 1;
    }

    public function isRestricted()
    {
        return $this->isBanned() || $this->user_warnings > 0;
    }

    public function isSilenced()
    {
        $lastBan = $this->banHistories()->bans()->first();

        $isSilenced = $lastBan !== null &&
            $lastBan->period !== 0 &&
            $lastBan->endTime()->isFuture();

        return $this->isRestricted() || $isSilenced;
    }

    public function groupIds()
    {
        if ($this->groupIds === null) {
            $this->groupIds = model_pluck($this->userGroups(), 'group_id');
        }

        return $this->groupIds;
    }

    // check if a user is in a specific group, by ID
    public function isGroup($group)
    {
        return in_array($group, $this->groupIds(), true);
    }

    /*
    |--------------------------------------------------------------------------
    | Entity relationship definitions
    |--------------------------------------------------------------------------
    |
    | These let you do magic. Example:
    | foreach ($user->mods as $mod) {
    | 	$response[] = $mod->toArray();
    | }
    | return Response::json($response);
    */

    public function userGroups()
    {
        return $this->hasMany(UserGroup::class);
    }

    public function beatmapsets()
    {
        return $this->hasMany(Beatmapset::class);
    }

    public function beatmaps()
    {
        return $this->hasManyThrough(Beatmap::class, Beatmapset::class, 'user_id', 'beatmapset_id');
    }

    public function favouriteBeatmapsets()
    {
        return Beatmapset::whereIn('beatmapset_id', FavouriteBeatmapset::where('user_id', '=', $this->user_id)->select('beatmapset_id')->get());
    }

    public function beatmapsetNominations()
    {
        return $this->hasMany(BeatmapsetEvent::class)->where('type', BeatmapsetEvent::NOMINATE);
    }

    public function beatmapsetNominationsToday()
    {
        return $this->beatmapsetNominations()->where('created_at', '>', Carbon::now()->subDay())->count();
    }

    public function beatmapPlaycounts()
    {
        return $this->hasMany(BeatmapPlaycount::class);
    }

    public function apiKey()
    {
        return $this->hasOne("App\Models\ApiKey", 'user_id');
    }

    public function slackUser()
    {
        return $this->hasOne(SlackUser::class, 'user_id');
    }

    //public function country() { return $this->hasOne("Country"); }

    public function storeAddresses()
    {
        return $this->hasMany("App\Models\Store\Address", 'user_id', 'user_id');
    }

    public function rank()
    {
        return $this->belongsTo("App\Models\Rank", 'user_rank', 'rank_id');
    }

    public function rankHistories()
    {
        return $this->hasMany(RankHistory::class);
    }

    public function country()
    {
        return $this->belongsTo("App\Models\Country", 'country_acronym', 'acronym');
    }

    public function statisticsOsu()
    {
        return $this->statistics('osu', true);
    }

    public function statisticsFruits()
    {
        return $this->statistics('fruits', true);
    }

    public function statisticsMania()
    {
        return $this->statistics('mania', true);
    }

    public function statisticsTaiko()
    {
        return $this->statistics('taiko', true);
    }

    public function statistics($mode, $returnQuery = false)
    {
        if (!in_array($mode, array_keys(Beatmap::MODES), true)) {
            return;
        }

        $mode = studly_case($mode);

        if ($returnQuery === true) {
            return $this->hasOne("App\Models\UserStatistics\\{$mode}", 'user_id', 'user_id');
        } else {
            $relation = "statistics{$mode}";

            return $this->$relation;
        }
    }

    public function scoresOsu()
    {
        return $this->scores('osu', true);
    }

    public function scoresFruits()
    {
        return $this->scores('fruits', true);
    }

    public function scoresMania()
    {
        return $this->scores('mania', true);
    }

    public function scoresTaiko()
    {
        return $this->scores('taiko', true);
    }

    public function scores($mode, $returnQuery = false)
    {
        if (!in_array($mode, array_keys(Beatmap::MODES), true)) {
            return;
        }

        $mode = studly_case($mode);

        if ($returnQuery === true) {
            return $this->hasMany("App\Models\Score\\{$mode}");
        } else {
            $relation = "scores{$mode}";

            return $this->$relation;
        }
    }

    public function scoresFirstOsu()
    {
        return $this->scoresFirst('osu', true);
    }

    public function scoresFirstFruits()
    {
        return $this->scoresFirst('fruits', true);
    }

    public function scoresFirstMania()
    {
        return $this->scoresFirst('mania', true);
    }

    public function scoresFirstTaiko()
    {
        return $this->scoresFirst('taiko', true);
    }

    public function scoresFirst($mode, $returnQuery = false)
    {
        if (!in_array($mode, array_keys(Beatmap::MODES), true)) {
            return;
        }

        $casedMode = studly_case($mode);

        if ($returnQuery === true) {
            $suffix = $mode === 'osu' ? '' : "_{$mode}";

            return $this->belongsToMany("App\Models\Score\Best\\{$casedMode}", "osu_leaders{$suffix}", 'user_id', 'score_id');
        } else {
            $relation = "scoresFirst{$casedMode}";

            return $this->$relation;
        }
    }

    public function scoresBestOsu()
    {
        return $this->scoresBest('osu', true);
    }

    public function scoresBestFruits()
    {
        return $this->scoresBest('fruits', true);
    }

    public function scoresBestMania()
    {
        return $this->scoresBest('mania', true);
    }

    public function scoresBestTaiko()
    {
        return $this->scoresBest('taiko', true);
    }

    public function scoresBest($mode, $returnQuery = false)
    {
        if (!in_array($mode, array_keys(Beatmap::MODES), true)) {
            return;
        }

        if ($returnQuery) {
            $mode = studly_case($mode);

            return $this->hasMany("App\Models\Score\Best\\{$mode}")->default();
        } else {
            $relation = camel_case("scores_best_{$mode}");

            return $this->$relation;
        }
    }

    public function profileCustomization()
    {
        return $this->hasOne("App\Models\UserProfileCustomization");
    }

    public function banHistories()
    {
        return $this->hasMany("App\Models\UserBanHistory", 'user_id', 'user_id');
    }

    public function userPage()
    {
        return $this->belongsTo("App\Models\Forum\Post", 'userpage_post_id', 'post_id');
    }

    public function userAchievements()
    {
        return $this->hasMany("App\Models\UserAchievement", 'user_id', 'user_id');
    }

    public function usernameChangeHistory()
    {
        return $this->hasMany(UsernameChangeHistory::class, 'user_id', 'user_id');
    }

    public function relations()
    {
        return $this->hasMany(UserRelation::class, 'user_id', 'user_id');
    }

    public function friends()
    {
        return $this->relations()->where('friend', true);
    }

    public function foes()
    {
        return $this->relations()->where('foe', true);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function beatmapsetRatings()
    {
        return $this->hasMany(BeatmapsetUserRating::class);
    }

    public function givenKudosu()
    {
        return $this->hasMany(KudosuHistory::class, 'giver_id', 'user_id');
    }

    public function receivedKudosu()
    {
        return $this->hasMany(KudosuHistory::class, 'receiver_id', 'user_id');
    }

    public function supports()
    {
        return $this->hasMany(UserDonation::class, 'target_user_id', 'user_id');
    }

    public function givenSupports()
    {
        return $this->hasMany(UserDonation::class, 'user_id', 'user_id');
    }

    public function forumPosts()
    {
        return $this->hasMany(Forum\Post::class, 'poster_id');
    }

    public function getPlaymodeAttribute($value)
    {
        return Beatmap::modeStr($this->osu_playmode);
    }

    public function setPlaymodeAttribute($value)
    {
        switch ($value) {
            case 'osu':
                $attribute = 0;
                break;
            case 'taiko':
                $attribute = 1;
                break;
            case 'fruits':
                $attribute = 2;
                break;
            case 'mania':
                $attribute = 3;
                break;
            default:
                return;
        }

        $this->osu_playmode = $attribute;
    }

    public function getOsuScoreAttribute($value)
    {
        return $this->getScore('osu_user_stats');
    }

    public function getFruitsScoreAttribute($value)
    {
        return $this->getScore('osu_user_stats_fruits');
    }

    public function getTaikoScoreAttribute($value)
    {
        return $this->getScore('osu_user_stats_taiko');
    }

    public function getManiaScoreAttribute($value)
    {
        return $this->getScore('osu_user_stats_mania');
    }

    public function flags()
    {
        if ($this->flags === null) {
            $this->flags = [];

            if ($this->country_acronym !== null) {
                $this->flags['country'] = [$this->country_acronym, $this->country->name];
            }
        }

        return $this->flags;
    }

    protected function getScore($table)
    {
        if (Cache::tags('score', $table)->has($this->user_id)) {
            return Cache::tags('score', $table)->get($this->user_id);
        }

        $row = DB::table($table)
            ->where('user_id', '=', $this->user_id)
            ->select('rank_score', 'rank_score_index', 'country_acronym', 'accuracy_new')
            ->first();

        if ($row) {
            $country = DB::table($table)
                ->where('country_acronym', '=', $row->country_acronym)
                ->where('rank_score', '>', $row->rank_score)
                ->select(DB::raw('count(*) + 1 as rank'))
                ->first();
        } else {
            $country = null;
        }

        // make a container for the score
        $value = new \stdClass();

        $value->rank = $row ? $row->rank_score_index : null;
        $value->pp = $row ? number_format($row->rank_score) : null;
        $value->accuracy = $row ? $row->accuracy_new : null;
        $value->country = $country ? $country->rank : null;

        Cache::tags('score', $table)->put($this->user_id, $value, 10);

        return $value;
    }

    public function title()
    {
        if ($this->rank === null) {
            return;
        }

        return $this->rank->rank_title;
    }

    public function hasProfile()
    {
        return
            $this->user_id !== null
            && !$this->isRestricted()
            && $this->group_id !== 6; // bots
    }

    public function countryName()
    {
        if (!isset($this->flags()['country'])) {
            return;
        }

        return $this->flags()['country'][1];
    }

    public function updatePage($text)
    {
        if ($this->userPage === null) {
            DB::transaction(function () use ($text) {
                $topic = Forum\Topic::createNew(
                    Forum\Forum::find(config('osu.user.user_page_forum_id')),
                    [
                        'title' => "{$this->username}'s user page",
                        'user' => $this,
                        'body' => $text,
                    ]
                );

                $this->update(['userpage_post_id' => $topic->topic_first_post_id]);
            });
        } else {
            $this->userPage->edit($text, $this);
        }

        return $this->fresh();
    }

    public function defaultJson()
    {
        return json_item(
            $this,
            new UserTransformer(),
            'userAchievements,defaultStatistics'
        );
    }

    public function supportLength()
    {
        if ($this->_supportLength === null) {
            $this->_supportLength = 0;

            foreach ($this->supports as $support) {
                if ($support->cancel === true) {
                    $this->_supportLength -= $support->length;
                } else {
                    $this->_supportLength += $support->length;
                }
            }
        }

        return $this->_supportLength;
    }

    public function supportLevel()
    {
        $length = $this->supportLength();

        if ($this->osu_subscriber === false) {
            return 0;
        }

        if ($length < 12) {
            return 1;
        }

        if ($length < 5 * 12) {
            return 2;
        }

        return 3;
    }

    public function refreshForumCache($forum = null, $postsChangeCount = 0)
    {
        if ($forum !== null) {
            if (Forum\Authorize::increasesPostsCount($this, $forum) !== true) {
                $postsChangeCount = 0;
            }

            // In case user_posts is 0 and $postsChangeCount is -1.
            $newPostsCount = DB::raw("GREATEST(CAST(user_posts AS SIGNED) + {$postsChangeCount}, 0)");
        } else {
            $newPostsCount = $this->forumPosts()->whereIn('forum_id', Forum\Authorize::postsCountedForums($this))->count();
        }

        $lastPost = $this->forumPosts()->last()->select('post_time')->first();

        // null time will be stored as 0 by the db. Nothing can be done about
        // it, short of changing the column to allow null.
        $lastPostTime = $lastPost !== null ? $lastPost->post_time : null;

        return $this->update([
            'user_posts' => $newPostsCount,
            'user_lastpost_time' => $lastPostTime,
        ]);
    }

    public function isSlackEligible()
    {
        $canInvite = $this->beatmapPlaycounts()->sum('playcount') > 100
            && $this->slackUser === null
            && $this->user_type !== self::ANONYMOUS
            && $this->user_warnings === 0
            && $this->banHistories()->where('timestamp', '>', Carbon::now()->subDays(28))
                ->where('ban_status', '=', 2)->count() === 0;

        return $canInvite;
    }

    public function sendMessage(User $sender, $body)
    {
        $message = new PrivateMessage();
        $message->user_id = $sender->user_id;
        $message->target_id = $this->user_id;
        $message->content = $body;
        $message->save();
    }

    public function scopeDefault($query)
    {
        return $query->where([
            'user_warnings' => 0,
            'user_type' => 0,
        ]);
    }
}
