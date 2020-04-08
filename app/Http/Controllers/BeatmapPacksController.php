<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\BeatmapPack;
use Auth;
use Request;

class BeatmapPacksController extends Controller
{
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
        $sets = $pack->beatmapsets()->select()->get();
        $userCompletionData = $pack->userCompletionData(Auth::user());

        return compact('mode', 'pack', 'sets', 'userCompletionData');
    }
}
