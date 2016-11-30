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
namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\User;
use App\Models\Score\Best\Model as ScoreBestModel;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'userAchievements',
        'allRankHistories',
        'allScores',
        'allScoresBest',
        'allScoresFirst',
        'allStatistics',
        'beatmapPlaycounts',
        'defaultStatistics',
        'page',
        'recentActivities',
        'recentlyReceivedKudosu',
        'rankedAndApprovedBeatmapsets',
        'favoriteBeatmapsets',
    ];

    public function transform(User $user)
    {
        $profileCustomization = $user->profileCustomization()->firstOrNew([]);

        return [
            'id' => $user->user_id,
            'username' => $user->username,
            'joinDate' => display_regdate($user),
            'country' => [
                'code' => $user->country_acronym,
                'name' => $user->countryName(),
            ],
            'age' => $user->age,
            'avatarUrl' => $user->user_avatar,
            'isAdmin' => $user->isAdmin(),
            'isSupporter' => $user->osu_subscriber,
            'isGMT' => $user->isGMT(),
            'isQAT' => $user->isQAT(),
            'title' => $user->title(),
            'location' => $user->user_from,
            'lastvisit' => json_time($user->user_lastvisit),
            'twitter' => $user->user_twitter,
            'lastfm' => $user->user_lastfm,
            'skype' => $user->user_msnm,
            'playstyle' => $user->osu_playstyle,
            'playmode' => $user->playmode,
            'profileColour' => $user->user_colour,
            'profileOrder' => $profileCustomization->getExtrasOrder(),
            'cover' => [
                'customUrl' => $profileCustomization->cover->fileUrl(),
                'url' => $profileCustomization->cover->url(),
                'id' => $profileCustomization->cover->id(),
            ],
            'kudosu' => [
                'total' => $user->osu_kudostotal,
                'available' => $user->osu_kudosavailable,
            ],
        ];
    }

    public function includeDefaultStatistics(User $user)
    {
        $stats = $user->statistics($user->playmode);

        return $this->item($stats, new UserStatisticsTransformer());
    }

    public function includeAllStatistics(User $user)
    {
        return $this->item($user, function ($user) {
            $all = [];
            foreach (array_keys(Beatmap::MODES) as $mode) {
                $all[$mode] = json_item($user->statistics($mode), new UserStatisticsTransformer());
            }

            return $all;
        });
    }

    public function includeAllRankHistories(User $user)
    {
        return $this->item($user, function ($user) {
            $all = [];

            foreach ($user->rankHistories as $history) {
                $modeStr = Beatmap::modeStr($history->mode);

                $all[$modeStr] = json_item($history, new RankHistoryTransformer());
            }

            return $all;
        });
    }

    public function includeAllScoresFirst(User $user)
    {
        return $this->item($user, function ($user) {
            $all = [];
            foreach (array_keys(Beatmap::MODES) as $mode) {
                $scores = $user
                    ->scoresFirst($mode, true)
                    ->default()
                    ->with('beatmapset', 'beatmap')
                    ->limit(100)
                    ->get();

                $all[$mode] = json_collection($scores, new ScoreTransformer(), 'beatmap,beatmapset');
            }

            return $all;
        });
    }

    public function includeAllScoresBest(User $user)
    {
        return $this->item($user, function ($user) {
            $all = [];
            foreach (array_keys(Beatmap::MODES) as $mode) {
                $scores = $user
                    ->scoresBest($mode, true)
                    ->default()
                    ->orderBy('pp', 'DESC')
                    ->with('beatmapset', 'beatmap')
                    ->limit(100)
                    ->get();

                ScoreBestModel::fillInPosition($scores);

                $all[$mode] = json_collection($scores, new ScoreTransformer(), 'beatmap,beatmapset,weight');
            }

            return $all;
        });
    }

    public function includeAllScores(User $user)
    {
        return $this->item($user, function ($user) {
            $all = [];

            foreach (array_keys(Beatmap::MODES) as $mode) {
                $scores = $user->scores($mode, true)->default()->with('beatmapset', 'beatmap')->get();

                $all[$mode] = json_collection($scores, new ScoreTransformer(), 'beatmap,beatmapset');
            }

            return $all;
        });
    }

    public function includePage(User $user)
    {
        return $this->item($user, function ($user) {
            if ($user->userPage !== null) {
                return [
                    'html' => $user->userPage->bodyHTML,
                    'raw' => $user->userPage->bodyRaw,
                ];
            } else {
                return ['html' => '', 'raw' => ''];
            }
        });
    }

    public function includeUserAchievements(User $user)
    {
        return $this->collection(
            $user->userAchievements()->orderBy('date', 'desc')->get(),
            new UserAchievementTransformer()
        );
    }

    public function includeRecentActivities(User $user)
    {
        return $this->collection(
            $user->events()->recent()->get(),
            new EventTransformer()
        );
    }

    public function includeBeatmapPlaycounts(User $user)
    {
        $beatmapPlaycounts = $user->beatmapPlaycounts()
            ->with('beatmap', 'beatmap.beatmapset')
            ->orderBy('playcount', 'desc')
            ->limit(100)
            ->get()
            ->filter(function ($pc) {
                return $pc->beatmap !== null && $pc->beatmap->beatmapset !== null;
            });

        return $this->collection($beatmapPlaycounts, new BeatmapPlaycountTransformer());
    }

    public function includeRecentlyReceivedKudosu(User $user)
    {
        return $this->collection(
            $user->receivedKudosu()
                ->withPost()
                ->withGiver()
                ->with('post', 'post.topic', 'giver')
                ->orderBy('exchange_id', 'desc')
                ->limit(15)
                ->get(),
            new KudosuHistoryTransformer()
        );
    }

    public function includeRankedAndApprovedBeatmapsets(User $user)
    {
        return $this->collection(
            $user->beatmapsets()->rankedOrApproved()->active()->with('beatmaps')->get(),
            new BeatmapsetTransformer()
        );
    }

    public function includeFavoriteBeatmapsets(User $user)
    {
        return $this->collection(
            $user->favoriteBeatmapsets()->with('beatmaps')->get(),
            new BeatmapsetTransformer()
        );
    }
}
