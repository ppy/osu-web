<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\BeatmapTag;
use App\Models\Solo\Score;
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

    public function index(string $id)
    {
        $beatmapId = get_int($id);

        $topBeatmapTags = \Cache::remember(
            "beatmap_tags:{$beatmapId}",
            $GLOBALS['cfg']['osu']['tags']['beatmap_tags_cache_interval'],
            fn () => BeatmapTag::select(['tag_id', 'tags.name'])
                ->selectRaw('count(*) as tag_count')
                ->join('tags', 'beatmap_tags.tag_id', 'tags.id')
                ->where('beatmap_id', '=', $beatmapId)
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

    public function destroy(string $id)
    {
        BeatmapTag::where('tag_id', '=', get_int(request('tag_id')))
            ->where('beatmap_id', '=', get_int($id))
            ->where('user_id', '=', \Auth::user()->user_id)
            ->delete();

        return response()->noContent();
    }

    public function store(string $id)
    {
        $beatmapId = get_int($id);
        $tagId = get_int(request('tag_id'));

        $beatmap = Beatmap::find($beatmapId);
        $tag = Tag::find($tagId);

        abort_if($beatmap === null, 422, "specified beatmap couldn't be found");
        abort_if($tag === null, 422, "specified tag couldn't be found");

        $user = \Auth::user();
    
        $userHasScore = Score::where('user_id', $user->getKey())->where('beatmap_id', $beatmapId)->exists();
        abort_if(!$userHasScore, 400, 'you must set a score on a beatmap to add a tag');

        $hasExistingBeatmapTag = $user->beatmapTags()->where('beatmap_id', '=', $beatmapId)->exists();

        if (!$hasExistingBeatmapTag) {
            priv_check('BeatmapTag', $beatmap)->ensureCan();

            try {
                (new BeatmapTag(['tag_id' => $tagId]))
                    ->user()->associate($user)
                    ->beatmap()->associate($beatmap)
                    ->saveOrExplode();
            } catch (Exception $ex) {
                if (!is_sql_unique_exception($ex)) {
                    throw $ex;
                }
            }
        }

        return response()->noContent();
    }
}
