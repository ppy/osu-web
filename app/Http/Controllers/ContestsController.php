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
use App\Models\ContestVote;
use Auth;
use Request;

class ContestsController extends Controller
{
    protected $section = 'community';

    public function show($id)
    {
        $contest = Contest::with('entries')->with('entries.contest')->findOrFail($id);

        $user = Auth::user();
        if (!$contest->visible && (!$user || !$user->isAdmin())) {
            abort(404);
        }

        if ($contest->isVotingStarted()) {
            return view("contests.voting.{$contest->type}")
                    ->with('contest', $contest)
                    ->with('contestJson', $contest->defaultJson($user));
        } else {
            return view('contests.enter')
                ->with('contest', $contest)
                ->with('contestJson', $contest->defaultJson($user))
                ->with('userEntriesJson', json_encode($contest->userEntries($user)));
        }
    }
}
