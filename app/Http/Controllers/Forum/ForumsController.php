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

use App\Models\Forum\Forum;
use App\Models\Forum\TopicTrack;
use App\Transformers\Forum\ForumCoverTransformer;
use Auth;
use Request;

class ForumsController extends Controller
{
    protected $section = 'community';

    public function __construct()
    {
        parent::__construct();

        view()->share('current_action', 'forum-forums-'.current_action());
    }

    public function index()
    {
        $forums = Forum::where('parent_id', 0)->with('subForums')->orderBy('left_id')->get();

        $forums = $forums->filter(function ($forum) {
            return priv_check('ForumView', $forum)->can();
        });

        return view('forum.forums.index', compact('forums'));
    }

    public function search()
    {
        $topicId = Request::input('topic_id');
        $forumId = Request::input('forum_id');
        $query = Request::input('q');

        $queryStringArray = [
            't' => $topicId,
            'fid[]' => $forumId,
            'keywords' => $query,
        ];

        return ujs_redirect('https://osu.ppy.sh/forum/search.php?'.http_build_query($queryStringArray));
    }

    public function show($id)
    {
        $forum = Forum::with('subForums')->findOrFail($id);

        $sort = explode('_', Request::input('sort'));
        $withReplies = Request::input('with_replies', '');

        priv_check('ForumView', $forum)->ensureCan();

        $cover = json_item(
            $forum->cover()->firstOrNew([]),
            new ForumCoverTransformer()
        );

        $showDeleted = priv_check('ForumTopicModerate')->can();

        $pinnedTopics = $forum->topics()->pinned()->showDeleted($showDeleted)->orderBy('topic_type', 'desc')->recent()->get();
        $topics = $forum->topics()->normal()->showDeleted($showDeleted)->recent(compact('sort', 'withReplies'))->paginate(30);

        $topicReadStatus = TopicTrack::readStatus(Auth::user(), $pinnedTopics, $topics);

        return view('forum.forums.show', compact('forum', 'topics', 'pinnedTopics', 'topicReadStatus', 'cover'));
    }
}
