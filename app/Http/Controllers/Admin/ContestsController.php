<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin;

use App\Models\Contest;
use App\Models\UserContestEntry;

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
        $contest = Contest::findOrFail($id);
        $entries = UserContestEntry::withTrashed()
            ->where('contest_id', $id)
            ->with('user')
            ->get();

        return ext_view('admin.contests.show', [
            'contest' => $contest,
            'entries' => json_collection($entries, 'UserContestEntry', ['user']),
        ]);
    }

    public function gimmeZip($id)
    {
        set_time_limit(300);

        $contest = Contest::findOrFail($id);
        $entries = UserContestEntry::where('contest_id', $id)->with('user')->get();

        $tmpBase = sys_get_temp_dir()."/c{$id}-".time();
        $workingFolder = "$tmpBase/working";
        $outputFolder = "$tmpBase/out";

        try {
            if (!is_dir($workingFolder)) {
                mkdir($workingFolder, 0755, true);
            }
            if (!is_dir($outputFolder)) {
                mkdir($outputFolder, 0755, true);
            }

            // fetch 'em
            foreach ($entries as $entry) {
                $targetDir = "{$workingFolder}/".($entry->user ?? (new \App\Models\DeletedUser()))->username." ({$entry->user_id})/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                copy($entry->fileUrl(), $targetDir.sanitize_filename($entry->original_filename));
            }

            // zip 'em
            $zipOutput = "{$outputFolder}/contest-{$id}.zip";

            $zip = new \ZipArchive();
            $zip->open($zipOutput, \ZipArchive::CREATE);
            foreach (glob("{$workingFolder}/**/*.*") as $file) {
                // we just want the path relative to the working folder root
                $new_filename = str_replace("$workingFolder/", '', $file);
                $zip->addFile($file, $new_filename);
            }
            $zip->close();

            // send 'em
            header('Content-Disposition: attachment; filename='.basename($zipOutput));
            header('Content-Type: application/zip');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: '.filesize($zipOutput));
            readfile($zipOutput);
        } finally {
            deltree($tmpBase);
        }
    }
}
