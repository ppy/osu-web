<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BeatmapsetVersionFile;
use Symfony\Component\HttpFoundation\Response;

class BeatmapsetVersionFilesController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
        $this->middleware('throttle:10,10');
    }

    public function download(string $id): Response
    {
        $versionFile = BeatmapsetVersionFile::findOrFail($id);
        $file = $versionFile->file;

        return \Response::streamDownload(
            function () use ($file) {
                echo $file->content();
            },
            $versionFile->filename,
            ['Content-Type' => 'application/octet-stream'],
        );
    }
}
