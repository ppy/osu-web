<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Multiplayer;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller;
use App\Libraries\DailyChallengeDateHelper;
use App\Models\Beatmap;
use App\Models\Model;
use App\Models\Multiplayer\Room;
use App\Models\SeasonRoom;
use App\Models\User;
use App\Transformers\BeatmapCompactTransformer;
use App\Transformers\BeatmapsetCompactTransformer;
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
        $this->middleware('auth', ['except' => ['events', 'index', 'leaderboard', 'show']]);
        $this->middleware('require-scopes:public', ['only' => ['events', 'index', 'leaderboard', 'show']]);
    }

    public function destroy($id)
    {
        Room::findOrFail($id)->endGame(\Auth::user());

        return response()->noContent();
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
        $params['limit'] = \Number::clamp($params['limit'] ?? 100, 1, 101);

        $events = $room->events()->with([
            'playlistItem.beatmap.beatmapset',
            'playlistItem.detailEvent',
            'playlistItem.scoreLinks.score',
        ])->limit($params['limit']);

        if (isset($params['after'])) {
            $events
                ->where('id', '>', $params['after'])
                ->orderBy('id', 'ASC');
        } else {
            if (isset($params['before'])) {
                $events->where('id', '<', $params['before']);
            }

            $events->orderBy('id', 'DESC');
            $reverseOrder = true;
        }

        $userIds = new Set();
        $playlistItems = new Map();
        $beatmapIds = new Set();

        $events = $events->get();
        foreach ($events as $event) {
            if ($event->user_id) {
                $userIds->add($event->user_id);
            }

            $playlistItemId = $event->playlist_item_id;
            if ($playlistItemId !== null && !$playlistItems->hasKey($playlistItemId)) {
                $playlistItem = $event->playlistItem;
                $playlistItem->setRelation('room', $room);
                $playlistItems->put($playlistItemId, $playlistItem);
                $beatmapIds->add($playlistItem->beatmap_id);

                foreach ($playlistItem->scoreLinks as $scoreLink) {
                    $scoreLink->setRelation('playlistItem', $playlistItem);
                    $userIds->add($scoreLink->user_id);
                    $beatmapIds->add($scoreLink->score->beatmap_id);
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
            ['country'],
        );

        $beatmaps = Beatmap::with('beatmapset')->whereIn('beatmap_id', $beatmapIds->toArray())->get();
        $beatmapsets = $beatmaps->map->beatmapset->unique('beatmapset_id');

        $playlistItems = json_collection(
            $playlistItems->values()->toArray(),
            new PlaylistItemTransformer(),
            ['details', 'scores'],
        );

        $events = json_collection(
            $events,
            new RealtimeRoomEventTransformer(),
        );

        $eventEndIds = $room
            ->events()
            ->selectRaw('MIN(id) first_event_id, MAX(id) last_event_id')
            ->first();

        $json = [
            'beatmaps' => json_collection($beatmaps, new BeatmapCompactTransformer()),
            'beatmapsets' => json_collection($beatmapsets, new BeatmapsetCompactTransformer()),
            'current_playlist_item_id' => $room->current_playlist_item_id,
            'events' => $events,
            'first_event_id' => $eventEndIds->first_event_id ?? 0,
            'last_event_id' => $eventEndIds->last_event_id ?? 0,
            'playlist_items' => $playlistItems,
            'room' => json_item($room, new RoomTransformer()),
            'users' => $users,
        ];

        return is_json_request() ? $json : ext_view('multiplayer.rooms.events', ['json' => $json]);
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

        $currentUser = \Auth::user();
        $userScore = $currentUser === null
            ? null
            : $room->topScores()->where('user_id', $currentUser->getKey())->first();

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

        return response()->noContent();
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
            return ujs_redirect(route('daily-challenge.show', DailyChallengeDateHelper::roomId($room)));
        }

        $playlistItemsQuery = $room->playlist();
        if ($room->isRealtime()) {
            $playlistItemsQuery->whereHas('scoreLinks');
        }
        $beatmaps = $playlistItemsQuery->with('beatmap.beatmapset.beatmaps')->get()->pluck('beatmap');
        $beatmapsets = $beatmaps->pluck('beatmapset');
        $highScores = $room->topScores()->paginate();
        $roomsQuery = Room::orderByDesc('id');
        if ($room->season === null) {
            if ($room->isFeatured()) {
                $roomsQuery->featured();
            } else {
                $roomsQuery = null;
            }
        } else {
            $seasonRoomIds = SeasonRoom::where('season_id', $room->season->getKey())->select('room_id');
            $roomsQuery->whereIn('id', $seasonRoomIds);
        }

        $userScore = ($currentUser = \Auth::user()) === null
            ? null
            : $room->topScores()->whereBelongsTo($currentUser)->first();

        return ext_view('multiplayer.rooms.show', [
            'beatmaps' => $beatmaps,
            'beatmapsets' => $beatmapsets,
            'room' => $room,
            'rooms' => $roomsQuery?->get(),
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
