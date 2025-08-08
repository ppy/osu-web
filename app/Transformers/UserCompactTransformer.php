<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Libraries\MorphMap;
use App\Libraries\Search\ScoreSearchParams;
use App\Libraries\User\SeasonStats;
use App\Models\Beatmap;
use App\Models\Season;
use App\Models\User;
use App\Models\UserProfileCustomization;
use Illuminate\Support\Arr;
use League\Fractal\Resource\Primitive;
use League\Fractal\Resource\ResourceInterface;

class UserCompactTransformer extends TransformerAbstract
{
    const CARD_INCLUDES = [
        'country',
        'cover',
        'groups',
        'team',
    ];

    const CARD_INCLUDES_PRELOAD = [
        'team',
        'userGroups',
    ];

    // Paired with static::listIncludesPreload
    const LIST_INCLUDES = [
        ...self::CARD_INCLUDES,
        'statistics',
        'support_level',
    ];

    const PROFILE_HEADER_INCLUDES = [
        'active_tournament_banner',
        'active_tournament_banners',
        'badges',
        'comments_count',
        'follower_count',
        'groups',
        'mapping_follower_count',
        'previous_usernames',
        'support_level',
    ];

    protected string $mode;

    protected array $availableIncludes = [
        'account_history',
        'active_tournament_banner', // deprecated
        'active_tournament_banners',
        'badges',
        'beatmap_playcounts_count',
        'blocks',
        'comments_count',
        'country',
        'cover',
        'current_season_stats',
        'daily_challenge_user_stats',
        'favourite_beatmapset_count',
        'follow_user_mapping',
        'follower_count',
        'friends',
        'graveyard_beatmapset_count',
        'groups',
        'guest_beatmapset_count',
        'is_admin',
        'is_bng',
        'is_full_bn',
        'is_gmt',
        'is_limited_bn',
        'is_moderator',
        'is_nat',
        'is_restricted',
        'is_silenced',
        'kudosu',
        'loved_beatmapset_count',
        'mapping_follower_count',
        'monthly_playcounts',
        'nominated_beatmapset_count',
        'page',
        'pending_beatmapset_count',
        'previous_usernames',
        'rank_highest',
        'ranked_beatmapset_count',
        'replays_watched_counts',
        'scores_best_count',
        'scores_first_count',
        'scores_pinned_count',
        'scores_recent_count',
        'session_verified',
        'statistics',
        'statistics_rulesets',
        'support_level',
        'team',
        'unread_pm_count',
        'user_achievements',
        'user_preferences',

        // TODO: should be alphabetically ordered but lazer relies on being after statistics.
        'rank_history',
    ];

    protected $permissions = [
        'friends' => 'IsNotOAuth',
        'is_admin' => 'IsNotOAuth',
        'is_bng' => 'IsNotOAuth',
        'is_full_bn' => 'IsNotOAuth',
        'is_gmt' => 'IsNotOAuth',
        'is_limited_bn' => 'IsNotOAuth',
        'is_moderator' => 'IsNotOAuth',
        'is_nat' => 'IsNotOAuth',
        'is_restricted' => 'UserShowRestrictedStatus',
        'is_silenced' => 'IsNotOAuth',
    ];

    public static function listIncludesPreload(string $rulesetName): array
    {
        return [
            ...static::CARD_INCLUDES_PRELOAD,
            User::statisticsRelationName($rulesetName),
            'supporterTagPurchases',
        ];
    }

    public function transform(User $user)
    {
        return [
            'avatar_url' => $user->user_avatar,
            'country_code' => $user->country_acronym,
            'default_group' => $user->defaultGroup()->identifier,
            'id' => $user->user_id,
            'is_active' => $user->isActive(),
            'is_bot' => $user->isBot(),
            'is_deleted' => $user->trashed(),
            'is_online' => $user->isOnline(),
            'is_supporter' => $user->isSupporter(),
            'last_visit' => json_time($user->displayed_last_visit),
            'pm_friends_only' => $user->pm_friends_only,
            'profile_colour' => $user->user_colour,
            'username' => $user->username,
        ];
    }

    public function includeAccountHistory(User $user)
    {
        $histories = $user->accountHistories()->recent();

        if (!priv_check('UserSilenceShowExtendedInfo')->can()) {
            $histories->default();
        } else {
            $histories->with('actor');
        }

        return $this->collection(
            $histories->get(),
            new UserAccountHistoryTransformer()
        );
    }

    public function includeActiveTournamentBanner(User $user)
    {
        $banner = $user->profileBannersActive->last();

        return $banner === null
            ? $this->primitive(null)
            : $this->item($banner, new ProfileBannerTransformer());
    }

    public function includeActiveTournamentBanners(User $user)
    {
        return $this->collection(
            $user->profileBannersActive,
            new ProfileBannerTransformer(),
        );
    }

    public function includeBadges(User $user)
    {
        return $this->collection(
            $user->badges()->orderBy('awarded', 'DESC')->get(),
            new UserBadgeTransformer()
        );
    }

    public function includeBeatmapPlaycountsCount(User $user)
    {
        return $this->primitive($user->beatmapPlaycounts()->count());
    }

    public function includeBlocks(User $user)
    {
        return $this->collection(
            $user->relations()->blocks()->get(),
            new UserRelationTransformer()
        );
    }

    public function includeCommentsCount(User $user)
    {
        return $this->primitive($user->comments()->withoutTrashed()->count());
    }

    public function includeCountry(User $user)
    {
        $countryAcronym = $user->country_acronym;
        $country = $countryAcronym === null
            ? null
            : app('countries')->byCode($countryAcronym);

        return $country === null
            ? $this->primitive(null)
            : $this->item($country, new CountryTransformer());
    }

    public function includeCover(User $user)
    {
        $cover = $user->cover();

        return $this->primitive([
            'custom_url' => $cover->customUrl(),
            'url' => $cover->url(),
            // cast to string for backward compatibility
            'id' => get_string($user->cover_preset_id),
        ]);
    }

    public function includeCurrentSeasonStats(User $user): Primitive
    {
        $season = Season::active()
            ->where('ruleset_id', Beatmap::modeInt($this->mode))
            ->first();

        return $season === null
            ? $this->primitive(null)
            : $this->primitive((new SeasonStats($user, $season))->get());
    }

    public function includeDailyChallengeUserStats(User $user)
    {
        return $this->item(
            $user->dailyChallengeUserStats ?? $user->dailyChallengeUserStats()->make(),
            new DailyChallengeUserStatsTransformer(),
        );
    }

    public function includeFavouriteBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetsFavourite()->count());
    }

    public function includeFollowUserMapping(User $user)
    {
        return $this->primitive(
            $user->follows()->where([
                'notifiable_type' => MorphMap::getType($user),
                'subtype' => 'mapping',
            ])->pluck('notifiable_id')
        );
    }

    public function includeFollowerCount(User $user)
    {
        return $this->primitive($user->followerCount());
    }

    public function includeFriends(User $user)
    {
        return $this->collection(
            $user->relationFriends,
            new UserRelationTransformer()
        );
    }

    public function includeGraveyardBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetCountByGroupedStatus('graveyard'));
    }

    public function includeGroups(User $user)
    {
        return $this->collection($user->userGroupsForBadges(), new UserGroupTransformer());
    }

    public function includeGuestBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetsGuest()->count());
    }

    public function includeIsAdmin(User $user)
    {
        return $this->primitive($user->isAdmin());
    }

    public function includeIsBng(User $user)
    {
        return $this->primitive($user->isBNG());
    }

    public function includeIsFullBn(User $user)
    {
        return $this->primitive($user->isFullBN());
    }

    public function includeIsGmt(User $user)
    {
        return $this->primitive($user->isGMT());
    }

    public function includeIsLimitedBn(User $user)
    {
        return $this->primitive($user->isLimitedBN());
    }

    public function includeIsModerator(User $user)
    {
        return $this->primitive($user->isModerator());
    }

    public function includeIsNat(User $user)
    {
        return $this->primitive($user->isNAT());
    }

    public function includeIsRestricted(User $user)
    {
        return $this->primitive($user->isRestricted());
    }

    public function includeIsSilenced(User $user)
    {
        return $this->primitive($user->isSilenced());
    }

    public function includeKudosu(User $user): ResourceInterface
    {
        return $this->primitive([
            'available' => $user->osu_kudosavailable,
            'total' => $user->osu_kudostotal,
        ]);
    }

    public function includeLovedBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetCountByGroupedStatus('loved'));
    }

    public function includeMappingFollowerCount(User $user)
    {
        return $this->primitive($user->mappingFollowerCount());
    }

    public function includeMonthlyPlaycounts(User $user)
    {
        return $this->collection(
            $user->monthlyPlaycounts,
            new UserMonthlyPlaycountTransformer()
        );
    }

    public function includeNominatedBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetsNominated()->count());
    }

    public function includePage(User $user)
    {
        return $this->primitive(
            $user->userPage === null
                ? ['html' => '', 'raw' => '']
                : [
                    'html' => $user->userPage->bodyHTML(['modifiers' => ['profile-page']]),
                    'raw' => $user->userPage->bodyRaw,
                ]
        );
    }

    public function includePendingBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetCountByGroupedStatus('pending'));
    }

    public function includePreviousUsernames(User $user)
    {
        return $this->primitive($user->previousUsernames()->unique()->values()->toArray());
    }

    public function includeRankHighest(User $user): ResourceInterface
    {
        $rankHighest = $user->rankHighests()
            ->where('mode', Beatmap::modeInt($this->mode))
            ->first();

        return $rankHighest === null
            ? $this->null()
            : $this->item($rankHighest, new RankHighestTransformer());
    }

    public function includeRankHistory(User $user)
    {
        $rankHistoryData = $user->rankHistories()
            ->where('mode', Beatmap::modeInt($this->mode))
            ->first()
            ?->setRelation('user', $user);

        return $rankHistoryData === null
            ? $this->primitive(null)
            : $this->item($rankHistoryData, new RankHistoryTransformer());
    }

    public function includeRankedBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetCountByGroupedStatus('ranked'));
    }

    public function includeReplaysWatchedCounts(User $user)
    {
        return $this->collection(
            $user->replaysWatchedCounts,
            new UserReplaysWatchedCountTransformer()
        );
    }

    public function includeScoresBestCount(User $user)
    {
        return $this->primitive(count($user->beatmapBestScoreIds(
            $this->mode
        )));
    }

    public function includeScoresFirstCount(User $user)
    {
        return $this->primitive($user->scoresFirst($this->mode, ScoreSearchParams::showLegacyForUser(\Auth::user()))->count());
    }

    public function includeScoresPinnedCount(User $user)
    {
        return $this->primitive($user->scorePins()->forRuleset($this->mode)->withVisibleScore()->count());
    }

    public function includeScoresRecentCount(User $user)
    {
        return $this->primitive($user->soloScores()->recent($this->mode, false)->count());
    }

    public function includeSessionVerified(User $user)
    {
        return $this->primitive($user->token()?->isVerified() ?? false);
    }

    public function includeStatistics(User $user)
    {
        $stats = $user->statistics($this->mode);

        return $this->item($stats, new UserStatisticsTransformer());
    }

    public function includeStatisticsRulesets(User $user)
    {
        return $this->item($user, new UserStatisticsRulesetsTransformer());
    }

    public function includeSupportLevel(User $user)
    {
        return $this->primitive($user->supportLevel());
    }

    public function includeTeam(User $user)
    {
        return ($team = $user->team) === null
            ? $this->null()
            : $this->item($team, new TeamTransformer());
    }

    public function includeUnreadPmCount(User $user)
    {
        // legacy pm has been turned off
        return $this->primitive(0);
    }

    public function includeUserAchievements(User $user)
    {
        return $this->collection(
            $user->userAchievements()->orderBy('date', 'desc')->get(),
            new UserAchievementTransformer()
        );
    }

    public function includeUserPreferences(User $user)
    {
        static $fields = [
            'audio_autoplay',
            'audio_muted',
            'audio_volume',
            'beatmapset_card_size',
            'beatmapset_download',
            'beatmapset_show_nsfw',
            'beatmapset_title_show_original',
            'comments_show_deleted',
            'forum_posts_show_deleted',
            'legacy_score_only',
            'profile_cover_expanded',
            'scoring_mode',
            'user_list_filter',
            'user_list_sort',
            'user_list_view',
        ];

        $customization = $user->userProfileCustomization;

        return $this->primitive($customization === null
            ? Arr::only(UserProfileCustomization::DEFAULTS, $fields)
            : $customization->only($fields));
    }

    public function setMode(string $mode)
    {
        $this->mode = $mode;

        return $this;
    }
}
