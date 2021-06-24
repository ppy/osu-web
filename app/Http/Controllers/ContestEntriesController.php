<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestEntry;
use App\Models\UserContestEntry;
use Auth;
use Request;

class ContestEntriesController extends Controller
{
    public function vote($id)
    {
        $user = Auth::user();
        $entry = ContestEntry::findOrFail($id);
        $contest = Contest::with('entries')->with('entries.contest')->findOrFail($entry->contest_id);

        priv_check('ContestVote', $contest)->ensureCan();

        $contest->vote($user, $entry);

        return $contest->defaultJson($user);
    }

    public function store()
    {
        if (Request::hasFile('entry') !== true) {
            abort(422);
        }

        $user = Auth::user();
        $contest = Contest::findOrFail(Request::input('contest_id'));

        priv_check('ContestEntryStore', $contest)->ensureCan();

        $allowedExtensions = [];
        $maxFilesize = 0;
        switch ($contest->type) {
            case 'art':
                $allowedExtensions[] = 'jpg';
                $allowedExtensions[] = 'jpeg';
                $allowedExtensions[] = 'png';
                $maxFilesize = 8 * 1024 * 1024;
                break;
            case 'beatmap':
                $allowedExtensions[] = 'osu';
                $allowedExtensions[] = 'osz';
                $maxFilesize = 32 * 1024 * 1024;
                break;
            case 'music':
                $allowedExtensions[] = 'mp3';
                $maxFilesize = 16 * 1024 * 1024;
                break;
        }

        if (!in_array(strtolower(Request::file('entry')->getClientOriginalExtension()), $allowedExtensions, true)) {
            abort(422);
        }

        if (Request::file('entry')->getSize() > $maxFilesize) {
            abort(413);
        }

        UserContestEntry::upload(
            Request::file('entry'),
            $user,
            $contest
        );

        return $contest->userEntries($user);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $entry = UserContestEntry::where(['user_id' => $user->user_id])->findOrFail($id);
        $contest = Contest::findOrFail($entry->contest_id);

        priv_check('ContestEntryDestroy', $entry)->ensureCan();

        $entry->deleteWithFile();

        return $contest->userEntries($user);
    }
}
