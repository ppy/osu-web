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

use App\Models\Contest;
use Auth;

class ContestsController extends Controller
{
    protected $section = 'community';

    public function index()
    {
        $contests = Contest::orderBy('id', 'desc');

        if (!Auth::check() || !Auth::user()->isAdmin()) {
            $contests->where('visible', true);
        }

        return ext_view('contests.index', [
            'contests' => $contests->get(),
        ]);
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
            $contests = Contest::whereIn('id', $contestIds)
                ->orderByField('id', $contestIds)
                ->get();
        } else {
            $contests = collect([$contest]);
        }

        if ($contest->isVotingStarted()) {
            return ext_view('contests.voting', [
                'contestMeta' => $contest,
                'contests' => $contests,
            ]);
        } else {
            return ext_view('contests.enter', [
                'contestMeta' => $contest,
                'contest' => $contests->first(),
            ]);
        }
    }
}
