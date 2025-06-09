<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin;

use App\Models\Contest;
use App\Models\ContestJudgeVote;
use App\Models\DeletedUser;
use App\Models\UserContestEntry;
use ZipStream\ZipStream;

class ContestsController extends Controller
{
    public function index()
    {
        return ext_view('admin.contests.index', [
            'contests' => Contest::orderBy('id', 'desc')->get(),
        ]);
    }

    public function show($id)
    {
        $contest = Contest::with('judges')
            ->withCount('entries')
            ->findOrFail($id);

        $entries = UserContestEntry::withTrashed()
            ->where('contest_id', $id)
            ->with('user')
            ->get();

        if ($contest->isJudged()) {
            $judgeVoteCounts = ContestJudgeVote::whereIn('contest_entry_id', $contest->entries()->pluck('id'))
                ->groupBy('user_id')
                ->selectRaw('COUNT(*) as judge_vote_count, user_id')
                ->get()
                ->keyBy('user_id');
        }

        return ext_view('admin.contests.show', [
            'contest' => $contest,
            'entries' => json_collection($entries, 'UserContestEntry', ['user']),
            'judgeVoteCounts' => $judgeVoteCounts ?? null,
        ]);
    }

    public function gimmeZip($id)
    {
        // doesn't actually work in octane
        set_time_limit(300);

        Contest::findOrFail($id);
        $entries = UserContestEntry::where('contest_id', $id)->with('user')->get();

        $zipOutput = "contest-{$id}.zip";

        return response()->streamDownload(function () use ($entries) {
            $zip = new ZipStream();

            $deletedUser = new DeletedUser();
            foreach ($entries as $entry) {
                $targetDir = ($entry->user ?? $deletedUser)->username." ({$entry->user_id})";
                $filename = sanitize_filename($entry->original_filename);
                $zip->addFile("$targetDir/{$filename}", $entry->file()->get());
            }

            $zip->finish();
        }, $zipOutput, ['content-type' => 'application/zip']);
    }
}
