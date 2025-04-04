<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\BeatmapTag;
use App\Models\Tag;

class BeatmapTagsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', [
            'only' => [
                'destroy',
                'update',
            ],
        ]);
    }

    public function destroy($beatmapId, $tagId)
    {
        BeatmapTag::where('tag_id', $tagId)
            ->where('beatmap_id', $beatmapId)
            ->where('user_id', \Auth::user()->getKey())
            ->delete();

        return response()->noContent();
    }

    public function update($beatmapId, $tagId)
    {
        $beatmap = Beatmap::findOrFail($beatmapId);
        priv_check('BeatmapTagStore', $beatmap)->ensureCan();

        $tag = Tag::findOrFail($tagId);

        if ($tag->ruleset_id !== null && $tag->ruleset_id !== $beatmap->playmode) {
            throw new InvariantException(osu_trans('beatmap_tags.update.invalid_ruleset'));
        }

        $tag
            ->beatmapTags()
            ->firstOrCreate(['beatmap_id' => $beatmapId, 'user_id' => \Auth::user()->getKey()]);

        $beatmap->expireTopTagIds();

        return response()->noContent();
    }
}
