<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Screenshot;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Storage;

class ScreenshotsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'screenshot' => [
                'required',
                File::types(['jpeg']),
            ],
        ]);

        datadog_increment('osu.screenshots');

        $screenshot = new Screenshot();
        $screenshot->user_id = auth()->user()->getKey();
        $screenshot->save();

        $this->storage()->putFileAs('/', $validated['screenshot'], "{$screenshot->getKey()}.jpg");

        return response()->json([
            'url' => route('screenshots.show', [
                'screenshot' => $screenshot->getKey(),
                'hash' => substr(md5($screenshot->getKey().config('osu.screenshots.shared_secret')), 0, 4),
            ]),
        ], 201);
    }

    public function show($screenshot, string $hash)
    {
        // TODO: move this logic over from legacy web
        //       this empty method is left as a placeholder for the route used above to work
    }

    private function storage(): Filesystem
    {
        return Storage::disk("{$GLOBALS['cfg']['filesystems']['default']}-screenshot");
    }
}
