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

use App\Models\Score\Best\Model as ScoreBest;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ScoresController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function download($mode, $id)
    {
        $score = ScoreBest::getClassByString($mode)
            ::where('score_id', $id)
            ->where('replay', true)
            ->firstOrFail();

        $replayFile = $score->replayFile();
        if ($replayFile === null) {
            abort(404);
        }

        try {
            $filename = "replay-{$mode}_{$score->beatmap_id}_{$score->getKey()}.osr";
            $content = $replayFile->get();

            return response()->streamDownload(function () use ($replayFile, $content) {
                echo $replayFile->headerChunk();
                echo pack('i', strlen($content));
                echo $content;
                echo $replayFile->endChunk();
            }, $filename, ['Content-Type' => 'application/octet-stream']);
        } catch (FileNotFoundException $e) {
            // missing from storage.
            log_error($e);
            abort(404);
        }
    }
}
