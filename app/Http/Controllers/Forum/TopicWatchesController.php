<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Models\Forum\TopicWatch;
use Auth;

class TopicWatchesController extends Controller
{
    protected $section = 'community';
    protected $actionPrefix = 'forum-topic-watches-';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function destroy($topicId)
    {
        $topic = Topic::findOrFail($topicId);
        TopicWatch::lookup($topic, Auth::user())->delete();

        return $this->returnAction($topic, false);
    }

    public function index()
    {
        $topics = Topic::watchedByUser(Auth::user())->paginate(50);
        $topicReadStatus = TopicTrack::readStatus(Auth::user(), $topics);

        $counts = [
            'total' => $topics->total(),
            'unread' => TopicWatch::unreadCount(Auth::user()),
        ];

        return view(
            'forum.topic_watches.index',
            compact('topics', 'topicReadStatus', 'counts')
        );
    }

    public function update($topicId)
    {
        $topic = Topic::findOrFail($topicId);
        $watch = TopicWatch::lookup($topic, Auth::user());

        priv_check('ForumTopicWatch', $topic)->ensureCan();

        try {
            $watch->save();
        } catch (Exception $e) {
            if (!is_sql_unique_exception($e)) {
                throw $e;
            }
        }

        return $this->returnAction($topic, true);
    }

    private function returnAction($topic, $state)
    {
        switch (request('return')) {
            case 'index':

                return response([], 204);
            default:
                $type = 'watch';

                return js_view('forum.topics.replace_button', compact('topic', 'type', 'state'));
        }
    }
}
