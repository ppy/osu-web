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

namespace App\Transformers;

use App\Models\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
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
        'replays_watched_counts',
        'scores_first_count',
        'statistics',
        'unranked_beatmapset_count',
        'user_achievements',
    ];

    public function transform(User $user)
    {
        $profileCustomization = $user->profileCustomization();

        return [
            'id' => $user->user_id,
            'username' => $user->username,
            'join_date' => json_date($user->user_regdate),
            'country' => [
                'code' => $user->country_acronym,
                'name' => $user->countryName(),
            ],
            'avatar_url' => $user->user_avatar,
            'is_supporter' => $user->osu_subscriber,
            'is_gmt' => $user->isGMT(),
            'is_qat' => $user->isQAT(),
            'is_bng' => $user->isBNG(),
            'is_bot' => $user->isBot(),
            'is_active' => $user->isActive(),
            'interests' => $user->user_interests,
            'occupation' => $user->user_occ,
            'title' => $user->title(),
            'location' => $user->user_from,
            'last_visit' => json_time($user->displayed_last_visit),
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
            'cover' => [
                'custom_url' => $profileCustomization->cover()->fileUrl(),
                'url' => $profileCustomization->cover()->url(),
                'id' => $profileCustomization->cover()->id(),
            ],
            'kudosu' => [
                'total' => $user->osu_kudostotal,
                'available' => $user->osu_kudosavailable,
            ],
            'max_blocks' => $user->maxBlocks(),
            'max_friends' => $user->maxFriends(),
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
        return $this->item($user, function ($user) {
            return [
                $user->profileBeatmapsetsFavourite()->count(),
            ];
        });
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
        return $this->item($user, function ($user) {
            return [$user->followerCount()];
        });
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
        return $this->item($user, function ($user) {
            return [
                $user->profileBeatmapsetsGraveyard()->count(),
            ];
        });
    }

    public function includeIsAdmin(User $user)
    {
        return $this->primitive($user->isAdmin(), function ($flag) {
            return $flag;
        });
    }

    public function includeLovedBeatmapsetCount(User $user)
    {
        return $this->item($user, function ($user) {
            return [
                $user->profileBeatmapsetsLoved()->count(),
            ];
        });
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
                    'html' => $user->userPage->bodyHTMLWithoutImageDimensions,
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
            return $user
                ->usernameChangeHistory()
                ->visible()
                ->select(['username_last', 'timestamp'])
                ->withPresent('username_last')
                ->where('username_last', '<>', $user->username)
                ->orderBy('timestamp', 'ASC')
                ->get()
                ->pluck('username_last')
                ->unique()
                ->toArray();
        });
    }

    public function includeRankedAndApprovedBeatmapsetCount(User $user)
    {
        return $this->item($user, function ($user) {
            return [
                $user->profileBeatmapsetsRankedAndApproved()->count(),
            ];
        });
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

        return $this->item($user, function ($user) use ($mode) {
            return [$user->scoresFirst($mode)->count()];
        });
    }

    public function includeStatistics(User $user, Fractal\ParamBag $params)
    {
        $stats = $user->statistics($params->get('mode')[0]);

        return $this->item($stats, new UserStatisticsTransformer);
    }

    public function includeUnrankedBeatmapsetCount(User $user)
    {
        return $this->item($user, function ($user) {
            return [
                $user->profileBeatmapsetsUnranked()->count(),
            ];
        });
    }

    public function includeUserAchievements(User $user)
    {
        return $this->collection(
            $user->userAchievements()->orderBy('date', 'desc')->get(),
            new UserAchievementTransformer()
        );
    }
}
