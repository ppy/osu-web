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
use Request;

class ContestsController extends Controller
{
    protected $section = 'community';

    public function show($id)
    {
        $contest = Contest::with('entries')->findOrFail($id);

        // TODO: make this logic not music-contest specific
        $tracks = $this->prepareTracks($contest);

        return view('contests.show')
            ->with('contest', $contest)
            ->with('tracks', $tracks);
    }

    public function vote($id)
    {
        $user = Auth::user();
        $contest = Contest::with('entries')->findOrFail($id);
        $entry = $contest->entries()->findOrFail(Request::input('entry_id'));

        priv_check('ContestVote', $contest)->ensureCan();

        $contest->vote($user, $entry);

        // get updated votes before we return the track data
        $contest->fresh(['votes']);

        return [
            'tracks' => $this->prepareTracks($contest),
        ];
    }

    private function prepareTracks($contest)
    {
        $votes = [];
        $seed = time();
        if (Auth::check()) {
            $user = Auth::user();
            $seed = Auth::user()->user_id;
            $votes = $contest->fresh(['votes'])->votes->where('user_id', $user->user_id);
            $votes = $votes->map(function ($v) {
                return $v->contest_entry_id;
            })->toArray();
        }

        // This mess should probably be moved into a transformer/helper...
        $tracks = [];
        foreach ($contest->entries as $entry) {
            $track = [];
            $track['id'] = $entry->id;
            $track['title'] = $entry->masked_name;
            $track['preview'] = $entry->entry_url;
            $track['cover_url'] = '/images/tmp/blah.png';
            $track['selected'] = in_array($entry->id, $votes, true);
            $tracks[] = $track;
        }

        // We want the results to appear randomized to the user but be
        // deterministic (i.e. we don't want the rows shuffling each time
        // the user votes), so we seed based on user_id
        seeded_shuffle($tracks, $seed);

        return $tracks;
    }
}
