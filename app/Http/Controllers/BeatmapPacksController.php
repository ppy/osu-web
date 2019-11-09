<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\BeatmapPack;
use Auth;
use Request;

class BeatmapPacksController extends Controller
{
    protected $section = 'beatmaps';
    private const PER_PAGE = 20;

    public function index()
    {
        $type = presence(Request::input('type')) ?? BeatmapPack::DEFAULT_TYPE;
        $packs = BeatmapPack::getPacks($type);
        if ($packs === null) {
            abort(404);
        }

        return view('packs.index')
            ->with('packs', $packs->paginate(static::PER_PAGE)->appends(['type' => $type]))
            ->with('type', $type);
    }

    public function show($idOrTag)
    {
        $query = BeatmapPack::default();

        if (!ctype_digit($idOrTag)) {
            $pack = $query->where('tag', $idOrTag)->firstOrFail();

            return ujs_redirect(route('packs.show', $pack));
        }

        $pack = $query->findOrFail($idOrTag);

        return view('packs.show', $this->packData($pack));
    }

    public function raw($id)
    {
        $pack = BeatmapPack::default()->findOrFail($id);

        return view('packs.raw', $this->packData($pack));
    }

    private function packData($pack)
    {
        $mode = Beatmap::modeStr($pack->playmode ?? 0);

        $sets = $pack
            ->beatmapsets()
            ->select()
            ->withHasCompleted($pack->playmode ?? 0, Auth::user())
            ->get();

        return compact('pack', 'sets', 'mode');
    }
}
