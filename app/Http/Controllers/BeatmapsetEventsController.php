<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\ModdingHistoryEventsBundle;

class BeatmapsetEventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:public', ['only' => ['index']]);

        return parent::__construct();
    }

    public function index()
    {
        $bundle = ModdingHistoryEventsBundle::forListing(null, request()->all());
        $jsonChunks = $bundle->toArray();
        $paginator = $bundle->getPaginator();
        $params = $bundle->getParams();

        if (is_api_request()) {
            return $jsonChunks;
        } else {
            return ext_view('beatmapset_events.index', compact('paginator', 'params', 'jsonChunks'));
        }
    }
}
