<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Beatmapsets;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller;
use App\Libraries\ClientCheck;
use App\Models\Beatmapset;
use App\Models\BeatmapsetUserRating;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BeatmapsetRatingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function index($beatmapsetId)
    {
        $user = \Auth::user();
        $beatmapset = Beatmapset::findOrFail($beatmapsetId);

        $userRating = BeatmapsetUserRating::where([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $user->getKey(),
        ])->first();

        return [
            'disallow_rating_reason' => priv_check('BeatmapsetRate', $beatmapset)->message(),
            'total_rating' => $beatmapset->rating,
            'user_rating' => $userRating?->rating,
        ];
    }

    public function store($beatmapsetId)
    {
        $request = \Request::instance();

        try {
            ClientCheck::parseToken($request);
        } catch (HttpException $e) {
            abort(403);
        }

        $rating = get_int($request['rating'] ?? null);
        if ($rating === null || $rating < 1 || $rating > 10) {
            throw new InvariantException(osu_trans('beatmapsets.rate.invalid'));
        }

        $beatmapset = Beatmapset::findOrFail($beatmapsetId);
        $user = \Auth::user();

        priv_check('BeatmapsetRate', $beatmapset)->ensureCan();

        BeatmapsetUserRating::upsert([
            'beatmapset_id' => $beatmapset->getKey(),
            'rating' => $rating,
            'user_id' => $user->getKey(),
        ], uniqueBy: ['beatmapset_id', 'user_id'], update: ['rating']);
        $beatmapset->recalculateRating();
        return ['updated_rating' => $beatmapset->rating];
    }
}
