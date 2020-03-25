<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\User;
use League\Fractal;

class UserTransformer extends UserCompactTransformer
{
    protected $defaultIncludes = [
        'country',
        'cover',
        'is_bng',
        'is_full_bn',
        'is_gmt',
        'is_limited_bn',
        'is_moderator',
        'is_nat',
        'is_restricted',
    ];

    protected $permissions = [
        'friends' => 'IsNotOAuth',
        'is_bng' => 'IsNotOAuth',
        'is_full_bn' => 'IsNotOAuth',
        'is_gmt' => 'IsNotOAuth',
        'is_limited_bn' => 'IsNotOAuth',
        'is_moderator' => 'IsNotOAuth',
        'is_nat' => 'IsNotOAuth',
        'is_restricted' => 'IsNotOAuth',
    ];

    public function __construct()
    {
        $this->availableIncludes = array_merge($this->availableIncludes, [
            'account_history',
            'active_tournament_banner',
            'badges',
            'blocks',
            'defaultStatistics',
            'favourite_beatmapset_count',
            'follower_count',
            'friends',
            'graveyard_beatmapset_count',
            'is_admin',
            'loved_beatmapset_count',
            'monthly_playcounts',
            'page',
            'previous_usernames',
            'ranked_and_approved_beatmapset_count',
            'rankHistory', // TODO: should be changed to rank_history
            'replays_watched_counts',
            'scores_first_count',
            'statistics',
            'unranked_beatmapset_count',
            'unread_pm_count',
            'user_achievements',
            'user_preferences',
        ]);
    }

    public function transform(User $user)
    {
        $profileCustomization = $user->profileCustomization();

        $result = parent::transform($user);

        return array_merge($result, [
            // extras
            'join_date' => json_time($user->user_regdate),
            'has_supported' => $user->hasSupported(),
            'interests' => $user->user_interests,
            'occupation' => $user->user_occ,
            'title' => $user->title(),
            'location' => $user->user_from,
            'last_visit' => json_time($user->displayed_last_visit),
            'is_online' => $user->isOnline(),
            'twitter' => $user->user_twitter,
            'lastfm' => $user->user_lastfm,
            'skype' => $user->user_msnm,
            'website' => $user->user_website,
            'discord' => $user->user_discord,
            'playstyle' => $user->osu_playstyle,
            'playmode' => $user->playmode,
            'pm_friends_only' => $user->pm_friends_only,
            'post_count' => $user->user_posts,
            'profile_colour' => $user->user_colour,
            'profile_order' => $profileCustomization->extras_order,
            'cover_url' => $profileCustomization->cover()->url(),
            'kudosu' => [
                'total' => $user->osu_kudostotal,
                'available' => $user->osu_kudosavailable,
            ],
            'max_blocks' => $user->maxBlocks(),
            'max_friends' => $user->maxFriends(),
        ]);
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
        return $this->item($user->profileBanners()->active(), new ProfileBannerTransformer);
    }

    public function includeBadges(User $user)
    {
        return $this->collection(
            $user->badges()->orderBy('awarded', 'DESC')->get(),
            new UserBadgeTransformer
        );
    }

    public function includeDefaultStatistics(User $user)
    {
        $stats = $user->statistics($user->playmode);

        return $this->item($stats, new UserStatisticsTransformer);
    }

    public function includeFavouriteBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetsFavourite()->count());
    }

    public function includeBlocks(User $user)
    {
        return $this->collection(
            $user->relations()->blocks()->get(),
            new UserRelationTransformer()
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

    public function includeIsAdmin(User $user)
    {
        return $this->primitive($user->isAdmin(), function ($flag) {
            return $flag;
        });
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


    public function includeLovedBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetsLoved()->count());
    }

    public function includeMonthlyPlaycounts(User $user)
    {
        return $this->collection(
            $user->monthlyPlaycounts,
            new UserMonthlyPlaycountTransformer
        );
    }

    public function includePage(User $user)
    {
        return $this->item($user, function ($user) {
            if ($user->userPage !== null) {
                return [
                    'html' => $user->userPage->bodyHTML(['withoutImageDimensions' => true, 'modifiers' => ['profile-page']]),
                    'raw' => $user->userPage->bodyRaw,
                ];
            } else {
                return ['html' => '', 'raw' => ''];
            }
        });
    }

    public function includePreviousUsernames(User $user)
    {
        return $this->item($user, function ($user) {
            return $user->previousUsernames()->unique()->values()->toArray();
        });
    }

    public function includeRankedAndApprovedBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetsRankedAndApproved()->count());
    }

    public function includeRankHistory(User $user, Fractal\ParamBag $params)
    {
        $mode = $params->get('mode')[0];

        $rankHistoryData = $user->rankHistories()
            ->where('mode', Beatmap::modeInt($mode))
            ->first();

        return $rankHistoryData === null
            ? $this->primitive(null)
            : $this->item($rankHistoryData, new RankHistoryTransformer);
    }

    public function includeReplaysWatchedCounts(User $user)
    {
        return $this->collection(
            $user->replaysWatchedCounts,
            new UserReplaysWatchedCountTransformer
        );
    }

    public function includeScoresFirstCount(User $user, Fractal\ParamBag $params)
    {
        $mode = $params->get('mode')[0];

        return $this->primitive($user->scoresFirst($mode, true)->visibleUsers()->count());
    }

    public function includeStatistics(User $user, Fractal\ParamBag $params)
    {
        $stats = $user->statistics($params->get('mode')[0]);

        return $this->item($stats, new UserStatisticsTransformer);
    }

    public function includeUnrankedBeatmapsetCount(User $user)
    {
        return $this->primitive($user->profileBeatmapsetsUnranked()->count());
    }

    public function includeUnreadPmCount(User $user)
    {
        return $this->primitive($user, function ($user) {
            return $user->notificationCount();
        });
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
        return $this->item($user, function ($user) {
            $customization = $user->profileCustomization();

            return [
                'ranking_expanded' => $customization->ranking_expanded,
                'user_list_filter' => $customization->user_list_filter,
                'user_list_sort' => $customization->user_list_sort,
                'user_list_view' => $customization->user_list_view,
            ];
        });
    }
}
