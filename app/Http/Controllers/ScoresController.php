<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
