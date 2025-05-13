<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Multiplayer;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Ranking\DailyChallengeController;
use App\Models\Model;
use App\Models\Multiplayer\Room;
use App\Models\User;
use App\Transformers\Multiplayer\PlaylistItemTransformer;
use App\Transformers\Multiplayer\RealtimeRoomEventTransformer;
use App\Transformers\Multiplayer\RoomTransformer;
use App\Transformers\UserCompactTransformer;
use Ds\Map;
use Ds\Set;

class RoomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['events', 'index', 'show']]);
        $this->middleware('require-scopes:public', ['only' => ['events', 'index', 'leaderboard', 'show']]);
    }

    public function destroy($id)
    {
        Room::findOrFail($id)->endGame(\Auth::user());

        return response(null, 204);
    }

    public function events($id)
    {
        $room = Room::findOrFail($id);

        if (!$room->isRealtime()) {
            throw new InvariantException('retrieving events is only supported for realtime rooms');
        }

        $params = get_params(request()->all(), null, [
            'limit:int',
            'after:int',
            'before:int',
        ], ['null_missing' => true]);
        $after = $params['after'];
        $before = $params['before'];
        $limit = \Number::clamp($params['limit'] ?? 100, 1, 101);

        $events = $room->events()->with([
            'playlistItem.beatmap.beatmapset',
            'playlistItem.scoreLinks.score',
            'playlistItem.scoreLinks.score.processHistory',
        ])->limit($limit);

        if (isset($after)) {
            $events
                ->where('id', '>', $after)
                ->orderBy('id', 'ASC');
        } else {
            if (isset($before)) {
                $events->where('id', '<', $before);
            }

            $events->orderBy('id', 'DESC');
            $reverseOrder = true;
        }

        $userIds = new Set();
        $playlistItems = new Map();

        $events = $events->get();
        foreach ($events as $event) {
            if ($event->user_id) {
                $userIds->add($event->user_id);
            }

            $playlistItemId = $event->playlist_item_id;
            if ($playlistItemId !== null && !$playlistItems->hasKey($playlistItemId)) {
                $playlistItem = $event->playlistItem;
                $playlistItems->put($playlistItemId, $playlistItem);

                foreach ($playlistItem->scoreLinks as $scoreLink) {
                    $scoreLink->setRelation('playlistItem', $playlistItem);
                    $userIds->add($scoreLink->user_id);
                }
            }
        }

        if ($reverseOrder ?? false) {
            $events = $events->reverse();
        }

        $users = User::whereIn('user_id', $userIds->toArray())->get();
        $users = json_collection(
            $users,
            new UserCompactTransformer(),
            'country'
        );

        $playlistItems = json_collection(
            $playlistItems->values()->toArray(),
            new PlaylistItemTransformer(),
            ['beatmap.beatmapset', 'scores']
        );

        $events = json_collection(
            $events,
            new RealtimeRoomEventTransformer(),
        );

        $eventEndIds = $room
            ->events()
            ->selectRaw('MIN(id) first_event_id, MAX(id) last_event_id')
            ->first();

        return [
            'events' => $events,
            'users' => $users,
            'first_event_id' => $eventEndIds->first_event_id ?? 0,
            'last_event_id' => $eventEndIds->last_event_id ?? 0,
            'playlist_items' => $playlistItems,
            'current_playlist_item_id' => $room->current_playlist_item_id,
        ];
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
        $objectReturn = $apiVersion >= 99999999;
        $params = request()->all();
        $params['user'] = auth()->user();

        $includes = ['host.country', 'playlist.beatmap'];

        $search = Room::search($params);

        $rooms = $search['query']
            ->with($includes)
            ->withRecentParticipantIds()
            ->get();
        Room::preloadRecentParticipants($rooms);

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
    }

    public function join($roomId, $userId)
    {
        $currentUser = \Auth::user();
        // this allows admins/whatever to add users to games in the future
        if (get_int($userId) !== $currentUser->getKey()) {
            abort(403);
        }

        $room = Room::findOrFail($roomId);
        $room->assertCorrectPassword(get_string(request('password')));

        $room->join($currentUser);

        return RoomTransformer::createShowResponse($room);
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
        $currentUser = \Auth::user();
        // this allows admins/host/whoever to remove users from games in the future
        if (get_int($userId) !== $currentUser->getKey()) {
            abort(403);
        }

        $room = Room::findOrFail($roomId);
        $room->part($currentUser);

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
            return RoomTransformer::createShowResponse($room);
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
        $room = (new Room())->startGame(\Auth::user(), \Request::all());

        return RoomTransformer::createShowResponse($room);
    }
}
