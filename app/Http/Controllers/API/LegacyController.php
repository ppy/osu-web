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
namespace App\Http\Controllers\API;

use Request;
use Response;
use Carbon\Carbon;
use App\Models\Multiplayer\Match;
use App\Models\Beatmap;
use App\Models\BeatmapPack;
use App\Models\User;
use App\Models\Score;
use App\Transformers\API\MatchTransformer;
use App\Transformers\API\ScoreTransformer;
use App\Transformers\API\UserScoreTransformer;
use App\Transformers\API\UserTransformer;
use App\Transformers\API\StatisticsTransformer;
use App\Transformers\API\EventTransformer;
use App\Transformers\API\BeatmapTransformer;
use App\Transformers\API\BeatmapPackTransformer;
use Illuminate\Routing\Controller as Controller;

class LegacyController extends Controller
{
    public function getMatch()
    {
        $match_id = Request::input('mp');
        if (present($match_id)) {
            $match = Match::with('games.scores')->where('match_id', $match_id)->get();
            if (!$match->isEmpty()) {
                return Response::json(
                    fractal_api_serialize_collection(
                        $match,
                        new MatchTransformer(),
                        'games.scores'
                    )[0]
                );
            }
        }

        // match existing api
        return Response::json([
            'match' => 0,
            'games' => [],
        ]);
    }

    public function getPacks()
    {
        $tag = Request::input('tag');
        $limit = Request::input('n');

        $packs = BeatmapPack::orderBy('pack_id', 'DESC');

        if (present($tag)) {
            $packs = $packs->where('tag', $tag);
        }

        if (present($limit)) {
            $packs = $packs->limit((int) $limit);
        }

        return fractal_api_serialize_collection(
            $packs->get(),
            new BeatmapPackTransformer()
        );
    }

    public function getUser()
    {
        $id = Request::input('u');
        $mode = Beatmap::modeStr(intval(Request::input('m', 0)));
        $type = Request::input('type');
        $event_days = min(31, (int) Request::input('event_days', 1));

        if ($mode === null) {
            return Response::json([]);
        }

        $user = User::lookup($id, $type);
        if (!$user) {
            return Response::json([]);
        }

        $stats = fractal_api_serialize_item(
            $user->statistics($mode, true)->first(),
            new StatisticsTransformer()
        );

        $events = fractal_api_serialize_collection(
            $user->events()
                ->where('date', '>', Carbon::now()->addDays(-$event_days))
                ->orderBy('event_id', 'desc')
                ->get(),
            new EventTransformer()
        );

        $user = fractal_api_serialize_item(
            $user,
            new UserTransformer()
        );

        $combined = array_merge($user, $stats, ['events' => $events]);

        return Response::json([$combined]);
    }

    public function getUserBest()
    {
        $limit = min((int) Request::input('limit', 10), 100);
        if (present(Request::input('u'))) {
            $scores = $this->_getScores(true, $limit);
        } else {
            $scores = null;
        }

        return $this->_transformScores($scores->orderBy('pp', 'desc'), true);
    }

    public function getUserRecent()
    {
        $limit = min((int) Request::input('limit', 10), 50);
        if (present(Request::input('u'))) {
            $scores = $this->_getScores(false, $limit);
        } else {
            $scores = null;
        }

        return $this->_transformScores($scores->orderBy('date', 'desc'), true);
    }

    public function getScores()
    {
        $limit = min((int) Request::input('limit', 50), 100);
        $beatmap_id = Request::input('b');
        $mods = Request::input('mods');

        if (present($beatmap_id)) {
            $scores = $this->_getScores(true, $limit)->with('user')->where('beatmap_id', $beatmap_id);
            if (present($mods)) {
                $scores = $scores->where('enabled_mods', $mods);
            }
        } else {
            $scores = null;
        }

        return $this->_transformScores($scores->orderBy('score', 'desc'), false);
    }

    private function _transformScores($scores, $for_user)
    {
        if ($scores) {
            $return = fractal_api_serialize_collection(
                $scores->get(),
                $for_user ? new UserScoreTransformer() : new ScoreTransformer()
            );
        } else {
            $return = [];
        }

        return Response::json($return);
    }

    private function _getScores($best, $limit)
    {
        $user_id = Request::input('u');
        $mode = intval(Request::input('m', 0));
        $type = Request::input('type', 'id');

        $scores = $best === true ? Score\Best\Model::getClass($mode) : Score\Model::getClass($mode);

        if ($scores === null) {
            return;
        }

        if (present($user_id)) {
            $user = User::lookup($user_id, $type);
            if (!$user) {
                return;
            }
            $scores = $scores->forUser($user);
        }

        if (present($limit)) {
            $scores = $scores->limit($limit);
        }

        $scores = $scores->whereHas('user', function ($q) {
            $q->where('user_warnings', '=', 0);
        });

        return $scores;
    }

    public function getReplay()
    {
        $mode = get_int(Request::input('m'));
        $beatmap = Request::input('b');
        $id = Request::input('u');
        $type = Request::input('type', 'id');

        $klass = Score\Best\Model::getClass($mode);
        if ($klass === null) {
            return Response::json([]);
        }

        $user = User::lookup($id, $type);
        if (!$user) {
            return Response::json([]);
        }

        $score = $klass::forUser($user)
            ->where('beatmap_id', $beatmap)
            ->where('replay', 1)
            ->first();

        if (!$score) {
            return Response::json([]);
        }

        $replay = $score->getReplay();
        if ($replay === null) {
            return Response::json([]);
        }

        return Response::json([
            'encoding' => 'base64',
            'content' => base64_encode($replay),
        ]);
    }

    public function getBeatmaps()
    {
        $since = Request::input('since'); // - return all beatmaps ranked since this date. Must be a MySQL date.
        $set_id = Request::input('s'); // - specify a beatmapset_id to return metadata from.
        $beatmap_id = Request::input('b'); // - specify a beatmap_id to return metadata from.
        $user_id = Request::input('u'); // - specify a user_id or a username to return metadata from.
        $type = Request::input('type'); // - specify if `u` is a user_id or a username. Use `string` for usernames or `id` for user_ids. Optional, default behaviour is automatic recognition (may be problematic for usernames made up of digits only).
        $mode = get_int(Request::input('m')); // - mode (0 = osu!, 1 = Taiko, 2 = osu!catch, 3 = osu!mania). Optional, maps of all modes are returned by default.
        $include_converted = intval(Request::input('a', 0)); // - specify whether converted beatmaps are included (0 = not included, 1 = included). Only has an effect if `m` is chosen and not 0. Converted maps show their converted difficulty rating. Optional, default is 0.
        $hash = Request::input('h'); // - the beatmap hash. It can be used, for instance, if you're trying to get what beatmap has a replay played in, as .osr replays only provide beatmap hashes (example of hash: a5b99395a42bd55bc5eb1d2411cbdf8b). Optional, by default all beatmaps are returned independently from the hash.
        $limit = intval(Request::input('limit', 500)); // - amount of results. Optional, default and maximum are 500.

        $beatmaps = new Beatmap;

        $beatmaps = $beatmaps
            ->join('osu_beatmapsets', 'osu_beatmaps.beatmapset_id', '=', 'osu_beatmapsets.beatmapset_id')
            ->where('osu_beatmapsets.approved', '>=', -2)
            ->where('osu_beatmapsets.active', 1)
            ->orderBy('osu_beatmapsets.approved_date', 'desc')
            ->limit($limit);

        if (present($beatmap_id)) {
            $beatmaps = $beatmaps->where('beatmap_id', $beatmap_id);
        }

        if (present($set_id)) {
            $beatmaps = $beatmaps->where('osu_beatmapsets.beatmapset_id', $set_id);
        }

        if (present($user_id)) {
            $user = User::lookup($user_id, $type);
            if (!$user) {
                return Response::json([]);
            }
            $beatmaps = $beatmaps->where('osu_beatmaps.user_id', $user->user_id);
        }

        if ($mode !== null && in_array($mode, array_values(Beatmap::MODES), true) === false) {
            return Response::json([]);
        }

        $playmodes = [];
        if (present($mode)) {
            $playmodes[] = $mode;
        }

        if (present($include_converted) && $include_converted === 1) {
            $playmodes[] = 0;
        }

        if (!empty($playmodes)) {
            $beatmaps = $beatmaps->whereIn('playmode', $playmodes);
        }

        if (present($hash)) {
            $beatmaps = $beatmaps->where('checksum', $hash);
        }

        if (present($since)) {
            $beatmaps = $beatmaps->where('approved_date', '>', $since);
        }

        return fractal_api_serialize_collection(
            $beatmaps->with('set', 'difficulty', 'difficultyAttribs')->get(),
            new BeatmapTransformer()
        );
    }
}
