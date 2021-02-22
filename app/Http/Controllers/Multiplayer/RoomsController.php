<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Multiplayer;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Multiplayer\Room;

class RoomsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
        $this->middleware('require-scopes:public', ['only' => ['index', 'leaderboard', 'show']]);
    }

    public function index()
    {
        $params = request()->all();
        $params['user'] = auth()->user();

        return Room::search(
            $params,
            ['host.country', 'playlist.beatmap.beatmapset', 'playlist.beatmap.baseMaxCombo'],
            [
                'host.country',
                'playlist.beatmap.beatmapset',
                'playlist.beatmap.checksum',
                'playlist.beatmap.max_combo',
            ]
        );
    }

    public function join($roomId, $userId)
    {
        // this allows admins/whatever to add users to games in the future
        if (get_int($userId) !== auth()->user()->user_id) {
            abort(403);
        }

        Room::findOrFail($roomId)->join(auth()->user());

        return response([], 204);
    }

    public function leaderboard($roomId)
    {
        $limit = clamp(get_int(request('limit')) ?? 50, 1, 50);
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

        $channel = Room::findOrFail($roomId)->channel;

        if ($channel->hasUser(auth()->user())) {
            $channel->removeUser(auth()->user());
        }

        return response([], 204);
    }

    public function show($id)
    {
        if ($id === 'latest') {
            $room = Room::where('category', 'spotlight')->last();

            if ($room === null) {
                abort(404);
            }
        } else {
            $room = Room::findOrFail($id);
        }

        if (is_api_request()) {
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

        $beatmaps = $room->playlist()->with('beatmap.beatmapset.beatmaps')->get()->pluck('beatmap');
        $beatmapsets = $beatmaps->pluck('beatmapset');
        $highScores = $room->topScores()->paginate(50);
        $spotlightRooms = Room::where('category', 'spotlight')->orderBy('id', 'DESC')->get();

        return ext_view('multiplayer.rooms.show', [
            'beatmaps' => $beatmaps,
            'beatmapsets' => $beatmapsets,
            'room' => $room,
            'rooms' => $spotlightRooms,
            'scores' => $highScores,
        ]);
    }

    public function store()
    {
        try {
            $room = (new Room())->startGame(auth()->user(), request()->all());

            return json_item(
                $room
                    ->load('host.country')
                    ->load('playlist.beatmap.beatmapset')
                    ->load('playlist.beatmap.baseMaxCombo'),
                'Multiplayer\Room',
                [
                    'host.country',
                    'playlist.beatmap.beatmapset',
                    'playlist.beatmap.checksum',
                    'playlist.beatmap.max_combo',
                    'recent_participants',
                ]
            );
        } catch (InvariantException $e) {
            return error_popup($e->getMessage(), $e->getStatusCode());
        }
    }
}
