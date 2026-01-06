<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Screenshot;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class ScreenshotsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'screenshot' => [
                'required',
                File::types(['jpeg'])
                    ->max(10_000),
            ],
        ]);

        datadog_increment('osu.screenshots');

        $screenshot = Screenshot::create(['user_id' => \Auth::user()->getKey()]);
        $screenshot->store($validated['screenshot']);

        return response()->json([
            'url' => $screenshot->url(),
        ]);
    }

    public function show($screenshot, string $hash)
    {
        // TODO: move this logic over from legacy web
        //       this empty method is left as a placeholder for the route used above to work
    }
}
