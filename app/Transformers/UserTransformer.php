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

use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\User;
use App\Models\Score\Best\Model as ScoreBestModel;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'allStatistics',
        'allScoresBest',
        'allScoresFirst',
        'defaultStatistics',
        'page',
        'recentAchievements',
        'recentActivities',
        'recentlyReceivedKudosu',
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
            'isAdmin' => $user->is_admin,
            'isSupporter' => $user->osu_subscriber,
            'title' => $user->title(),
            'location' => $user->user_from,
            'lastvisit' => $user->user_lastvisit->toIso8601String(),
            'twitter' => $user->user_twitter,
            'lastfm' => $user->user_lastfm,
            'skype' => $user->user_msnm,
            'playstyle' => $user->osu_playstyle,
            'playmode' => $user->playmode,
            'profileColour' => $user->user_colour,
            'cover' => [
                'customUrl' => $profileCustomization->cover->fileUrl(),
                'url' => $profileCustomization->cover->url(),
                'id' => $profileCustomization->cover->id(),
            ],
            'achievements' => [
                'total' => Achievement::count(),
                'current' => $user->achievements()->count(),
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
            foreach (array_keys(Beatmap::modes()) as $mode) {
                $all[$mode] = fractal_item_array($user->statistics($mode), new UserStatisticsTransformer());
            }

            return $all;
        });
    }

    public function includeAllScoresFirst(User $user)
    {
        return $this->item($user, function ($user) {
            $all = [];
            foreach (array_keys(Beatmap::modes()) as $mode) {
                $scores = $user->scoresFirst($mode, true)->with('beatmapSet', 'beatmap')->limit(100)->get();

                $all[$mode] = fractal_collection_array($scores, new ScoreTransformer(), 'beatmap,beatmapSet');
            }

            return $all;
        });
    }

    public function includeAllScoresBest(User $user)
    {
        return $this->item($user, function ($user) {
            $all = [];
            foreach (array_keys(Beatmap::modes()) as $mode) {
                $scores = $user->scoresBest($mode, true)->with('beatmapSet', 'beatmap')->limit(100)->get();
                ScoreBestModel::fillInPosition($scores);

                $all[$mode] = fractal_collection_array($scores, new ScoreTransformer(), 'beatmap,beatmapSet,weight');
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

    public function includeRecentAchievements(User $user)
    {
        return $this->collection(
            $user->achievements()->with('achievement')->orderBy('date', 'desc')->limit(8)->get(),
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
}
