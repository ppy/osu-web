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
use App\Models\ContestVoteAggregate;
use Auth;
use Request;
use Cache;

class ContestsController extends Controller
{
    protected $section = 'community';

    public function show($id)
    {
        $contest = Contest::findOrFail($id);

        switch ($contest->type) {
            case 'art':
                return view('contests.art')
                    ->with('contest', $contest)
                    ->with('entries', $this->prepareEntries($contest));
                break;

            case 'beatmap':
                return view('contests.beatmap')
                    ->with('contest', $contest)
                    ->with('entries', $this->prepareEntries($contest));
                break;

            case 'music':
                return view('contests.music')
                    ->with('contest', $contest)
                    ->with('entries', $this->prepareEntries($contest));
                break;

            default:
                // error
                break;
        }
    }

    public function vote($id)
    {
        $user = Auth::user();
        $contest = Contest::findOrFail($id);
        $entry = $contest->entries()->findOrFail(Request::input('entry_id'));

        priv_check('ContestVote', $contest)->ensureCan();

        $contest->vote($user, $entry);

        return [
            'entries' => $this->prepareEntries($contest->fresh(['votes'])),
        ];
    }

    private function prepareEntries($contest)
    {
        $userVotes = [];
        $seed = time();
        if (Auth::check()) {
            $user = Auth::user();
            $seed = Auth::user()->user_id;
            $votes = ContestVote::where('contest_id', $contest->id)->where('user_id', $user->user_id)->get();
            $userVotes = $votes->map(function ($v) {
                return $v->contest_entry_id;
            })->toArray();
        }

        if ($contest->show_votes) {
            $voteAggregates = Cache::remember("contest_votes_{$contest->id}", 5, function () use ($contest) {
                return $contest->voteAggregates;
            });
        }

        // This mess should probably be moved into a transformer/helper...
        $entries = [];
        foreach ($contest->entries as $contestEntry) {
            $entry = [];
            $entry['id'] = $contestEntry->id;
            $entry['title'] = $contestEntry->masked_name;
            $entry['preview'] = $contestEntry->entry_url;
            $entry['cover_url'] = '/images/tmp/contest-cover-placeholder.png';
            $entry['selected'] = in_array($contestEntry->id, $userVotes, true);

            if ($contest->show_votes) {
                // add extra info for contests that are showing votes
                $entry['actual_name'] = $contestEntry->name;
                $entry['votes'] = $voteAggregates->where('contest_entry_id', $contestEntry->id)->first()->votes;
            }

            $entries[] = $entry;
        }

        if ($contest->show_votes) {
            // Sort results by number of votes desc
            usort($entries, function ($a, $b) {
                if ($a['votes'] == $b['votes']) {
                    return 0;
                }
                return ($a['votes'] > $b['votes']) ? -1 : 1;
            });
        } else {
            // We want the results to appear randomized to the user but be
            // deterministic (i.e. we don't want the rows shuffling each time
            // the user votes), so we seed based on user_id
            seeded_shuffle($entries, $seed);
        }

        // done after the shuffle otherwise the gallery_index is incorrect and breaks photoswipe
        if ($contest->type === 'art') {
            foreach ($entries as $i => $entry) {
                $size = fast_imagesize($entry['preview']);
                $entries[$i]['width'] = $size[0];
                $entries[$i]['height'] = $size[1];
                $entries[$i]['gallery_index'] = $i;
            }
        }

        return $entries;
    }
}
