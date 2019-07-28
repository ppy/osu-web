<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
        if (is_numeric($idOrTag)) {
            $pack = BeatmapPack::findOrFail($idOrTag);
        } else {
            $pack = BeatmapPack::where('tag', $idOrTag)->firstOrFail();
        }

        return ujs_redirect($this->indexLink($pack));
    }

    public function raw($id)
    {
        $pack = BeatmapPack::findOrFail($id);
        $mode = Beatmap::modeStr($pack->playmode ?? 0);

        $sets = $pack
            ->beatmapsets()
            ->select()
            ->withHasCompleted($pack->playmode ?? 0, Auth::user())
            ->get();

        return view('packs.show', compact('pack', 'sets', 'mode'));
    }

    private function indexLink(BeatmapPack $pack) : string
    {
        $type = $pack->type();
        $indexInPagination = BeatmapPack::getPacks($type)->get()->search($pack);
        $page = intdiv($indexInPagination, static::PER_PAGE) + 1;

        return route('packs.index', ['type' => $type, 'page' => $page === 1 ? null : $page])
            .'#pack-'.$pack->getKey();
    }
}
