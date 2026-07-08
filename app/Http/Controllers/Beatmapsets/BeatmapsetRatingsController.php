<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Beatmapsets;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller;
use App\Models\Beatmapset;
use App\Models\BeatmapsetUserRating;

class BeatmapsetRatingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function store($beatmapsetId)
    {
        $rating = get_int(request('rating'));
        if ($rating === null || $rating < 1 || $rating > 10) {
            throw new InvariantException('Invalid rating.');
        }

        $beatmapset = Beatmapset::findOrFail($beatmapsetId);
        $user = \Auth::user();

        if (!$beatmapset->isScoreable()) {
            throw new InvariantException('Cannot rate this beatmap set.');
        }

        $userRating = BeatmapsetUserRating::where([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $user->getKey(),
        ]);
        if ($userRating->exists()) {
            throw new InvariantException("You've already rated this beatmap set.");
        }

        BeatmapsetUserRating::create([
            'beatmapset_id' => $beatmapset->getKey(),
            'rating' => $rating,
            'user_id' => $user->getKey(),
        ]);
        $beatmapset->recalculateRating();
        return ['updated_rating' => $beatmapset->rating];
    }
}
