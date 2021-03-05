<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\BeatmapsetDiscussionVotesBundle;

class BeatmapsetDiscussionVotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:public');

        return parent::__construct();
    }

    public function index()
    {
        $bundle = new BeatmapsetDiscussionVotesBundle(request()->all());

        if (is_api_request()) {
            return $bundle->toArray();
        }

        $votes = $bundle->getPaginator();

        return ext_view('beatmapset_discussion_votes.index', compact('votes'));
    }
}
