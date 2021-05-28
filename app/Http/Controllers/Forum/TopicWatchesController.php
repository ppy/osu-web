<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Topic;
use App\Models\Forum\TopicWatch;
use Auth;

class TopicWatchesController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function update($topicId)
    {
        $topic = Topic::findOrFail($topicId);
        $state = request('state');

        if ($state !== 'not_watching') {
            priv_check('ForumTopicWatch', $topic)->ensureCan();
        }

        $watch = TopicWatch::setState($topic, Auth::user(), $state);

        switch (request('return')) {
            case 'index':
                return response([], 204);

            default:
                return ext_view('forum.topics.replace_watch_button', [
                    'topic' => $topic,
                    'state' => $watch,
                ], 'js');
        }
    }
}
