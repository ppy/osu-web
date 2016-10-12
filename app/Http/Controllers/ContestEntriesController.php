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
use App\Models\UserContestEntry;
use Auth;
use Request;

class ContestEntriesController extends Controller
{
    protected $section = 'community';

    public function vote($contest_id, $contest_entry_id)
    {
        $user = Auth::user();
        $contest = Contest::with('entries')->with('entries.contest')->findOrFail($contest_id);
        $entry = $contest->entries()->findOrFail($contest_entry_id);

        priv_check('ContestVote', $contest)->ensureCan();

        $contest->vote($user, $entry);

        return $contest->defaultJson($user);
    }

    public function submit($contest_id)
    {
        if (Request::hasFile('entry') !== true || Request::file('entry')->getClientOriginalExtension() !== 'osu') { // todo: unhardcode :|
            abort(422);
        }

        $user = Auth::user();
        $contest = Contest::findOrFail($contest_id);

        priv_check('ContestEnter', $contest)->ensureCan();

        UserContestEntry::upload(
            Request::file('entry'),
            $user,
            $contest
        );

        return $contest->userEntries($user);
    }

    public function delete($contest_id, $contest_entry_id)
    {
        $user = Auth::user();
        $contest = Contest::findOrFail($contest_id);
        $contestEntry = UserContestEntry::where(['contest_id' => $contest->id, 'user_id' => $user->user_id])->findOrFail($contest_entry_id);

        priv_check('ContestDeleteEntry', $contestEntry)->ensureCan();

        $contestEntry->deleteWithFile();

        return $contest->userEntries($user);
    }
}
