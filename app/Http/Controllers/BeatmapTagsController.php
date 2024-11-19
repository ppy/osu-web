<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\BeatmapTag;
use App\Models\Tag;
use Exception;

class BeatmapTagsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', [
            'only' => [
                'store',
                'destroy',
            ],
        ]);

        $this->middleware('require-scopes:public', ['only' => 'index']);
    }

    public function index($beatmapId)
    {
        $topBeatmapTags = cache_remember_mutexed(
            "beatmap_tags:{$beatmapId}",
            $GLOBALS['cfg']['osu']['tags']['beatmap_tags_cache_interval'],
            [],
            fn () => BeatmapTag::select(['tag_id', 'tags.name'])
                ->selectRaw('count(*) as tag_count')
                ->join('tags', 'beatmap_tags.tag_id', 'tags.id')
                ->where('beatmap_id', $beatmapId)
                ->whereHas('user', function ($userQuery) {
                    $userQuery->default();
                })
                ->groupBy('tag_id')
                ->orderBy('tag_count', 'desc')
                ->limit(50)
                ->get()
                ->all(),
        );

        return [
            'beatmap_tags' => $topBeatmapTags,
        ];
    }

    public function destroy($beatmapId)
    {
        BeatmapTag::where('tag_id', get_int(request('tag_id')))
            ->where('beatmap_id', $beatmapId)
            ->where('user_id', \Auth::user()->getKey())
            ->delete();

        return response()->noContent();
    }

    public function store($beatmapId)
    {
        $tagId = get_int(request('tag_id'));

        $beatmap = Beatmap::findOrFail($beatmapId);
        $tag = Tag::findOrFail($tagId);

        $user = \Auth::user();

        $userHasScore = $user->soloScores()->where('beatmap_id', $beatmapId)->exists();
        abort_if(!$userHasScore, 400, 'you must set a score on a beatmap to add a tag');

        $hasExistingBeatmapTag = $user->beatmapTags()->where('beatmap_id', $beatmapId)->exists();

        if (!$hasExistingBeatmapTag) {
            priv_check('BeatmapTag', $beatmap)->ensureCan();

            try {
                $tag
                    ->beatmapTags()
                    ->create(['beatmap_id' => $beatmapId, 'user_id' => $user->getKey()]);
            } catch (Exception $ex) {
                if (!is_sql_unique_exception($ex)) {
                    throw $ex;
                }
            }
        }

        return response()->noContent();
    }
}
