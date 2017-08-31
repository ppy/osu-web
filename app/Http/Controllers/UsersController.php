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

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\Score\Best\Model as ScoreBestModel;
use App\Models\User;
use App\Transformers\AchievementTransformer;
use App\Transformers\UserTransformer;
use Auth;
use Request;

class UsersController extends Controller
{
    protected $section = 'user';
    protected $maxResults = 100;

    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'checkUsernameAvailability',
            'checkUsernameExists',
        ]]);

        return parent::__construct();
    }

    public function card($id)
    {
        $id = get_int($id);

        $user = User::lookup($id, 'id');
        $mutual = false;

        if (Auth::user()) {
            $friend = Auth::user()
                ->friends()
                ->where('user_id', $id)
                ->first();

            if ($friend) {
                $mutual = $friend->mutual;
            }
        }

        // render usercard as popup (i.e. pretty fade-in elements on load)
        $popup = true;

        return view('objects._usercard', compact('user', 'friend', 'mutual', 'popup'));
    }

    public function disabled()
    {
        return view('users.disabled');
    }

    public function checkUsernameAvailability()
    {
        $username = Request::input('username');

        $errors = Auth::user()->validateUsernameChangeTo($username);

        $available = count($errors) === 0;
        $message = $available ? "Username '".e($username)."' is available!" : implode(' ', $errors);
        $cost = $available ? Auth::user()->usernameChangeCost() : 0;

        return [
            'username' => Request::input('username'),
            'available' => $available,
            'message' => $message,
            'cost' => $cost,
            'costString' => currency($cost),
        ];
    }

    public function checkUsernameExists()
    {
        $username = Request::input('username');
        $user = User::default()->where('username', $username)->first();
        if ($user === null) {
            abort(404);
        }

        return [
            'user_id' => $user->user_id,
            'username' => $user->username,
            'avatar_url' => $user->user_avatar,
        ];
    }

    public function scores($id, $type)
    {
        $this->parsePaginationParams(5);

        switch ($type) {
            case 'best':
                return $this->scoresBest($this->user, $this->mode, $this->perPage, $this->offset);

            case 'firsts':
                return $this->scoresFirsts($this->user, $this->mode, $this->perPage, $this->offset);

            case 'recent':
                return $this->scoresRecent($this->user, $this->mode, $this->perPage, $this->offset);

            default:
                abort(404);
        }
    }

    public function beatmapsets($id, $type)
    {
        $this->parsePaginationParams(6);

        switch ($type) {
            case 'most_played':
                $this->parsePaginationParams(5);

                return $this->mostPlayedBeatmapsets($this->user, $this->perPage, $this->offset);

            case 'favourite':
                return $this->favouriteBeatmapsets($this->user, $this->perPage, $this->offset);

            case 'ranked_and_approved':
                return $this->rankedAndApprovedBeatmapsets($this->user, $this->perPage, $this->offset);

            default:
                abort(404);
        }
    }

    public function kudosu($id)
    {
        $this->parsePaginationParams(5);

        return $this->recentKudosu($this->user, $this->perPage, $this->offset);
    }

    public function show($id, $mode = null)
    {
        $user = User::lookup($id, null, true);

        if ($user === null || !priv_check('UserShow', $user)->can()) {
            abort(404);
        }

        if ((string) $user->user_id !== $id) {
            return ujs_redirect(route('users.show', ['user' => $user, 'mode' => $mode]));
        }

        $currentMode = $mode ?? $user->playmode;

        if (!array_key_exists($currentMode, Beatmap::MODES)) {
            abort(404);
        }

        $achievements = json_collection(
            Achievement::achievable()
                ->orderBy('grouping')
                ->orderBy('ordering')
                ->orderBy('progression')
                ->get(),
            new AchievementTransformer()
        );

        $userArray = json_item(
            $user,
            new UserTransformer(), [
                'userAchievements',
                'allRankHistories',
                'allStatistics',
                'followerCount',
                'page',
                'recentActivities',
                'rankedAndApprovedBeatmapsetCount',
                'favouriteBeatmapsetCount',
            ]
        );

        $beatmapsets = [
            'most_played' => $this->mostPlayedBeatmapsets($user),
            'ranked_and_approved' => $this->rankedAndApprovedBeatmapsets($user),
            'favourite' => $this->favouriteBeatmapsets($user),
        ];

        $scores = [
            'best' => $this->scoresBest($user, $currentMode),
            'firsts' => $this->scoresFirsts($user, $currentMode),
            'recent' => $this->scoresRecent($user, $currentMode),
        ];

        $kudosu = $this->recentKudosu($user);

        return view('users.show', compact(
            'user',
            'userArray',
            'achievements',
            'beatmapsets',
            'scores',
            'currentMode',
            'kudosu'
        ));
    }

    private function parsePaginationParams($perPage)
    {
        $this->user = User::lookup(Request::route('user'), 'id');
        $this->mode = Request::route('mode') ?? 'osu';
        $this->offset = get_int(Request::input('offset'));

        if (!array_key_exists($this->mode, Beatmap::MODES)) {
            abort(404);
        }

        if ($this->offset >= $this->maxResults) {
            $this->perPage = 0;
        } elseif ($this->offset > $this->maxResults - $perPage) {
            $this->perPage = $this->maxResults - $this->offset;
        } else {
            $this->perPage = $perPage;
        }
    }

    private function recentKudosu($user, $perPage = 5, $offset = 0)
    {
        return json_collection(
            $user->receivedKudosu()
                ->with('post', 'post.topic', 'giver', 'kudosuable')
                ->orderBy('exchange_id', 'desc')
                ->limit($perPage)
                ->offset($offset)
                ->get(),
            'KudosuHistory'
        );
    }

    private function mostPlayedBeatmapsets($user, $perPage = 5, $offset = 0)
    {
        $beatmapsets = $user->beatmapPlaycounts()
            ->with('beatmap', 'beatmap.beatmapset')
            ->orderBy('playcount', 'desc')
            ->orderBy('beatmap_id', 'desc') // for consistent sorting
            ->limit($perPage)
            ->offset($offset)
            ->get()
            ->filter(function ($pc) {
                return $pc->beatmap !== null && $pc->beatmap->beatmapset !== null;
            });

        return json_collection($beatmapsets, 'BeatmapPlaycount');
    }

    private function rankedAndApprovedBeatmapsets($user, $perPage = 6, $offset = 0)
    {
        return json_collection(
            $user->profileBeatmapsetsRankedAndApproved()->limit($perPage)->offset($offset)->get(),
            'BeatmapsetCompact',
            ['beatmaps']
        );
    }

    private function favouriteBeatmapsets($user, $perPage = 6, $offset = 0)
    {
        return json_collection(
            $user->profileBeatmapsetsFavourite()->limit($perPage)->offset($offset)->get(),
            'BeatmapsetCompact',
            ['beatmaps']
        );
    }

    private function scoresBest($user, $mode, $perPage = 5, $offset = 0)
    {
        $scores = $user->scoresBest($mode, true)
            ->orderBy('pp', 'DESC')
            ->userBest($perPage, $offset, ['beatmap', 'beatmap.beatmapset']);

        ScoreBestModel::fillInPosition($scores);

        return json_collection($scores, 'Score', ['beatmap', 'beatmapset', 'weight']);
    }

    private function scoresFirsts($user, $mode, $perPage = 5, $offset = 0)
    {
        $scores = $user->scoresFirst($mode, true)
            ->orderBy('score_id', 'desc')
            ->with('beatmap', 'beatmap.beatmapset')
            ->limit($perPage)
            ->offset($offset)
            ->get();

        ScoreBestModel::fillInPosition($scores);

        return json_collection($scores, 'Score', ['beatmap', 'beatmapset']);
    }

    private function scoresRecent($user, $mode, $perPage = 5, $offset = 0)
    {
        $scores = $user->scores($mode, true)
            ->with('beatmap', 'beatmap.beatmapset')
            ->limit($perPage)
            ->offset($offset)
            ->get();

        return json_collection($scores, 'Score', ['beatmap', 'beatmapset']);
    }
}
