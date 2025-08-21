<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

/**
 * @group Account
 */
class BeatmapsetFavouritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('require-scopes:identify');
    }

    public function index()
    {
        return [
            'beatmapset_ids' => \Auth::user()->favourites()->has('beatmapset')->pluck('beatmapset_id'),
        ];
    }
}
