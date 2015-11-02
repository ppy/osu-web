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

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'phpbb_users';
    protected $primaryKey = 'user_id';
    protected $guarded = [];

    protected $dates = ['user_regdate', 'user_lastvisit', 'user_lastpost_time'];
    protected $dateFormat = 'U';
    public $timestamps = false;

    protected $visible = ['user_id', 'username', 'username_clean', 'user_rank', 'osu_playstyle', 'user_colour', 'is_admin'];

    protected $appends = ['is_admin'];

    protected $casts = [
        'group_id' => 'integer',
        'osu_kudosavailable' => 'integer',
        'osu_kudostotal' => 'integer',
        'osu_subscriber' => 'boolean',
        'user_id' => 'integer',
        'user_type' => 'integer',
        'user_warnings' => 'integer',
    ];

    public $flags;
    private $group_ids;

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

        $playCount = array_reduce($user->statisticsAll(true), function ($result, $stats) {
                return $result + $stats->value('playcount');
            }, 0);

        return $user->user_lastvisit
            ->addMonths(6)                 //base inactivity period for all accounts
            ->addDays($playCount * 0.75);  //bonus based on playcount
    }

    public static function validateUsername($username)
    {
        if ($username != trim($username)) {
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

        foreach (DB::table('phpbb_disallow')->lists('disallow_username') as $check) {
            if (preg_match('#^'.str_replace('%', '.*?', preg_quote($check, '#')).'$#i', $username)) {
                return ['This username choice is not allowed.'];
            }
        }

        if (($availableDate = self::checkWhenUsernameAvailable($username)) > Carbon::now()) {
            $remainingDays = max(1, Carbon::now()->diffInDays($availableDate, false));

            if ($remainingDays > 365 * 3) {
                //no need to mention the inactivity period of the account is actively in use.
                return ['Username is already in use!'];
            } else {
                return ["This username will be available for use in <strong>{$remainingDays}</strong> more days."];
            }
        }

        return [];
    }

    public function validateUsernameChangeTo($username)
    {
        if (!$this->hasSupported()) {
            return ["You must have <a href='http://osu.ppy.sh/p/support'>supported osu!</a> to change your name!"];
        }

        if ($username == $this->username) {
            return ['This is already your username, silly!'];
        }

        return self::validateUsername($username);
    }

    // verifies that a user is valid (makes code neater)

    public static function validate($user)
    {
        try {
            $user = static::findOrFail($user);

            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    // verify that an api key is correct

    public function verify($key)
    {
        return $this->api->api_key === $key;
    }

    public function getUserAvatarAttribute($value)
    {
        if ($value === null || $value === '') {
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

    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
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

    // find a user by their api key
    // usage: User::findByKey($key);

    public static function findByKey($key)
    {
        $user_id = Api::where('api_key', $key)->value('user_id');

        if ($user_id === null) {
            return;
        }

        return static::find($user_id);
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
            or $this->isBAT()
            or $this->ownsMod($mod);
    }

    public function ownsSet(BeatmapSet $set)
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

    public function isBAT()
    {
        return $this->isGroup(UserGroup::BAT);
    }

    public function isAdmin()
    {
        return $this->isGroup(UserGroup::ADMIN);
    }

    public function isGMT()
    {
        return $this->isGroup(UserGroup::GMT);
    }

    public function isMAT()
    {
        return $this->isGroup(UserGroup::MAT);
    }

    public function isHax()
    {
        return $this->isGroup(UserGroup::HAX);
    }

    public function isDev()
    {
        return $this->isGroup(UserGroup::DEV);
    }

    public function isMod()
    {
        return $this->isGroup(UserGroup::MOD);
    }

    public function isAlumni()
    {
        return $this->isGroup(UserGroup::ALUMNI);
    }

    public function isRegistered()
    {
        return $this->isGroup(UserGroup::REGULAR);
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
            or $this->isDev();
            //or $this->isSupporter()
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

        return $lastBan !== null &&
            $lastBan->period !== 0 &&
            $lastBan->endTime()->isFuture();
    }

    // check if a user is in a specific group, by ID

    public function isGroup($group)
    {
        if ($this->group_ids === null) {
            $this->group_ids = array_pluck($this->userGroups()->get(['group_id'])->toArray(), 'group_id');
        }

        return in_array($group, $this->group_ids, true);
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

    public function notifications()
    {
        return $this->hasMany("App\Models\Notification", 'user_id', 'user_id');
    }

    public function sets()
    {
        return $this->hasMany("App\Models\Set", 'user_id', 'user_id');
    }

    public function beatmaps()
    {
        return $this->hasManyThrough("App\Models\Beatmap", 'Set');
    }

    public function posts()
    {
        return $this->hasMany("App\Models\Post", 'user_id', 'user_id');
    }

    public function mods()
    {
        return $this->hasMany("App\Models\Mod", 'user_id', 'user_id');
    }

    public function api()
    {
        return $this->hasOne("App\Models\Api", 'user_id', 'user_id');
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

    public function country()
    {
        return $this->belongsTo("App\Models\Country", 'country_acronym', 'acronym');
    }

    public function statisticsOsu()
    {
        return $this->hasOne("App\Models\UserStatistics\Osu", 'user_id', 'user_id');
    }

    public function statisticsCtb()
    {
        return $this->hasOne("App\Models\UserStatistics\Ctb", 'user_id', 'user_id');
    }

    public function statisticsMania()
    {
        return $this->hasOne("App\Models\UserStatistics\Mania", 'user_id', 'user_id');
    }

    public function statisticsTaiko()
    {
        return $this->hasOne("App\Models\UserStatistics\Taiko", 'user_id', 'user_id');
    }

    public function statistics($mode, $returnQuery = false)
    {
        if (!in_array($mode, ['osu', 'ctb', 'mania', 'taiko'], true)) {
            return;
        }

        $relation = camel_case("statistics_{$mode}");
        if ($returnQuery) {
            return $this->{$relation}();
        } else {
            return $this->$relation;
        }
    }

    public function statisticsAll($returnQuery = false)
    {
        $all = [];
        foreach (['osu', 'ctb', 'mania', 'taiko'] as $mode) {
            $all[$mode] = $this->statistics($mode, $returnQuery);
        }

        return $all;
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

    public function achievements()
    {
        return $this->hasMany("App\Models\UserAchievement", 'user_id', 'user_id');
    }

    public function usernameChangeHistory()
    {
        return $this->hasMany(UsernameChangeHistory::class, 'user_id', 'user_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'user_id', 'user_id');
    }

    public function givenKudosu()
    {
        return $this->hasMany(KudosuHistory::class, 'giver_id', 'user_id');
    }

    public function receivedKudosu()
    {
        return $this->hasMany(KudosuHistory::class, 'receiver_id', 'user_id');
    }

    public function getPlaymodeAttribute($value)
    {
        return play_mode_string($this->osu_playmode);
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
            case 'ctb':
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

    public function getCtbScoreAttribute($value)
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
                    "{$this->username}'s user page",
                    $this,
                    $text,
                    false
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
        return fractal_item_array(
            $this,
            new UserTransformer(),
            'defaultStatistics'
        );
    }
}
