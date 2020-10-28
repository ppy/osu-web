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

        $this->middleware('auth', ['except' => [
            'show',
        ]]);

        $this->middleware('require-scopes:public');
    }

    public function download($mode, $id)
    {
        // don't limit downloading replays of restricted users for review purpose
        $score = ScoreBest::getClassByString($mode)
            ::where('score_id', $id)
            ->where('replay', true)
            ->firstOrFail();

        if (!is_api_request() && !from_app_url()) {
            return ujs_redirect(route('scores.show', ['score' => $id, 'mode' => $mode]));
        }

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

    public function show($mode, $id)
    {
        $score = ScoreBest::getClassByString($mode)
            ::whereHas('beatmap.beatmapset')
            ->visibleUsers()
            ->findOrFail($id);

        $scoreJson = json_item($score, 'Score', [
            'beatmap.max_combo',
            'beatmapset',
            'rank_country',
            'rank_global',
            'user.cover',
            'user.country',
        ]);

        if (is_json_request()) {
            return $scoreJson;
        }

        return ext_view('scores.show', compact('score', 'scoreJson'));
    }
}
