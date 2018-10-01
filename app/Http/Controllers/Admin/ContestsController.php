<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Http\Controllers\Admin;

use App\Models\Contest;
use App\Models\UserContestEntry;

class ContestsController extends Controller
{
    public function index()
    {
        $contests = Contest::orderBy('id', 'desc')->get();

        return view('admin.contests.index')
          ->with('contests', $contests);
    }

    public function show($id)
    {
        $contest = Contest::findOrFail($id);
        $entries = UserContestEntry::withTrashed()
            ->where('contest_id', $id)
            ->with('user')
            ->get();

        return view('admin.contests.show')
            ->with([
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
                $targetDir = "{$workingFolder}/".($entry->user ?? (new \App\Models\DeletedUser))->username." ({$entry->user_id})/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                copy($entry->fileUrl(), $targetDir.sanitize_filename($entry->original_filename));
            }

            // zip 'em
            $zipOutput = "{$outputFolder}/contest-{$id}.zip";

            $zip = new \ZipArchive;
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
