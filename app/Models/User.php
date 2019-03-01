<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

use App\Exceptions\ChangeUsernameException;
use App\Exceptions\ModelNotSavedException;
use App\Libraries\BBCodeForDB;
use App\Libraries\ChangeUsername;
use App\Libraries\UsernameValidation;
use App\Traits\UserAvatar;
use App\Traits\Validatable;
use Cache;
use Carbon\Carbon;
use DB;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Exception;
use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\QueryException as QueryException;
use Laravel\Passport\HasApiTokens;
use Request;

/**
 * @property \Illuminate\Database\Eloquent\Collection $accountHistories UserAccountHistory
 * @property ApiKey $apiKey
 * @property \Illuminate\Database\Eloquent\Collection $badges UserBadge
 * @property \Illuminate\Database\Eloquent\Collection $beatmapDiscussionVotes BeatmapDiscussionVote
 * @property \Illuminate\Database\Eloquent\Collection $beatmapDiscussions BeatmapDiscussion
 * @property \Illuminate\Database\Eloquent\Collection $beatmapPlaycounts BeatmapPlaycount
 * @property \Illuminate\Database\Eloquent\Collection $beatmaps Beatmap
 * @property \Illuminate\Database\Eloquent\Collection $beatmapsetNominations BeatmapsetEvent
 * @property \Illuminate\Database\Eloquent\Collection $beatmapsetRatings BeatmapsetUserRating
 * @property \Illuminate\Database\Eloquent\Collection $beatmapsetWatches BeatmapsetWatch
 * @property \Illuminate\Database\Eloquent\Collection $beatmapsets Beatmapset
 * @property \Illuminate\Database\Eloquent\Collection $blocks static
 * @property \Illuminate\Database\Eloquent\Collection $changelogs Changelog
 * @property \Illuminate\Database\Eloquent\Collection $channels Chat\Channel
 * @property \Illuminate\Database\Eloquent\Collection $clients UserClient
 * @property Country $country
 * @property string $country_acronym
 * @property mixed $current_password
 * @property mixed $displayed_last_visit
 * @property \Illuminate\Database\Eloquent\Collection $events Event
 * @property \Illuminate\Database\Eloquent\Collection $favourites FavouriteBeatmapset
 * @property \Illuminate\Database\Eloquent\Collection $forumPosts Forum\Post
 * @property \Illuminate\Database\Eloquent\Collection $friends static
 * @property \Illuminate\Database\Eloquent\Collection $githubUsers GithubUser
 * @property \Illuminate\Database\Eloquent\Collection $givenKudosu KudosuHistory
 * @property int $group_id
 * @property mixed $hide_presence
 * @property \Illuminate\Database\Eloquent\Collection $monthlyPlaycounts UserMonthlyPlaycount
 * @property int $osu_featurevotes
 * @property int $osu_kudosavailable
 * @property int $osu_kudosdenied
 * @property int $osu_kudostotal
 * @property float $osu_mapperrank
 * @property int $osu_playmode
 * @property int $osu_playstyle
 * @property bool $osu_subscriber
 * @property \Carbon\Carbon|null $osu_subscriptionexpiry
 * @property int $osu_testversion
 * @property mixed $password
 * @property mixed $password_confirmation
 * @property mixed $playmode
 * @property mixed $pm_friends_only
 * @property \Illuminate\Database\Eloquent\Collection $profileBanners ProfileBanner
 * @property Rank $rank
 * @property \Illuminate\Database\Eloquent\Collection $rankHistories RankHistory
 * @property \Illuminate\Database\Eloquent\Collection $receivedKudosu KudosuHistory
 * @property \Illuminate\Database\Eloquent\Collection $relations UserRelation
 * @property string|null $remember_token
 * @property \Illuminate\Database\Eloquent\Collection $replaysWatchedCounts UserReplaysWatchedCount
 * @property UserReport $reportedIn
 * @property \Illuminate\Database\Eloquent\Collection $reportsMade UserReport
 * @property \Illuminate\Database\Eloquent\Collection $storeAddresses Store\Address
 * @property \Illuminate\Database\Eloquent\Collection $supporterTagPurchases UserDonation
 * @property \Illuminate\Database\Eloquent\Collection $supporterTags UserDonation
 * @property \Illuminate\Database\Eloquent\Collection $userAchievements UserAchievement
 * @property \Illuminate\Database\Eloquent\Collection $userGroups UserGroup
 * @property Forum\Post $userPage
 * @property UserProfileCustomization $userProfileCustomization
 * @property string $user_actkey
 * @property int $user_allow_massemail
 * @property bool $user_allow_pm
 * @property int $user_allow_viewemail
 * @property bool $user_allow_viewonline
 * @property string $user_avatar
 * @property int $user_avatar_height
 * @property int $user_avatar_type
 * @property int $user_avatar_width
 * @property string $user_birthday
 * @property string $user_colour
 * @property string $user_dateformat
 * @property mixed $user_discord
 * @property int $user_dst
 * @property string|null $user_email
 * @property mixed $user_email_confirmation
 * @property int $user_emailtime
 * @property string $user_from
 * @property int $user_full_folder
 * @property int $user_id
 * @property int $user_inactive_reason
 * @property int $user_inactive_time
 * @property string|null $user_interests
 * @property string $user_ip
 * @property string $user_jabber
 * @property string $user_lang
 * @property string $user_last_confirm_key
 * @property int $user_last_privmsg
 * @property int $user_last_search
 * @property int $user_last_warning
 * @property string $user_lastfm
 * @property string $user_lastfm_session
 * @property int $user_lastmark
 * @property string $user_lastpage
 * @property int $user_lastpost_time
 * @property int $user_lastvisit
 * @property int $user_login_attempts
 * @property int $user_message_rules
 * @property string $user_msnm
 * @property int $user_new_privmsg
 * @property string $user_newpasswd
 * @property int $user_notify
 * @property int $user_notify_pm
 * @property int $user_notify_type
 * @property string|null $user_occ
 * @property int $user_options
 * @property int $user_passchg
 * @property string $user_password
 * @property int|null $user_perm_from
 * @property mixed|null $user_permissions
 * @property int $user_post_show_days
 * @property string $user_post_sortby_dir
 * @property string $user_post_sortby_type
 * @property int $user_posts
 * @property int $user_rank
 * @property int $user_regdate
 * @property mixed $user_sig
 * @property string $user_sig_bbcode_bitfield
 * @property string $user_sig_bbcode_uid
 * @property int $user_style
 * @property float $user_timezone
 * @property int $user_topic_show_days
 * @property string $user_topic_sortby_dir
 * @property string $user_topic_sortby_type
 * @property string $user_twitter
 * @property int $user_type
 * @property int $user_unread_privmsg
 * @property int $user_warnings
 * @property string $user_website
 * @property string $username
 * @property \Illuminate\Database\Eloquent\Collection $usernameChangeHistory UsernameChangeHistory
 * @property string $username_clean
 * @property string|null $username_previous
 * @property int|null $userpage_post_id
 */
class User extends Model implements AuthenticatableContract
{
    use Elasticsearch\UserTrait, Store\UserTrait;
    use HasApiTokens, Authenticatable, Reportable, UserAvatar, UserScoreable, Validatable;

    protected $table = 'phpbb_users';
    protected $primaryKey = 'user_id';

    protected $dates = ['user_regdate', 'user_lastmark', 'user_lastvisit', 'user_lastpost_time'];
    protected $dateFormat = 'U';
    public $timestamps = false;

    protected $visible = ['user_id', 'username', 'username_clean', 'user_rank', 'osu_playstyle', 'user_colour'];

    protected $casts = [
        'osu_subscriber' => 'boolean',
        'user_allow_pm' => 'boolean',
        'user_allow_viewonline' => 'boolean',
        'user_timezone' => 'float',
    ];

    const PLAYSTYLES = [
        'mouse' => 1,
        'keyboard' => 2,
        'tablet' => 4,
        'touch' => 8,
    ];

    const CACHING = [
        'follower_count' => [
            'key' => 'followerCount',
            'duration' => 720, // 12 hours
        ],
    ];

    const INACTIVE_DAYS = 180;

    const MAX_FIELD_LENGTHS = [
        'user_msnm' => 255,
        'user_twitter' => 255,
        'user_website' => 200,
        'user_discord' => 37, // max 32char username + # + 4-digit discriminator
        'user_from' => 30,
        'user_occ' => 30,
        'user_interests' => 30,
    ];

    private $memoized = [];

    private $validateCurrentPassword = false;
    private $validatePasswordConfirmation = false;
    public $password = null;
    private $passwordConfirmation = null;
    private $currentPassword = null;

    private $emailConfirmation = null;
    private $validateEmailConfirmation = false;

    public function getAuthPassword()
    {
        return $this->user_password;
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

    public function revertUsername($type = 'revert') : UsernameChangeHistory
    {
        // TODO: normalize validation with changeUsername.
        if ($this->user_id <= 1) {
            throw new ChangeUsernameException('user_id is not valid');
        }

        if (!presence($this->username_previous)) {
            throw new ChangeUsernameException('username_previous is blank.');
        }

        return $this->updateUsername($this->username_previous, $type);
    }

    public function changeUsername(string $newUsername, string $type) : UsernameChangeHistory
    {
        $errors = $this->validateChangeUsername($newUsername);
        if ($errors->isAny()) {
            throw new ChangeUsernameException($errors);
        }

        return $this->getConnection()->transaction(function () use ($newUsername, $type) {
            static::findAndRenameUserForInactive($newUsername);

            return $this->updateUsername($newUsername, $type);
        });
    }

    public function renameIfInactive() : ?UsernameChangeHistory
    {
        if ($this->getUsernameAvailableAt() <= Carbon::now()) {
            $newUsername = "{$this->username}_old";

            return $this->tryUpdateUsername(0, $newUsername, 'inactive');
        }
    }

    private function tryUpdateUsername(int $try, string $newUsername, string $type) : UsernameChangeHistory
    {
        $name = $try > 0 ? "{$newUsername}_{$try}" : $newUsername;

        try {
            return $this->updateUsername($name, $type);
        } catch (QueryException $ex) {
            if (!is_sql_unique_exception($ex) || $try > 9) {
                throw $ex;
            }

            return $this->tryUpdateUsername($try + 1, $newUsername, $type);
        }
    }

    private function updateUsername(string $newUsername, string $type) : UsernameChangeHistory
    {
        $oldUsername = $type === 'revert' ? null : $this->getOriginal('username');
        $this->username_previous = $oldUsername;
        $this->username = $newUsername;

        return DB::transaction(function () use ($newUsername, $oldUsername, $type) {
            Forum\Forum::where('forum_last_poster_id', $this->user_id)->update(['forum_last_poster_name' => $newUsername]);
            // DB::table('phpbb_moderator_cache')->where('user_id', $this->user_id)->update(['username' => $newUsername]);
            Forum\Post::where('poster_id', $this->user_id)->update(['post_username' => $newUsername]);
            Forum\Topic::where('topic_poster', $this->user_id)
                ->update(['topic_first_poster_name' => $newUsername]);
            Forum\Topic::where('topic_last_poster_id', $this->user_id)
                ->update(['topic_last_poster_name' => $newUsername]);

            $history = $this->usernameChangeHistory()->create([
                'username' => $newUsername,
                'username_last' => $oldUsername,
                'timestamp' => Carbon::now(),
                'type' => $type,
            ]);

            if (!$history->exists) {
                throw new ModelNotSavedException('failed saving model');
            }

            $skipValidations = in_array($type, ['inactive', 'revert'], true);
            $this->saveOrExplode(['skipValidations' => $skipValidations]);

            return $history;
        });
    }

    public static function cleanUsername($username)
    {
        return strtolower($username);
    }

    public static function findAndRenameUserForInactive($username) : ?self
    {
        $existing = static::findByUsernameForInactive($username);
        if ($existing !== null) {
            $existing->renameIfInactive();
            // TODO: throw if expected rename doesn't happen?
        }

        return $existing;
    }

    // TODO: be able to change which connection this runs on?
    public static function findByUsernameForInactive($username) : ?self
    {
        return static::whereIn(
            'username',
            [str_replace(' ', '_', $username), str_replace('_', ' ', $username)]
        )->first();
    }

    public static function checkWhenUsernameAvailable($username) : Carbon
    {
        $user = static::findByUsernameForInactive($username);
        if ($user !== null) {
            return $user->getUsernameAvailableAt();
        }

        $lastUsage = UsernameChangeHistory::where('username_last', $username)
            ->where('type', '<>', 'inactive') // don't include changes caused by inactives; this validation needs to be removed on normal save.
            ->orderBy('change_id', 'desc')
            ->first();

        if ($lastUsage === null) {
            return Carbon::now();
        }

        return Carbon::parse($lastUsage->timestamp)->addDays(static::INACTIVE_DAYS);
    }

    public function getUsernameAvailableAt() : Carbon
    {
        if ($this->group_id !== 2 || $this->user_type === 1) {
            //reserved usernames
            return Carbon::now()->addYears(10);
        }

        $playCount = array_reduce(array_keys(Beatmap::MODES), function ($result, $mode) {
            return $result + $this->statistics($mode, true)->value('playcount');
        }, 0);

        return $this->user_lastvisit
            ->addDays(static::INACTIVE_DAYS) //base inactivity period for all accounts
            ->addDays($playCount * 0.75);    //bonus based on playcount
    }

    public function validateChangeUsername(string $username)
    {
        return (new ChangeUsername($this, $username))->validate();
    }

    // verify that an api key is correct
    public function verify($key)
    {
        return $this->api->api_key === $key;
    }

    public static function lookup($usernameOrId, $type = null, $findAll = false)
    {
        if (!present($usernameOrId)) {
            return;
        }

        switch ($type) {
            case 'string':
                $user = static::where(function ($query) use ($usernameOrId) {
                    $query->where('username', (string) $usernameOrId)->orWhere('username_clean', '=', (string) $usernameOrId);
                });
                break;

            case 'id':
                $user = static::where('user_id', $usernameOrId);
                break;

            default:
                if (ctype_digit((string) $usernameOrId)) {
                    $user = static::lookup($usernameOrId, 'id', $findAll);
                }

                return $user ?? static::lookup($usernameOrId, 'string', $findAll);
        }

        if (!$findAll) {
            $user->where('user_type', 0)->where('user_warnings', 0);
        }

        return $user->first();
    }

    public function getCountryAcronymAttribute($value)
    {
        return presence($value);
    }

    public function getUserFromAttribute($value)
    {
        return presence(html_entity_decode_better($value));
    }

    public function setUserFromAttribute($value)
    {
        $this->attributes['user_from'] = e($value);
    }

    public function getUserInterestsAttribute($value)
    {
        return presence(html_entity_decode_better($value));
    }

    public function setUserInterestsAttribute($value)
    {
        $this->attributes['user_interests'] = e($value);
    }

    public function getUserOccAttribute($value)
    {
        return presence(html_entity_decode_better($value));
    }

    public function setUserOccAttribute($value)
    {
        $this->attributes['user_occ'] = e($value);
    }

    public function setUserSigAttribute($value)
    {
        $bbcode = new BBCodeForDB($value);
        $this->attributes['user_sig'] = $bbcode->generate();
        $this->attributes['user_sig_bbcode_uid'] = $bbcode->uid;
    }

    public function getUserWebsiteAttribute($value)
    {
        $value = trim($value);

        if (present($value)) {
            if (starts_with($value, ['http://', 'https://'])) {
                return $value;
            }

            return "https://{$value}";
        }
    }

    public function setUserWebsiteAttribute($value)
    {
        // doubles as casting to empty string for not null constraint
        $value = trim($value);

        // FIXME: this can probably be removed after old site is deactivated
        //        as there's same check in getter function.
        if (present($value) && !starts_with($value, ['http://', 'https://'])) {
            $value = "https://{$value}";
        }

        $this->attributes['user_website'] = $value;
    }

    public function setOsuPlaystyleAttribute($value)
    {
        $styles = 0;

        foreach (self::PLAYSTYLES as $type => $bit) {
            if (in_array($type, $value, true)) {
                $styles += $bit;
            }
        }

        $this->attributes['osu_playstyle'] = $styles;
    }

    public function getPmFriendsOnlyAttribute()
    {
        return !$this->user_allow_pm;
    }

    public function setPmFriendsOnlyAttribute($value)
    {
        $this->user_allow_pm = !$value;
    }

    public function getHidePresenceAttribute()
    {
        return !$this->user_allow_viewonline;
    }

    public function setHidePresenceAttribute($value)
    {
        $this->user_allow_viewonline = !$value;
    }

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = $value;
        $this->username_clean = static::cleanUsername($value);
    }

    public function getDisplayedLastVisitAttribute()
    {
        return $this->hide_presence ? null : $this->user_lastvisit;
    }

    public function isSpecial()
    {
        return $this->user_id !== null && present($this->user_colour);
    }

    public function cover()
    {
        return $this->userProfileCustomization ? $this->userProfileCustomization->cover()->url() : null;
    }

    public function getUserTwitterAttribute($value)
    {
        return presence(ltrim($value, '@'));
    }

    public function getUserLastfmAttribute($value)
    {
        return presence($value);
    }

    public function getUserDiscordAttribute($value)
    {
        return presence($this->user_jabber);
    }

    public function getUserMsnmAttribute($value)
    {
        return presence($value);
    }

    public function getOsuPlaystyleAttribute($value)
    {
        $value = (int) $value;

        $styles = [];

        foreach (self::PLAYSTYLES as $type => $bit) {
            if (($value & $bit) !== 0) {
                $styles[] = $type;
            }
        }

        if (empty($styles)) {
            return;
        }

        return $styles;
    }

    public function getUserColourAttribute($value)
    {
        if (present($value)) {
            return "#{$value}";
        }
    }

    public function setUserDiscordAttribute($value)
    {
        $this->attributes['user_jabber'] = $value;
    }

    public function setUserColourAttribute($value)
    {
        // also functions for casting null to string
        $this->attributes['user_colour'] = ltrim($value, '#');
    }

    public function getOsuSubscriptionexpiryAttribute($value)
    {
        if (present($value)) {
            return Carbon::parse($value);
        }
    }

    public function setOsuSubscriptionexpiryAttribute($value)
    {
        // strip time component
        $this->attributes['osu_subscriptionexpiry'] = optional($value)->startOfDay();
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

    public function isBot()
    {
        return $this->group_id === UserGroup::GROUPS['bot'];
    }

    public function hasSupported()
    {
        return $this->osu_subscriptionexpiry !== null;
    }

    public function isSupporter()
    {
        return $this->osu_subscriber === true;
    }

    public function isActive()
    {
        return $this->user_lastvisit > Carbon::now()->subMonth();
    }

    public function isOnline()
    {
        return !$this->hide_presence
            && $this->user_lastvisit > Carbon::now()->subMinutes(config('osu.user.online_window'));
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

    public function isOld()
    {
        return preg_match('/_old(_\d+)?$/', $this->username) === 1;
    }

    public function isRestricted()
    {
        return $this->isBanned() || $this->user_warnings > 0;
    }

    public function isSilenced()
    {
        if (!array_key_exists(__FUNCTION__, $this->memoized)) {
            if ($this->isRestricted()) {
                return true;
            }

            $lastBan = $this->accountHistories()->bans()->first();

            $this->memoized[__FUNCTION__] = $lastBan !== null &&
                $lastBan->period !== 0 &&
                $lastBan->endTime()->isFuture();
        }

        return $this->memoized[__FUNCTION__];
    }

    /**
     * User group to be displayed in preference over other groups.
     *
     * @return string
     */
    public function defaultGroup()
    {
        if ($this->group_id === UserGroup::GROUPS['admin']) {
            return 'default';
        }

        return array_search_null($this->group_id, UserGroup::GROUPS) ?? 'default';
    }

    public function groupIds()
    {
        if (!array_key_exists(__FUNCTION__, $this->memoized)) {
            if (isset($this->relations['userGroups'])) {
                $this->memoized[__FUNCTION__] = $this->userGroups->pluck('group_id');
            } else {
                $this->memoized[__FUNCTION__] = model_pluck($this->userGroups(), 'group_id');
            }
        }

        return $this->memoized[__FUNCTION__];
    }

    // check if a user is in a specific group, by ID
    public function isGroup($group)
    {
        return in_array($group, $this->groupIds(), true);
    }

    public function badges()
    {
        return $this->hasMany(UserBadge::class, 'user_id');
    }

    public function githubUsers()
    {
        return $this->hasMany(GithubUser::class, 'user_id');
    }

    public function monthlyPlaycounts()
    {
        return $this->hasMany(UserMonthlyPlaycount::class, 'user_id');
    }

    public function replaysWatchedCounts()
    {
        return $this->hasMany(UserReplaysWatchedCount::class, 'user_id');
    }

    public function reportedIn()
    {
        return $this->morphMany(UserReport::class, 'reportable');
    }

    public function reportsMade()
    {
        return $this->hasMany(UserReport::class, 'reporter_id');
    }

    public function userGroups()
    {
        return $this->hasMany(UserGroup::class, 'user_id');
    }

    public function beatmapDiscussionVotes()
    {
        return $this->hasMany(BeatmapDiscussionVote::class, 'user_id');
    }

    public function beatmapDiscussions()
    {
        return $this->hasMany(BeatmapDiscussion::class, 'user_id');
    }

    public function beatmapsets()
    {
        return $this->hasMany(Beatmapset::class, 'user_id');
    }

    public function beatmapsetWatches()
    {
        return $this->hasMany(BeatmapsetWatch::class, 'user_id');
    }

    public function beatmaps()
    {
        return $this->hasManyThrough(Beatmap::class, Beatmapset::class, 'user_id');
    }

    public function clients()
    {
        return $this->hasMany(UserClient::class, 'user_id');
    }

    public function favourites()
    {
        return $this->hasMany(FavouriteBeatmapset::class, 'user_id');
    }

    public function favouriteBeatmapsets()
    {
        $favouritesTable = (new FavouriteBeatmapset)->getTable();
        $beatmapsetsTable = (new Beatmapset)->getTable();

        return Beatmapset::select("{$beatmapsetsTable}.*")
            ->join($favouritesTable, "{$favouritesTable}.beatmapset_id", '=', "{$beatmapsetsTable}.beatmapset_id")
            ->where("{$favouritesTable}.user_id", '=', $this->user_id)
            ->orderby("{$favouritesTable}.dateadded", 'desc');
    }

    public function beatmapsetNominations()
    {
        return $this->hasMany(BeatmapsetEvent::class, 'user_id')->where('type', BeatmapsetEvent::NOMINATE);
    }

    public function beatmapsetNominationsToday()
    {
        return $this->beatmapsetNominations()->where('created_at', '>', Carbon::now()->subDay())->count();
    }

    public function beatmapPlaycounts()
    {
        return $this->hasMany(BeatmapPlaycount::class, 'user_id');
    }

    public function apiKey()
    {
        return $this->hasOne(ApiKey::class, 'user_id');
    }

    public function profileBanners()
    {
        return $this->hasMany(ProfileBanner::class, 'user_id');
    }

    public function storeAddresses()
    {
        return $this->hasMany(Store\Address::class, 'user_id');
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'user_rank');
    }

    public function rankHistories()
    {
        return $this->hasMany(RankHistory::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_acronym');
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
            return $this->hasOne("App\Models\UserStatistics\\{$mode}", 'user_id');
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
            return $this->hasMany("App\Models\Score\\{$mode}", 'user_id')->default();
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

            return $this->belongsToMany("App\Models\Score\Best\\{$casedMode}", "osu_leaders{$suffix}", 'user_id', 'score_id')->default();
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

        $mode = studly_case($mode);

        if ($returnQuery === true) {
            return $this->hasMany("App\Models\Score\Best\\{$mode}", 'user_id')->default();
        } else {
            $relation = "scoresBest{$mode}";

            return $this->$relation;
        }
    }

    public function userProfileCustomization()
    {
        return $this->hasOne(UserProfileCustomization::class, 'user_id');
    }

    public function accountHistories()
    {
        return $this->hasMany(UserAccountHistory::class, 'user_id');
    }

    public function userPage()
    {
        return $this->belongsTo(Forum\Post::class, 'userpage_post_id');
    }

    public function userAchievements()
    {
        return $this->hasMany(UserAchievement::class, 'user_id');
    }

    public function usernameChangeHistory()
    {
        return $this->hasMany(UsernameChangeHistory::class, 'user_id');
    }

    public function relations()
    {
        return $this->hasMany(UserRelation::class, 'user_id');
    }

    public function blocks()
    {
        return $this->belongsToMany(static::class, 'phpbb_zebra', 'user_id', 'zebra_id')->wherePivot('foe', true);
    }

    public function friends()
    {
        return $this->belongsToMany(static::class, 'phpbb_zebra', 'user_id', 'zebra_id')->wherePivot('friend', true);
    }

    public function channels()
    {
        return $this->hasManyThrough(
            Chat\Channel::class,
            Chat\UserChannel::class,
            'user_id',
            'channel_id',
            'user_id',
            'channel_id'
        );
    }

    public function maxBlocks()
    {
        return ceil($this->maxFriends() / 10);
    }

    public function maxFriends()
    {
        return $this->isSupporter() ? config('osu.user.max_friends_supporter') : config('osu.user.max_friends');
    }

    public function maxMultiplayerRooms()
    {
        return $this->isSupporter() ? config('osu.user.max_multiplayer_rooms_supporter') : config('osu.user.max_multiplayer_rooms');
    }

    public function beatmapsetDownloadAllowance()
    {
        return $this->isSupporter() ? config('osu.beatmapset.download_limit_supporter') : config('osu.beatmapset.download_limit');
    }

    public function beatmapsetFavouriteAllowance()
    {
        return $this->isSupporter() ? config('osu.beatmapset.favourite_limit_supporter') : config('osu.beatmapset.favourite_limit');
    }

    public function uncachedFollowerCount()
    {
        return UserRelation::where('zebra_id', $this->user_id)->where('friend', 1)->count();
    }

    public function cacheFollowerCount()
    {
        $count = $this->uncachedFollowerCount();

        Cache::put(
            self::CACHING['follower_count']['key'].':'.$this->user_id,
            $count,
            self::CACHING['follower_count']['duration']
        );

        return $count;
    }

    public function followerCount()
    {
        return get_int(Cache::get(self::CACHING['follower_count']['key'].':'.$this->user_id)) ?? $this->cacheFollowerCount();
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    public function beatmapsetRatings()
    {
        return $this->hasMany(BeatmapsetUserRating::class, 'user_id');
    }

    public function givenKudosu()
    {
        return $this->hasMany(KudosuHistory::class, 'giver_id');
    }

    public function receivedKudosu()
    {
        return $this->hasMany(KudosuHistory::class, 'receiver_id');
    }

    public function supporterTags()
    {
        return $this->hasMany(UserDonation::class, 'target_user_id');
    }

    public function supporterTagPurchases()
    {
        return $this->hasMany(UserDonation::class, 'user_id');
    }

    public function forumPosts()
    {
        return $this->hasMany(Forum\Post::class, 'poster_id');
    }

    public function changelogs()
    {
        return $this->hasMany(Changelog::class, 'user_id');
    }

    public function getPlaymodeAttribute($value)
    {
        return Beatmap::modeStr($this->osu_playmode);
    }

    public function setPlaymodeAttribute($value)
    {
        $this->osu_playmode = Beatmap::modeInt($value);
    }

    public function hasBlocked(self $user)
    {
        if (!array_key_exists('blocks', $this->memoized)) {
            $this->memoized['blocks'] = $this->blocks;
        }

        return $this->memoized['blocks']->where('user_id', $user->user_id)->count() > 0;
    }

    public function hasFriended(self $user)
    {
        if (!array_key_exists('friends', $this->memoized)) {
            $this->memoized['friends'] = $this->friends;
        }

        return $this->memoized['friends']->where('user_id', $user->user_id)->count() > 0;
    }

    public function hasFavourited($beatmapset)
    {
        return $this->favourites->contains('beatmapset_id', $beatmapset->getKey());
    }

    public function remainingHype()
    {
        if (!array_key_exists(__FUNCTION__, $this->memoized)) {
            $hyped = $this
                ->beatmapDiscussions()
                ->withoutTrashed()
                ->ofType('hype')
                ->where('created_at', '>', Carbon::now()->subWeek())
                ->count();

            $this->memoized[__FUNCTION__] = config('osu.beatmapset.user_weekly_hype') - $hyped;
        }

        return $this->memoized[__FUNCTION__];
    }

    public function newHypeTime()
    {
        if (!array_key_exists(__FUNCTION__, $this->memoized)) {
            $earliestWeeklyHype = $this
                ->beatmapDiscussions()
                ->withoutTrashed()
                ->ofType('hype')
                ->where('created_at', '>', Carbon::now()->subWeek())
                ->orderBy('created_at')
                ->first();

            $this->memoized[__FUNCTION__] = $earliestWeeklyHype === null ? null : $earliestWeeklyHype->created_at->addWeek();
        }

        return $this->memoized[__FUNCTION__];
    }

    public function flags()
    {
        if (!array_key_exists(__FUNCTION__, $this->memoized)) {
            $flags = [];

            if ($this->country_acronym !== null) {
                $flags['country'] = [$this->country_acronym, $this->country->name];
            }

            $this->memoized[__FUNCTION__] = $flags;
        }

        return $this->memoized[__FUNCTION__];
    }

    public function title()
    {
        if (!array_key_exists(__FUNCTION__, $this->memoized)) {
            if ($this->user_rank !== 0 && $this->user_rank !== null) {
                $title = $this->rank->rank_title;
            }

            $this->memoized[__FUNCTION__] = $title ?? null;
        }

        return $this->memoized[__FUNCTION__];
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
            $this
                ->userPage
                ->skipBodyPresenceCheck()
                ->update([
                    'post_text' => $text,
                    'post_edit_user' => $this->getKey(),
                ]);

            if ($this->userPage->validationErrors()->isAny()) {
                throw new ModelNotSavedException($this->userPage->validationErrors()->toSentence());
            }
        }

        return $this->fresh();
    }

    public function notificationCount()
    {
        return $this->user_unread_privmsg;
    }

    // TODO: we should rename this to currentUserJson or something.
    public function defaultJson()
    {
        return json_item($this, 'User', ['blocks', 'friends', 'is_admin']);
    }

    public function supportLength()
    {
        if (!array_key_exists(__FUNCTION__, $this->memoized)) {
            $supportLength = 0;

            foreach ($this->supporterTags as $support) {
                if ($support->cancel === true) {
                    $supportLength -= $support->length;
                } else {
                    $supportLength += $support->length;
                }
            }

            $this->memoized[__FUNCTION__] = $supportLength;
        }

        return $this->memoized[__FUNCTION__];
    }

    public function supportLevel()
    {
        if ($this->osu_subscriber === false) {
            return 0;
        }

        $length = $this->supportLength();

        if ($length < 12) {
            return 1;
        }

        if ($length < 5 * 12) {
            return 2;
        }

        return 3;
    }

    /**
     * Recommended star difficulty.
     *
     * @param string $mode one of Beatmap::MODES
     *
     * @return float
     */
    public function recommendedStarDifficulty(string $mode)
    {
        $stats = $this->statistics($mode);
        if ($stats) {
            return pow($stats->rank_score, 0.4) * 0.195;
        }

        return 0.0;
    }

    public function refreshForumCache($forum = null, $postsChangeCount = 0)
    {
        if ($forum !== null) {
            if (Forum\Authorize::increasesPostsCount($this, $forum) !== true) {
                $postsChangeCount = 0;
            }

            $newPostsCount = db_unsigned_increment('user_posts', $postsChangeCount);
        } else {
            $newPostsCount = $this->forumPosts()->whereIn('forum_id', Forum\Authorize::postsCountedForums($this))->count();
        }

        $lastPost = $this->forumPosts()->select('post_time')->last();

        // FIXME: not null column, hence default 0. Change column to allow null
        $lastPostTime = $lastPost !== null ? $lastPost->post_time : 0;

        return $this->update([
            'user_posts' => $newPostsCount,
            'user_lastpost_time' => $lastPostTime,
        ]);
    }

    public function scopeDefault($query)
    {
        return $query->where([
            'user_warnings' => 0,
            'user_type' => 0,
        ]);
    }

    public function scopeOnline($query)
    {
        return $query
            ->where('user_allow_viewonline', true)
            ->whereRaw('user_lastvisit > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL '.config('osu.user.online_window').' MINUTE))');
    }

    public function checkPassword($password)
    {
        return Hash::check($password, $this->getAuthPassword());
    }

    public function validatePasswordConfirmation()
    {
        $this->validatePasswordConfirmation = true;

        return $this;
    }

    public function setPasswordConfirmationAttribute($value)
    {
        $this->passwordConfirmation = $value;
    }

    public function setPasswordAttribute($value)
    {
        // actual user_password assignment is after validation
        $this->password = $value;
    }

    public function validateCurrentPassword()
    {
        $this->validateCurrentPassword = true;

        return $this;
    }

    public function setCurrentPasswordAttribute($value)
    {
        $this->currentPassword = $value;
    }

    public function validateEmailConfirmation()
    {
        $this->validateEmailConfirmation = true;

        return $this;
    }

    public function setUserEmailConfirmationAttribute($value)
    {
        $this->emailConfirmation = $value;
    }

    public static function attemptLogin($user, $password, $ip = null)
    {
        $ip = $ip ?? Request::getClientIp() ?? '0.0.0.0';

        if (LoginAttempt::isLocked($ip)) {
            return trans('users.login.locked_ip');
        }

        $validAuth = $user === null
            ? false
            : $user->checkPassword($password);

        if (!$validAuth) {
            LoginAttempt::failedAttempt($ip, $user);

            return trans('users.login.failed');
        }
    }

    public static function findForLogin($username)
    {
        return static::where('username', $username)
            ->orWhere('user_email', '=', strtolower($username))
            ->first();
    }

    public static function findForPassport($username)
    {
        return static::findForLogin($username);
    }

    public function validateForPassportPasswordGrant($password)
    {
        return static::attemptLogin($this, $password) === null;
    }

    public function profileCustomization()
    {
        if (!array_key_exists(__FUNCTION__, $this->memoized)) {
            try {
                $this->memoized[__FUNCTION__] = $this
                    ->userProfileCustomization()
                    ->firstOrCreate([]);
            } catch (Exception $ex) {
                if (is_sql_unique_exception($ex)) {
                    // retry on duplicate
                    return $this->profileCustomization();
                }

                throw $ex;
            }
        }

        return $this->memoized[__FUNCTION__];
    }

    public function profileBeatmapsetsRankedAndApproved()
    {
        return $this->beatmapsets()
            ->rankedOrApproved()
            ->active()
            ->with('beatmaps');
    }

    public function profileBeatmapsetsFavourite()
    {
        return $this->favouriteBeatmapsets()
            ->active()
            ->with('beatmaps');
    }

    public function profileBeatmapsetsUnranked()
    {
        return $this->beatmapsets()
            ->unranked()
            ->active()
            ->with('beatmaps');
    }

    public function profileBeatmapsetsGraveyard()
    {
        return $this->beatmapsets()
            ->graveyard()
            ->active()
            ->with('beatmaps');
    }

    public function profileBeatmapsetsLoved()
    {
        return $this->beatmapsets()
            ->loved()
            ->active()
            ->with('beatmaps');
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if ($this->isDirty('username')) {
            $errors = UsernameValidation::validateUsername($this->username);

            if ($errors->isAny()) {
                $this->validationErrors()->merge($errors);
            }
        }

        if ($this->validateCurrentPassword) {
            if (!$this->checkPassword($this->currentPassword)) {
                $this->validationErrors()->add('current_password', '.wrong_current_password');
            }
        }

        if ($this->validatePasswordConfirmation) {
            if ($this->password !== $this->passwordConfirmation) {
                $this->validationErrors()->add('password_confirmation', '.wrong_password_confirmation');
            }
        }

        if (present($this->password)) {
            if (present($this->username)) {
                if (strpos(strtolower($this->password), strtolower($this->username)) !== false) {
                    $this->validationErrors()->add('password', '.contains_username');
                }
            }

            if (strlen($this->password) < 8) {
                $this->validationErrors()->add('password', '.too_short');
            }

            if (WeakPassword::check($this->password)) {
                $this->validationErrors()->add('password', '.weak');
            }

            if ($this->validationErrors()->isEmpty()) {
                $this->user_password = Hash::make($this->password);
            }
        }

        if ($this->validateEmailConfirmation) {
            if ($this->user_email !== $this->emailConfirmation) {
                $this->validationErrors()->add('user_email_confirmation', '.wrong_email_confirmation');
            }
        }

        if ($this->isDirty('user_email') && present($this->user_email)) {
            $emailValidator = new EmailValidator;
            if (!$emailValidator->isValid($this->user_email, new RFCValidation)) {
                $this->validationErrors()->add('user_email', '.invalid_email');
            }

            if (static::where('user_id', '<>', $this->getKey())->where('user_email', '=', $this->user_email)->exists()) {
                $this->validationErrors()->add('user_email', '.email_already_used');
            }
        }

        if ($this->isDirty('country_acronym') && present($this->country_acronym)) {
            if (($country = Country::find($this->country_acronym)) !== null) {
                // ensure matching case
                $this->country_acronym = $country->getKey();
            } else {
                $this->validationErrors()->add('country', '.invalid_country');
            }
        }

        // user_discord is an accessor for user_jabber
        if ($this->isDirty('user_jabber') && present($this->user_discord)) {
            // This is a basic check and not 100% compliant to Discord's spec, only validates that input:
            // - is a 2-32 char username (excluding chars @#:)
            // - ends with a # and 4-digit discriminator
            if (!preg_match('/^[^@#:]{2,32}#\d{4}$/i', $this->user_discord)) {
                $this->validationErrors()->add('user_discord', '.invalid_discord');
            }
        }

        foreach (self::MAX_FIELD_LENGTHS as $field => $limit) {
            if ($this->isDirty($field)) {
                $val = $this->$field;
                if ($val && mb_strlen($val) > $limit) {
                    $this->validationErrors()->add($field, '.too_long', ['limit' => $limit]);
                }
            }
        }

        return $this->validationErrors()->isEmpty();
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'user';
    }

    public function save(array $options = [])
    {
        if ($options['skipValidations'] ?? false) {
            return parent::save($options);
        }

        return $this->isValid() && parent::save($options);
    }

    protected function newReportableExtraParams() : array
    {
        return [
            'user_id' => $this->getKey(),
        ];
    }
}
