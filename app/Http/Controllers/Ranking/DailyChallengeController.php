<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Ranking;

use App\Http\Controllers\Controller;
use App\Libraries\DailyChallengeDateHelper;
use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\UserScoreAggregate;
use Carbon\CarbonImmutable;
use Carbon\Exceptions\InvalidFormatException;

class DailyChallengeController extends Controller
{
    public function index()
    {
        $room = Room::dailyChallenges()->last() ?? abort(404);

        return ujs_redirect(route('daily-challenge.show', ['daily_challenge' => DailyChallengeDateHelper::roomId($room)]));
    }

    public function show(string $dateString)
    {
        try {
            $date = CarbonImmutable::createFromFormat(DailyChallengeDateHelper::DATE_FORMAT, $dateString)->startOfDay();
        } catch (InvalidFormatException) {
            abort(404, 'invalid date');
        }

        $dateHelper = new DailyChallengeDateHelper($date);

        $room = Room::dailyChallengeFor($date);
        if ($room === null) {
            $playlist = null;
            $scores = null;
            $userScore = null;
        } else {
            $playlist = $room->currentPlaylistItem;

            $scores = $playlist
                ->highScores()
                ->forRanking()
                ->with(['score.user.team'])
                ->paginate();
        }

        $currentUser = \Auth::user();
        if ($currentUser === null) {
            $userScore = null;
            $userScores = null;
        } else {
            $days = $dateHelper->days();
            $roomIds = Room
                ::dailyChallenges()
                ->whereBetween('starts_at', [$days[0], $days[count($days) - 1]->addDay()])
                ->select('id');
            $userScoresQuery = UserScoreAggregate
                ::where('user_id', $currentUser->getKey())
                ->whereIn('room_id', $roomIds)
                ->where('total_score', '>', 0);
            $roomStartsAtQuery = Room
                ::select('starts_at')
                ->whereColumn('id', $userScoresQuery->qualifyColumn('room_id'));

            $userScores = $userScoresQuery
                ->select(['room_starts_at' => $roomStartsAtQuery])
                ->get()
                ->keyBy(fn ($agg) => $dateHelper::makeId(parse_db_time($agg->getAttribute('room_starts_at'))));

            $userScore = $playlist?->highScores()->whereBelongsTo($currentUser)->first();
        }

        return ext_view('rankings.daily_challenge', compact(
            'date',
            'dateHelper',
            'playlist',
            'room',
            'scores',
            'userScore',
            'userScores',
        ));
    }
}
