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
            fn () => Tag::topTags($beatmapId),
        );

        return [
            'beatmap_tags' => $topBeatmapTags,
        ];
    }

    public function destroy($beatmapId, $tagId)
    {
        BeatmapTag::where('tag_id', $tagId)
            ->where('beatmap_id', $beatmapId)
            ->where('user_id', \Auth::user()->getKey())
            ->delete();

        return response()->noContent();
    }

    public function store($beatmapId)
    {
        $tagId = get_int(request('tag_id'));

        $beatmap = Beatmap::findOrFail($beatmapId);        
        priv_check('BeatmapTagStore', $beatmap)->ensureCan();

        $tag = Tag::findOrFail($tagId);

        $user = \Auth::user();

        $tag
            ->beatmapTags()
            ->firstOrCreate(['beatmap_id' => $beatmapId, 'user_id' => $user->getKey()]);

        return response()->noContent();
    }
}
