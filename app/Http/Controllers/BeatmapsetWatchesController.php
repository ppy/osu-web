<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Models\Beatmapset;
use Auth;
use Exception;

class BeatmapsetWatchesController extends Controller
{
    protected $section = 'beatmaps';
    protected $actionPrefix = 'beatmapset-watches-';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function index()
    {
        return view('beatmapset_watches.index')
            ->with([
                'watches' => Auth::user()->beatmapsetWatches()->has('beatmapset')->paginate(50),
            ]);
    }

    public function update($beatmapsetId)
    {
        $beatmapset = Beatmapset::where('discussion_enabled', '=', true)->findOrFail($beatmapsetId);

        try {
            $beatmapset->watches()->create(['user_id' => Auth::user()->getKey()]);
        } catch (Exception $e) {
            if (!is_sql_unique_exception($e)) {
                throw $e;
            }
        }

        return response([], 204);
    }

    public function destroy($beatmapsetId)
    {
        $beatmapset = Beatmapset::findOrFail($beatmapsetId);

        $beatmapset->watches()->where('user_id', '=', Auth::user()->getKey())->delete();

        return response([], 204);
    }
}
