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

        return ext_view('packs.index', [
            'packs' => $packs->paginate(static::PER_PAGE)->appends(['type' => $type]),
            'type' => $type,
        ]);
    }

    public function show($idOrTag)
    {
        $query = BeatmapPack::default();

        if (!ctype_digit($idOrTag)) {
            $pack = $query->where('tag', $idOrTag)->firstOrFail();

            return ujs_redirect(route('packs.show', $pack));
        }

        $pack = $query->findOrFail($idOrTag);

        return ext_view('packs.show', $this->packData($pack));
    }

    public function raw($id)
    {
        $pack = BeatmapPack::default()->findOrFail($id);

        return ext_view('packs.raw', $this->packData($pack));
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
