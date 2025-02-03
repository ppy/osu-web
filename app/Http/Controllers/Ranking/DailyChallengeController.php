<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Ranking;

use App\Http\Controllers\Controller;
use App\Models\Multiplayer\Room;
use Carbon\CarbonImmutable;
use Carbon\Exceptions\InvalidFormatException;

class DailyChallengeController extends Controller
{
    private const string DATE_FORMAT = 'Y-m-d';

    public static function roomId(Room $room): string
    {
        return $room->starts_at->format(static::DATE_FORMAT);
    }

    public function index()
    {
        $room = Room::dailyChallenges()->last() ?? abort(404);

        return ujs_redirect(route('daily-challenge.show', ['daily_challenge' => static::roomId($room)]));
    }

    public function show(string $dateString)
    {
        try {
            $date = CarbonImmutable::createFromFormat(static::DATE_FORMAT, $dateString);
        } catch (InvalidFormatException) {
            abort(404, 'invalid date');
        }

        $room = Room::dailyChallengeFor($date) ?? abort(404);
        $playlist = $room->playlist[0];

        $currentRoomOption = [
            'id' => $dateString,
            'text' => $dateString,
        ];
        $roomOptions = Room::dailyChallenges()
            ->orderByDesc('id')
            ->get()
            ->map(static::roomId(...))
            ->map(fn (string $roomName): array => [
                'id' => $roomName,
                'text' => $roomName,
            ]);

        $scores = $room->topScores()->paginate();

        $userScore = ($currentUser = \Auth::user()) === null
            ? null
            : $room->topScores()->whereBelongsTo($currentUser)->first();

        return ext_view('rankings.daily_challenge', compact(
            'currentRoomOption',
            'playlist',
            'room',
            'roomOptions',
            'scores',
            'userScore',
        ));
    }
}
