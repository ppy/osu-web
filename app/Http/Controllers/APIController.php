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
namespace App\Http\Controllers;

use Request;
use Response;
use Redirect;
use Carbon\Carbon;
use App\Models\ApiKey;
use App\Models\Multiplayer\Match;
use App\Models\Beatmap;
use App\Models\BeatmapPack;
use App\Models\User;
use App\Models\Score;
use App\Transformers\Multiplayer\MatchTransformer;
use App\Transformers\API\ScoreTransformer;
use App\Transformers\API\UserTransformer;
use App\Transformers\API\StatisticsTransformer;
use App\Transformers\API\EventTransformer;

class APIController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter("@validateKey");
    }

    public function validateKey($route, $request)
    {
        $matches = ApiKey::where('api_key', Request::input('k'))->where('enabled', true)->where('revoked', false)->count();
        if ($matches < 1) {
            return $this->redirectToWiki();
        }
    }

    public function redirectToWiki()
    {
        return Redirect::to('https://github.com/ppy/osu-api/wiki');
    }

    public function missingMethod($parameters = [])
    {
        $this->redirectToWiki();
    }

    public function getIndex()
    {
        $this->redirectToWiki();
    }

    public function getMatch()
    {
        $match_id = Request::input('mp');
        if (present($match_id)) {
            $match = Match::where('match_id', $match_id)->get();
            if (!$match->isEmpty()) {
                return Response::json(
                    fractal_api_serializer(
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
            'games' => []
        ]);
    }

    public function getPacks()
    {
        $tag   = Request::input('tag');
        $limit = Request::input('n');

        $packs = BeatmapPack::orderBy('pack_id', 'DESC');

        if (present($tag)) {
            $packs = $packs->where('tag', $tag);
        }

        if (present($limit)) {
            $packs = $packs->limit((int)$limit);
        }

        return Response::json($packs->get());
    }

    public function getUser()
    {
        $id         = Request::input('u');
        $mode       = Request::input('m', 0);
        $type       = Request::input('type');
        $event_days = min(31, (int)Request::input('event_days', 1));

        if (!in_array($mode, [Beatmap::OSU, Beatmap::TAIKO, Beatmap::CTB, Beatmap::MANIA])) {
            return Response::json([]);
        }

        $user = User::lookup($id, $type);
        if (!$user) {
            return Response::json([]);
        }

        $stats = fractal_api_serialize_item(
            $user->statistics(play_mode_string($mode), true)->first(),
            new StatisticsTransformer()
        );

        $events = fractal_api_serialize_collection(
            $user->events()
                ->whereDate('date', '>', Carbon::now()->addDays(-$event_days))
                ->orderBy('event_id', 'desc')
                ->get(),
            new EventTransformer()
        );

        $user = fractal_api_serialize_item(
            $user,
            new UserTransformer()
        );

        $combined = array_merge($user, $stats, ['events' => $events]);

        return Response::json($combined);
    }

    public function getUserBest()
    {
        $limit = min((int)Request::input('limit', 10), 100);
        return $this->getScores(true, $limit);
    }

    public function getUserRecent()
    {
        $limit = min((int)Request::input('limit', 10), 50);
        return $this->getScores(false, $limit);
    }

    private function getScores($best, $limit)
    {
        $id     = Request::input('u');
        $mode   = Request::input('m', 0);
        $type   = Request::input('type');

        if (!in_array($mode, [Beatmap::OSU, Beatmap::TAIKO, Beatmap::CTB, Beatmap::MANIA])) {
            return Response::json([]);
        }

        $user = User::lookup($id, $type);
        if (!$user) {
            return Response::json([]);
        }

        $klass = $best ? Score\Best\Model::getClass($mode) : Score\Model::getClass($mode);
        $scores = $klass::forUser($user);

        if (present($limit)) {
            $scores = $scores->limit($limit);
        }

        return Response::json(
            fractal_api_serialize_collection(
                $scores->orderBy('date', 'desc')->get(),
                new ScoreTransformer()
            )
        );
    }

    public function getReplay()
    {
        $mode    = Request::input('m');
        $beatmap = Request::input('b');
        $id      = Request::input('u');
        $type    = Request::input('type', 'id');

        if (!in_array($mode, [Beatmap::OSU, Beatmap::TAIKO, Beatmap::CTB, Beatmap::MANIA])) {
            return Response::json([]);
        }

        $user = User::lookup($id, $type);
        if (!$user) {
            return Response::json([]);
        }

        $klass = Score\Best\Model::getClass($mode);
        $score = $klass::forUser($user)
            ->where('beatmap_id', $beatmap)
            ->where('replay', 1)
            ->first();

        if (!$score) {
            return Response::json([]);
        }

        $replay = $score->getReplay();
        if ($replay == null) {
            return Response::json([]);
        }

        return Response::json([
            "encoding" => "base64",
            "content" => base64_encode($replay)
        ]);
    }
}
