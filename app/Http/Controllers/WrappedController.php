<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\Solo\Score;
use App\Models\User;
use App\Models\UserSummary;
use App\Transformers\BeatmapCompactTransformer;
use App\Transformers\ScoreTransformer;
use App\Transformers\UserCompactTransformer;

class WrappedController extends Controller
{
    private const YEAR = 2025;

    public function __construct()
    {
        parent::__construct();
    }

    public function show($userId)
    {
        $summary = UserSummary::where(['user_id' => $userId, 'year' => static::YEAR])->firstOrFail();

        $currentUser = \Auth::user();

        if ($currentUser?->getKey() !== $summary->user_id && !hash_equals($summary->share_key, get_string(request('share')) ?? '')) {
            abort(403, 'Please ask the user for the share url!');
        }

        $data = $summary->summary_data;
        $data['top_plays'] = json_collection(
            Score::whereKey($data['top_plays'])->orderByField('id', $data['top_plays'])->get(),
            new ScoreTransformer(false),
        );

        $json = [
            'related_users' => json_collection(
                User::with(UserCompactTransformer::CARD_INCLUDES_PRELOAD)->find($summary->relatedUserIds()),
                new UserCompactTransformer(),
                UserCompactTransformer::CARD_INCLUDES,
            ),
            'related_beatmaps' => json_collection(
                Beatmap::with(['beatmapset.user', 'beatmapOwners'])->find($summary->relatedBeatmapIds()),
                new BeatmapCompactTransformer(),
                ['beatmapset.user', 'owners'],
            ),
            'share_link' => route('wrapped', ['userId' => $summary->user_id, 'share' => $summary->share_key]),
            'summary' => $data,
            'user_id' => $summary->user_id,
        ];

        return ext_view('wrapped.show', compact('json', 'summary'));
    }
}
