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
use App\Transformers\UserContestEntryTransformer;
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
                ->with('userEntriesJson', json_encode($this->userEntries($contest)));
        }
    }

    public function vote($id)
    {
        $user = Auth::user();
        $contest = Contest::with('entries')->with('entries.contest')->findOrFail($id);
        $entry = $contest->entries()->findOrFail(Request::input('entry_id'));

        priv_check('ContestVote', $contest)->ensureCan();

        $contest->vote($user, $entry);

        return $contest->defaultJson($user);
    }

    public function submit($id)
    {
        if (Request::hasFile('entry') !== true || Request::file('entry')->getClientOriginalExtension() !== 'osu') { // todo: unhardcode :|
            abort(422);
        }

        $user = Auth::user();
        $contest = Contest::findOrFail($id);

        priv_check('ContestEnter', $contest)->ensureCan();

        UserContestEntry::upload(
            Request::file('entry'),
            $user,
            $contest
        );

        return $this->userEntries($contest);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $contest = Contest::findOrFail($id);
        $contestEntry = UserContestEntry::where(['contest_id' => $contest->id, 'user_id' => $user->user_id])->findOrFail(Request::input('entry_id'));

        priv_check('ContestDeleteEntry', $contestEntry)->ensureCan();

        $contestEntry->deleteWithFile();

        return $this->userEntries($contest);
    }

    private function userEntries($contest)
    {
        return fractal_api_serialize_collection(
            UserContestEntry::where(['contest_id' => $contest->id, 'user_id' => Auth::user()->user_id])->get(),
            new UserContestEntryTransformer
        );
    }
}
