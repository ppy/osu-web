<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

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
    public function show($userId)
    {
        // validate user id and ban status
        $user = User::default()->findOrFail($userId);

        $currentUser = \Auth::user();

        $viewingOwn = $currentUser?->getKey() === $user->getKey();
        if ($viewingOwn) {
            UserSummary::markViewed($currentUser->getKey());
        }

        $summary = UserSummary::where(['user_id' => $user->getKey(), 'year' => UserSummary::DEFAULT_YEAR])->first();

        if ($summary === null) {
            abort(404, "It doesn't seem the user has played in 2025!");
        }

        if (!hash_equals($summary->share_key, get_string(request('share')) ?? '')) {
            if ($viewingOwn) {
                return ujs_redirect(route('wrapped', ['user' => $summary->user_id, 'share' => $summary->share_key]));
            } else {
                abort(403, 'Please ask the user for the share url!');
            }
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
            'share_link' => route('wrapped', ['user' => $summary->user_id, 'share' => $summary->share_key]),
            'summary' => $data,
            'user_id' => $summary->user_id,
        ];

        return ext_view('wrapped.show', compact('json', 'summary'));
    }
}
