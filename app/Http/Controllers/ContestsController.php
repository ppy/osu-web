<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
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

use App\Models\Contest;
use Auth;
use DB;

class ContestsController extends Controller
{
    protected $section = 'community';

    public function index()
    {
        $contests = Contest::where('visible', true)->orderBy('id', 'desc')->get();

        return view('contests.index')
            ->with('contests', $contests);
    }

    public function show($id)
    {
        $contest = Contest::findOrFail($id);

        $user = Auth::user();
        if (!$contest->visible && (!$user || !$user->isAdmin())) {
            abort(404);
        }

        if ($contest->isVotingStarted() && isset($contest->extra_options['children'])) {
            $contestIds = $contest->extra_options['children'];
        } else {
            $contestIds = [$id];
        }

        $contests = Contest::with('entries', 'entries.contest', 'entries.user')
            ->whereIn('id', $contestIds)
            ->orderByRaw(DB::raw('FIELD(id, '.implode(',', $contestIds).')'))
            ->get();

        if ($contest->isVotingStarted()) {
            return view('contests.voting')
                    ->with('contestMeta', $contest)
                    ->with('contests', $contests);
        } else {
            return view('contests.enter')
                ->with('contestMeta', $contest)
                ->with('contest', $contests->first());
        }
    }
}
