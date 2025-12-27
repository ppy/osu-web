<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Screenshot;
use Carbon\Carbon;
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
                'hash' => $this->hash($screenshot->getKey()),
            ]),
        ], 201);
    }

    public function show($screenshot, string $hash)
    {
        abort_if($this->hash($screenshot) !== $hash, 404);

        return $this->showBase($screenshot);
    }

    public function showLegacy($screenshot)
    {
        abort_if($screenshot >= config('osu.screenshots.legacy_id_cutoff'), 404);

        return $this->showBase($screenshot);
    }

    private function showBase($id)
    {
        $screenshot = Screenshot::findOrFail($id);
        $screenshot->hits++;
        $screenshot->last_access = Carbon::now();
        $screenshot->save();

        $file = $this->storage()->get("{$screenshot->getKey()}.jpg");

        abort_if(!$file, 404);

        return response()->stream(function () use ($file) {
            echo $file;
        }, 200, ['Content-Type' => 'image/jpeg']);
    }

    private function hash(int $id): string
    {
        return substr(md5($id.config('osu.screenshots.shared_secret')), 0, 4);
    }

    private function storage(): Filesystem
    {
        return Storage::disk("{$GLOBALS['cfg']['filesystems']['default']}-screenshot");
    }
}
