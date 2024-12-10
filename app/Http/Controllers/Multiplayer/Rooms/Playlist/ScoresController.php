<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Multiplayer\Rooms\Playlist;

use App\Docs\Attributes\Limit;
use App\Docs\Attributes\Sort;
use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller as BaseController;
use App\Libraries\ClientCheck;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\PlaylistItemUserHighScore;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\ScoreLink;
use App\Models\ScoreToken;
use App\Models\Solo\Score;
use App\Transformers\ScoreTokenTransformer;
use App\Transformers\ScoreTransformer;

/**
 * @group Multiplayer
 */
class ScoresController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        $this->middleware('require-scopes:public', ['only' => ['index']]);
    }

    /**
     * Get Scores
     *
     * Returns a list of scores for specified playlist item.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [MultiplayerScores](#multiplayerscores) object.
     *
     * @urlParam room integer required Id of the room.
     * @urlParam playlist integer required Id of the playlist item.
     *
     * @usesCursor
     */
    #[Limit]
    #[Sort('MultiplayerScoresSort')]
    public function index($roomId, $playlistId)
    {
        $playlist = PlaylistItem::where('room_id', $roomId)->findOrFail($playlistId);
        $params = request()->all();
        $limit = \Number::clamp(get_int($params['limit'] ?? null) ?? 50, 1, 50);
        $cursorHelper = PlaylistItemUserHighScore::makeDbCursorHelper($params['sort'] ?? null);

        $highScoresQuery = $playlist
            ->highScores()
            ->whereHas('user', fn ($userQuery) => $userQuery->default())
            ->whereHas('scoreLink.score');

        [$highScores, $hasMore] = $highScoresQuery
            ->clone()
            ->cursorSort($cursorHelper, cursor_from_params($params))
            ->with(ScoreTransformer::MULTIPLAYER_BASE_PRELOAD)
            ->limit($limit)
            ->getWithHasMore();

        $transformer = ScoreTransformer::newSolo();
        $scoresJson = json_collection(
            $highScores->pluck('scoreLink'),
            $transformer,
            ScoreTransformer::MULTIPLAYER_BASE_INCLUDES
        );
        $total = $highScoresQuery->count();

        $user = auth()->user();

        if ($user !== null) {
            $userHighScoreLink = ScoreLink::whereIn(
                'score_id',
                $playlist
                    ->highScores()
                    ->where('user_id', $user->getKey())
                    ->select('score_id'),
            )->first();

            if ($userHighScoreLink !== null) {
                $userScoreJson = json_item(
                    $userHighScoreLink,
                    $transformer,
                    [
                        ...ScoreTransformer::MULTIPLAYER_BASE_INCLUDES,
                        'position',
                    ]
                );
            }
        }

        return [
            'params' => ['limit' => $limit, 'sort' => $cursorHelper->getSortName()],
            'scores' => $scoresJson,
            'total' => $total,
            'user_score' => $userScoreJson ?? null,
            ...cursor_for_response($cursorHelper->next($highScores, $hasMore)),
        ];
    }

    /**
     * Get a Score
     *
     * Returns detail of specified score and the surrounding scores.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [Score](#score) object.
     *
     * @urlParam room integer required Id of the room.
     * @urlParam playlist integer required Id of the playlist item.
     * @urlParam score integer required Id of the score.
     */
    public function show($roomId, $playlistId, $id)
    {
        $room = Room::find($roomId) ?? abort(404, 'Invalid room id');
        $playlistItem = $room->playlist()->find($playlistId) ?? abort(404, 'Invalid playlist id');
        $scoreLink = $playlistItem->scoreLinks()->findOrFail($id);

        return json_item(
            $scoreLink,
            ScoreTransformer::newSolo(),
            [
                ...ScoreTransformer::MULTIPLAYER_BASE_INCLUDES,
                'position',
                'scores_around',
            ],
        );
    }

    /**
     * Get User High Score
     *
     * Returns detail of highest score of specified user and the surrounding scores.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [Score](#score) object.
     *
     * @urlParam room integer required Id of the room.
     * @urlParam playlist integer required Id of the playlist item.
     * @urlParam user integer required User id.
     */
    public function showUser($roomId, $playlistId, $userId)
    {
        $room = Room::find($roomId) ?? abort(404, 'Invalid room id');
        $playlistItem = $room->playlist()->find($playlistId) ?? abort(404, 'Invalid playlist id');
        $scoreLink = $playlistItem->highScores()->where('user_id', $userId)->firstOrFail()->scoreLink ?? abort(404);

        return json_item(
            $scoreLink,
            ScoreTransformer::newSolo(),
            [
                ...ScoreTransformer::MULTIPLAYER_BASE_INCLUDES,
                'position',
                'scores_around',
            ],
        );
    }

    /**
     * @group Undocumented
     */
    public function store($roomId, $playlistId)
    {
        if (!$GLOBALS['cfg']['osu']['scores']['submission_enabled']) {
            abort(422, osu_trans('score_tokens.create.submission_disabled'));
        }

        $room = Room::findOrFail($roomId);
        $playlistItem = $room->playlist()->findOrFail($playlistId);
        $user = \Auth::user();
        $request = \Request::instance();
        $params = $request->all();

        if (get_string($params['beatmap_hash'] ?? null) !== $playlistItem->beatmap->checksum) {
            throw new InvariantException(osu_trans('score_tokens.create.beatmap_hash_invalid'));
        }

        $buildId = ClientCheck::parseToken($request)['buildId'];

        $scoreToken = $room->startPlay($user, $playlistItem, $buildId);

        return json_item($scoreToken, new ScoreTokenTransformer());
    }

    /**
     * @group Undocumented
     */
    public function update($roomId, $playlistItemId, $tokenId)
    {
        $request = \Request::instance();
        $clientTokenData = ClientCheck::parseToken($request);
        $scoreLink = \DB::transaction(function () use ($roomId, $playlistItemId, $tokenId) {
            $room = Room::findOrFail($roomId);

            $scoreToken = ScoreToken
                ::where([
                    'user_id' => \Auth::id(),
                    'playlist_item_id' => $playlistItemId,
                ])->whereHas('playlistItem')
                ->lockForUpdate()
                ->findOrFail($tokenId);

            if ($scoreToken->score_id !== null) {
                return ScoreLink::findOrFail($scoreToken->score_id);
            }

            $params = Score::extractParams(\Request::all(), $scoreToken);

            return $room->completePlay($scoreToken, $params);
        });

        $score = $scoreLink->score;
        if ($score->wasRecentlyCreated) {
            ClientCheck::queueToken($clientTokenData, $score->getKey());
            $score->queueForProcessing();
        }

        return json_item(
            $scoreLink,
            ScoreTransformer::newSolo(),
            [
                ...ScoreTransformer::MULTIPLAYER_BASE_INCLUDES,
                'position',
                'scores_around',
            ],
        );
    }
}
