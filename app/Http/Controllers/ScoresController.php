<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Enums\Ruleset;
use App\Models\Beatmap;
use App\Models\Score\Best\Model as ScoreBest;
use App\Models\ScoreReplayStats;
use App\Models\Solo\Score as SoloScore;
use App\Transformers\ScoreTransformer;
use App\Transformers\UserCompactTransformer;
use Illuminate\Auth\AuthenticationException;

class ScoresController extends Controller
{
    const REPLAY_DOWNLOAD_COUNT_INTERVAL = 86400; // 1 day

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['except' => [
            'download',
            'index',
            'show',
        ]]);

        $this->middleware('require-scopes:public');
    }

    private static function parseIdOrFail(string $id): int
    {
        if (ctype_digit($id)) {
            $ret = (int) $id;

            if ($ret > 0) {
                return $ret;
            }
        }

        abort(404, osu_trans('errors.scores.invalid_id'));
    }

    public function download($rulesetOrSoloId, $id = null)
    {
        $currentUser = \Auth::user();
        if (!is_api_request() && $currentUser === null) {
            throw new AuthenticationException('User is not logged in.');
        }

        $shouldRedirect = !is_api_request() && !from_app_url();
        if ($id === null) {
            if ($shouldRedirect) {
                return ujs_redirect(route('scores.show', ['rulesetOrScore' => $rulesetOrSoloId]));
            }
            $soloScore = SoloScore::where('has_replay', true)->findOrFail($rulesetOrSoloId);

            $score = $soloScore->legacyScore() ?? $soloScore;
        } else {
            if ($shouldRedirect) {
                return ujs_redirect(route('scores.show', ['rulesetOrScore' => $rulesetOrSoloId, 'score' => $id]));
            }
            // don't limit downloading replays of restricted users for review purpose
            $score = ScoreBest::getClass($rulesetOrSoloId)
                ::where('score_id', $id)
                ->where('replay', true)
                ->firstOrFail();

            $soloScore = SoloScore::firstWhere(['legacy_score_id' => $score->getKey(), 'ruleset_id' => $score->ruleset_id]);
        }

        $file = $score->getReplayFile();
        if ($file === null) {
            abort(404);
        }

        if (
            $currentUser !== null
            && !$currentUser->isRestricted()
            && $currentUser->getKey() !== $score->user_id
            && ($currentUser->token()?->client->password_client ?? false)
        ) {
            $countLock = \Cache::lock(
                "view:score_replay:{$score->getKey()}:{$currentUser->getKey()}",
                static::REPLAY_DOWNLOAD_COUNT_INTERVAL,
            );

            if ($countLock->get()) {
                $score->user->statistics($score->getMode(), true)->increment('replay_popularity');

                $currentMonth = format_month_column(new \DateTime());
                $score->user->replaysWatchedCounts()
                    ->firstOrCreate(['year_month' => $currentMonth], ['count' => 0])
                    ->incrementInstance('count');

                if ($score instanceof ScoreBest) {
                    $score->replayViewCount()
                        ->firstOrCreate([], ['play_count' => 0])
                        ->incrementInstance('play_count');
                }

                if ($soloScore !== null) {
                    ScoreReplayStats
                        ::createOrFirst(['score_id' => $soloScore->getKey()], ['user_id' => $soloScore->user_id])
                        ->incrementInstance('watch_count');
                }
            }
        }

        static $responseHeaders = [
            'Content-Type' => 'application/x-osu-replay',
        ];

        return response()->streamDownload(function () use ($file) {
            echo $file;
        }, $this->makeReplayFilename($score), $responseHeaders);
    }

    /**
     * Get Scores
     *
     * Returns all passed scores. Up to 1000 scores will be returned in order of oldest to latest.
     * Most recent scores will be returned if `cursor_string` parameter is not specified.
     *
     * Obtaining new scores that arrived after the last request can be done by passing `cursor_string`
     * parameter from the previous request.
     *
     * ---
     *
     * ### Response Format
     *
     * Field         | Type                          | Notes
     * ------------- | ----------------------------- | -----
     * scores        | [Score](#score)[]             | |
     * cursor_string | [CursorString](#cursorstring) | Same value as the request will be returned if there's no new scores
     *
     * @group Scores
     *
     * @queryParam ruleset The [Ruleset](#ruleset) to get scores for.
     * @queryParam cursor_string Next set of scores
     */
    public function index()
    {
        $params = \Request::all();
        $cursor = cursor_from_params($params);
        $isOldScores = false;
        if (isset($cursor['id']) && ($idFromCursor = get_int($cursor['id'])) !== null) {
            $currentMaxId = SoloScore::max('id');
            $idDistance = $currentMaxId - $idFromCursor;
            if ($idDistance > $GLOBALS['cfg']['osu']['scores']['index_max_id_distance']) {
                abort(422, 'cursor is too old');
            }
            $isOldScores = $idDistance > 10_000;
        }

        $rulesetId = null;
        if (isset($params['ruleset'])) {
            $rulesetId = Beatmap::modeInt(get_string($params['ruleset']));

            if ($rulesetId === null) {
                abort(422, 'invalid ruleset parameter');
            }
        }

        return \Cache::remember(
            'score_index:'.($rulesetId ?? '').':'.json_encode($cursor),
            $isOldScores ? 600 : 5,
            function () use ($cursor, $isOldScores, $rulesetId) {
                $cursorHelper = SoloScore::makeDbCursorHelper('old');
                $scoresQuery = SoloScore::forListing()->limit(1_000);
                if ($rulesetId !== null) {
                    $scoresQuery->where('ruleset_id', $rulesetId);
                }
                if ($cursor === null || $cursorHelper->prepare($cursor) === null) {
                    // fetch the latest scores when no or invalid cursor is specified
                    // and reverse result to match the other query (latest score last)
                    $scores = array_reverse($scoresQuery->orderByDesc('id')->get()->all());
                } else {
                    $scores = $scoresQuery->cursorSort($cursorHelper, $cursor)->get()->all();
                }

                if ($isOldScores) {
                    $filteredScores = $scores;
                } else {
                    $filteredScores = [];
                    foreach ($scores as $score) {
                        // only return up to but not including the earliest unprocessed scores
                        if ($score->isProcessed()) {
                            $filteredScores[] = $score;
                        } else {
                            break;
                        }
                    }
                }

                return [
                    'scores' => json_collection($filteredScores, new ScoreTransformer(ScoreTransformer::TYPE_SOLO)),
                    // return previous cursor if no result, assuming there's no new scores yet
                    ...cursor_for_response($cursorHelper->next($filteredScores) ?? $cursor),
                ];
            },
        );
    }

    public function show($rulesetOrSoloId, $legacyId = null)
    {
        if ($legacyId === null) {
            $scoreQuery = SoloScore::whereKey(static::parseIdOrFail($rulesetOrSoloId));
        } else {
            $scoreQuery = SoloScore::where([
                'ruleset_id' => Ruleset::tryFromName($rulesetOrSoloId) ?? abort(404, 'unknown ruleset name'),
                'legacy_score_id' => static::parseIdOrFail($legacyId),
            ]);
        }
        if (\Auth::user()?->isAdmin() !== true) {
            $scoreQuery->visibleUsers();
        }
        $score = $scoreQuery->whereHas('beatmap.beatmapset')->firstOrFail();

        $userIncludes = array_map(function ($include) {
            return "user.{$include}";
        }, UserCompactTransformer::CARD_INCLUDES);

        $scoreJson = json_item($score, new ScoreTransformer(), array_merge([
            'beatmap.max_combo',
            'beatmap.user',
            'beatmap.owners',
            'beatmapset',
            'rank_global',
        ], $userIncludes));

        if (is_json_request()) {
            return $scoreJson;
        }

        return ext_view('scores.show', compact('score', 'scoreJson'));
    }

    private function makeReplayFilename(ScoreBest|SoloScore $score): string
    {
        $prefix = $score instanceof SoloScore
            ? 'solo-replay'
            : 'replay';

        return "{$prefix}-{$score->getMode()}_{$score->beatmap_id}_{$score->getKey()}.osr";
    }
}
