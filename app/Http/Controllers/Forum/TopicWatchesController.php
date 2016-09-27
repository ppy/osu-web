<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Http\Controllers\Forum;

use App\Models\Forum\TopicTrack;
use App\Models\Forum\TopicWatch;
use Auth;

class TopicWatchesController extends Controller
{
    protected $section = 'community';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $topics = TopicWatch::with('topic')
            ->with('topic.forum')
            ->where('user_id', Auth::user()->user_id)
            ->get()
            ->pluck('topic')
            ->filter(function ($topic) {
                return
                    $topic !== null &&
                    priv_check('ForumTopicWatchAdd', $topic)->can();
            })
            ->sortByDesc('topic_last_post_time')
            ->all();

        $topicReadStatus = TopicTrack::readStatus(Auth::user(), $topics);

        return view(
            'forum.topic_watches.index',
            compact('topics', 'topicReadStatus')
        );
    }
}
