<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Models\Forum\TopicWatch;
use Auth;

class TopicWatchesController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function index()
    {
        $topics = Topic::watchedByUser(Auth::user())->paginate(50);
        $topicReadStatus = TopicTrack::readStatus(Auth::user(), $topics);
        $topicWatchStatus = TopicWatch::watchStatus(Auth::user(), $topics);

        $counts = [
            'total' => $topics->total(),
            'unread' => TopicWatch::unreadCount(Auth::user()),
        ];

        return ext_view(
            'forum.topic_watches.index',
            compact('topics', 'topicReadStatus', 'topicWatchStatus', 'counts')
        );
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
