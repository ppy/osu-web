<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Beatmap;
use App\Models\BeatmapPack;
use App\Transformers\BeatmapPackTransformer;
use Auth;
use Request;

class BeatmapPacksController extends Controller
{
    private const PER_PAGE = 100;

    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');
    }

    public function index()
    {
        $type = presence(get_string(Request::input('type'))) ?? BeatmapPack::DEFAULT_TYPE;
        $packs = BeatmapPack::getPacks($type);
        if ($packs === null) {
            abort(404);
        }

        $page = $packs->paginate(static::PER_PAGE);

        if (is_api_request()) {
            return json_collection($page, new BeatmapPackTransformer(), ['beatmapsets']);
        }

        return ext_view('packs.index', [
            'packs' => $page->appends(['type' => $type]),
            'type' => $type,
        ]);
    }

    public function show($idOrTag)
    {
        $query = BeatmapPack::default();

        if (ctype_digit($idOrTag)) {
            $pack = $query->findOrFail($idOrTag);

            return ujs_redirect(route('packs.show', $pack));
        }

        $pack = $query->where('tag', $idOrTag)->firstOrFail();
        $mode = Beatmap::modeStr($pack->playmode ?? 0);
        $sets = $pack->beatmapsets;
        $userCompletionData = $pack->userCompletionData(Auth::user());

        if (is_api_request()) {
            return json_item(
                $pack,
                new BeatmapPackTransformer($userCompletionData),
                ['beatmapsets', 'user_completion_data']
            );
        }

        $view = request('format') === 'raw' ? 'packs.raw' : 'packs.show';

        return ext_view($view, compact('mode', 'pack', 'sets', 'userCompletionData'));
    }
}
