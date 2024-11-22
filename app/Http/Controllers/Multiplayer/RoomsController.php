<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Multiplayer;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Ranking\DailyChallengeController;
use App\Models\Model;
use App\Models\Multiplayer\Room;
use App\Transformers\Multiplayer\RoomTransformer;

class RoomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
        $this->middleware('require-scopes:public', ['only' => ['index', 'leaderboard', 'show']]);
    }

    public function destroy($id)
    {
        Room::findOrFail($id)->endGame(\Auth::user());

        return response(null, 204);
    }

    /**
     * Get Multiplayer Rooms
     *
     * Returns a list of multiplayer rooms.
     *
     * @group Multiplayer
     *
     * @queryParam limit Maximum number of results. No-example
     * @queryParam mode Filter mode; `active` (default), `all`, `ended`, `participated`, `owned`. No-example
     * @queryParam season_id Season ID to return Rooms from. No-example
     * @queryParam sort Sort order; `ended`, `created`. No-example
     * @queryParam type_group `playlists` (default) or `realtime`. No-example
     */
    public function index()
    {
        $apiVersion = api_version();
        $compactReturn = $apiVersion >= 20220217;
        $objectReturn = $apiVersion >= 99999999;
        $params = request()->all();
        $params['user'] = auth()->user();

        $includes = ['host.country', 'playlist.beatmap'];

        if (!$compactReturn) {
            $includes = [...$includes, 'playlist.beatmap.beatmapset', 'playlist.beatmap.baseMaxCombo'];
        }

        $search = Room::search($params);
        $query = $search['query'];

        // temporary workaround for lazer client failing to deserialise `daily_challenge` room category
        // can be removed 20241129
        if ($apiVersion < 20240529) {
            $query->whereNot('category', 'daily_challenge');
        }

        $rooms = $query
            ->with($includes)
            ->withRecentParticipantIds()
            ->get();
        Room::preloadRecentParticipants($rooms);

        if ($compactReturn) {
            $rooms->each->findAndSetCurrentPlaylistItem();
            $rooms->loadMissing('currentPlaylistItem.beatmap.beatmapset');

            $roomsJson = json_collection($rooms, new RoomTransformer(), [
                'current_playlist_item.beatmap.beatmapset',
                'difficulty_range',
                'host.country',
                'playlist_item_stats',
                'recent_participants',
            ]);

            if ($objectReturn) {
                return array_merge([
                    'rooms' => $roomsJson,
                ], cursor_for_response($search['cursorHelper']->next($rooms)));
            } else {
                return $roomsJson;
            }
        } else {
            return json_collection($rooms, new RoomTransformer(), [
                'host.country',
                'playlist.beatmap.beatmapset',
                'playlist.beatmap.checksum',
                'playlist.beatmap.max_combo',
                'recent_participants',
            ]);
        }
    }

    public function join($roomId, $userId)
    {
        // this allows admins/whatever to add users to games in the future
        if (get_int($userId) !== auth()->user()->user_id) {
            abort(403);
        }

        $room = Room::findOrFail($roomId);

        if ($room->password !== null) {
            $password = get_param_value(request('password'), null);

            if ($password === null || !hash_equals(hash('sha256', $room->password), hash('sha256', $password))) {
                abort(403, osu_trans('multiplayer.room.invalid_password'));
            }
        }

        $room->join(auth()->user());

        return $this->createJoinedRoomResponse($room);
    }

    public function leaderboard($roomId)
    {
        $limit = \Number::clamp(get_int(request('limit')) ?? Model::PER_PAGE, 1, 50);
        $room = Room::findOrFail($roomId);

        // leaderboard currently requires auth so auth()->check() is not required.
        $userScore = $room->topScores()->where('user_id', auth()->id())->first();

        return [
            'leaderboard' => json_collection(
                $room->topScores()->paginate($limit),
                'Multiplayer\UserScoreAggregate',
                ['user.country']
            ),
            'user_score' => $userScore !== null ? json_item(
                $userScore,
                'Multiplayer\UserScoreAggregate',
                ['position', 'user.country']
            ) : null,
        ];
    }

    public function part($roomId, $userId)
    {
        // this allows admins/host/whoever to remove users from games in the future
        if (get_int($userId) !== auth()->user()->user_id) {
            abort(403);
        }

        Room::findOrFail($roomId)->channel->removeUser(auth()->user());

        return response([], 204);
    }

    public function show($id)
    {
        if ($id === 'latest') {
            $room = Room::featured()->last();

            if ($room === null) {
                abort(404);
            }
        } else {
            $room = Room::findOrFail($id);
        }

        if (is_api_request()) {
            return $this->createJoinedRoomResponse($room);
        }

        if ($room->category === 'daily_challenge') {
            return ujs_redirect(route('daily-challenge.show', DailyChallengeController::roomId($room)));
        }

        $playlistItemsQuery = $room->playlist();
        if ($room->isRealtime()) {
            $playlistItemsQuery->whereHas('scoreLinks');
        }
        $beatmaps = $playlistItemsQuery->with('beatmap.beatmapset.beatmaps')->get()->pluck('beatmap');
        $beatmapsets = $beatmaps->pluck('beatmapset');
        $highScores = $room->topScores()->paginate();
        $spotlightRooms = Room::featured()->orderBy('id', 'DESC')->get();

        $userScore = ($currentUser = \Auth::user()) === null
            ? null
            : $room->topScores()->whereBelongsTo($currentUser)->first();

        return ext_view('multiplayer.rooms.show', [
            'beatmaps' => $beatmaps,
            'beatmapsets' => $beatmapsets,
            'room' => $room,
            'rooms' => $spotlightRooms,
            'scores' => $highScores,
            'userScore' => $userScore,
        ]);
    }

    public function store()
    {
        try {
            $room = (new Room())->startGame(auth()->user(), request()->all());

            return $this->createJoinedRoomResponse($room);
        } catch (InvariantException $e) {
            return error_popup($e->getMessage(), $e->getStatusCode());
        }
    }

    private function createJoinedRoomResponse($room)
    {
        return json_item(
            $room
                ->load('host.country')
                ->load('playlist.beatmap.beatmapset')
                ->load('playlist.beatmap.baseMaxCombo'),
            'Multiplayer\Room',
            [
                'current_user_score.playlist_item_attempts',
                'host.country',
                'playlist.beatmap.beatmapset',
                'playlist.beatmap.checksum',
                'playlist.beatmap.max_combo',
                'recent_participants',
            ]
        );
    }
}
