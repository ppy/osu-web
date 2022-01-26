<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Libraries\MorphMap;
use App\Models\Beatmap;
use App\Models\User;
use App\Models\UserProfileCustomization;

class UserCompactTransformer extends TransformerAbstract
{
    const CARD_INCLUDES = [
        'country',
        'cover',
        'groups',
    ];

    const CARD_INCLUDES_PRELOAD = [
        'country',
        'userGroups',
        'userProfileCustomization',
    ];

    const LIST_INCLUDES = [
        ...self::CARD_INCLUDES,
        'statistics',
        'support_level',
    ];

    const PROFILE_HEADER_INCLUDES = [
        'active_tournament_banner',
        'badges',
        'comments_count',
        'follower_count',
        'groups',
        'mapping_follower_count',
        'previous_usernames',
        'support_level',
    ];

    protected string $mode;

    protected $availableIncludes = [
        'account_history',
        'active_tournament_banner',
        'badges',
        'beatmap_playcounts_count',
        'blocks',
        'comments_count',
        'country',
        'cover',
        'favourite_beatmapset_count',
        'follow_user_mapping',
        'follower_count',
        'friends',
        'graveyard_beatmapset_count',
        'groups',
        'is_admin',
        'is_bng',
        'is_full_bn',
        'is_gmt',
        'is_limited_bn',
        'is_moderator',
        'is_nat',
        'is_restricted',
        'is_silenced',
        'loved_beatmapset_count',
        'mapping_follower_count',
        'monthly_playcounts',
        'page',
        'pending_beatmapset_count',
        'previous_usernames',
        'ranked_beatmapset_count',
        'replays_watched_counts',
        'scores_best_count',
        'scores_first_count',
        'scores_pinned_count',
        'scores_recent_count',
        'statistics',
        'statistics_rulesets',
        'support_level',
        'unread_pm_count',
        'user_achievements',
        'user_preferences',
        // TODO: should be changed to rank_history
        // TODO: should be alphabetically ordered but lazer relies on being after statistics. can revert to alphabetical after 2020-05-01
        'rankHistory',
        'rank_history',

        // TODO: deprecated
        'ranked_and_approved_beatmapset_count',
        'unranked_beatmapset_count',
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

    protected $userProfileCustomization = [];

    public function transform(User $user)
    {
        return [
            'avatar_url' => $user->user_avatar,
            'country_code' => $user->country_acronym,
            'default_group' => $user->defaultGroup()->identifier,
            'id' => $user->user_id,
            'is_active' => $user->isActive(),
            'is_bot' => $user->isBot(),
            'is_deleted' => $user->isDeleted(),
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
        $banner = $user->profileBanners()->active();

        return $banner === null
            ? $this->primitive(null)
            : $this->item($banner, new ProfileBannerTransformer());
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
        return $user->country === null
            ? $this->primitive(null)
            : $this->item($user->country, new CountryTransformer());
    }

    public function includeCover(User $user)
    {
        $profileCustomization = $this->userProfileCustomization($user);

        return $this->primitive([
            'custom_url' => $profileCustomization->cover()->fileUrl(),
            'url' => $profileCustomization->cover()->url(),
            'id' => $profileCustomization->cover()->id(),
        ]);
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
            $user->relations()->friends()->withMutual()->get(),
            new UserRelationTransformer()
        );
    }

    public function includeGraveyardBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetsGraveyard()->count());
    }

    public function includeGroups(User $user)
    {
        return $this->collection($user->userGroupsForBadges(), new UserGroupTransformer());
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

    public function includeLovedBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetsLoved()->count());
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
        return $this->primitive($user->profileBeatmapsetsPending()->count());
    }

    public function includePreviousUsernames(User $user)
    {
        return $this->primitive($user->previousUsernames()->unique()->values()->toArray());
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

    public function includeRankedAndApprovedBeatmapsetCount(User $user)
    {
        return $this->includeRankedBeatmapsetCount($user);
    }

    public function includeRankedBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetsRanked()->count());
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
        return $this->primitive(count($user->beatmapBestScoreIds($this->mode)));
    }

    public function includeScoresFirstCount(User $user)
    {
        return $this->primitive($user->scoresFirst($this->mode, true)->visibleUsers()->count());
    }

    public function includeScoresPinnedCount(User $user)
    {
        return $this->primitive($user->scorePins()->forMode($this->mode)->withVisibleScore()->count());
    }

    public function includeScoresRecentCount(User $user)
    {
        return $this->primitive($user->scores($this->mode, true)->includeFails(false)->count());
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

    public function includeUnrankedBeatmapsetCount(User $user)
    {
        return $this->includePendingBeatmapsetCount($user);
    }

    public function includeUnreadPmCount(User $user)
    {
        return $this->primitive($user->notificationCount());
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
        $customization = $this->userProfileCustomization($user);

        return $this->primitive($customization->only([
            'audio_autoplay',
            'audio_muted',
            'audio_volume',
            'beatmapset_card_size',
            'beatmapset_download',
            'beatmapset_show_nsfw',
            'beatmapset_title_show_original',
            'comments_show_deleted',
            'forum_posts_show_deleted',
            'ranking_expanded',
            'user_list_filter',
            'user_list_sort',
            'user_list_view',
        ]));
    }

    public function setMode(string $mode)
    {
        $this->mode = $mode;

        return $this;
    }

    protected function userProfileCustomization(User $user): UserProfileCustomization
    {
        if (!isset($this->userProfileCustomization[$user->getKey()])) {
            $this->userProfileCustomization[$user->getKey()] = $user->userProfileCustomization ?? $user->userProfileCustomization()->make();
        }

        return $this->userProfileCustomization[$user->getKey()];
    }
}
