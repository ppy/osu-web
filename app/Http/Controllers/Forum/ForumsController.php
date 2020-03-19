<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Forum;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Transformers\Forum\ForumCoverTransformer;
use Auth;
use Request;

class ForumsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $forums = Forum
            ::where('parent_id', 0)
            ->with('subforums.subforums')
            ->orderBy('left_id')
            ->get();

        $lastTopics = Forum::lastTopics();

        $forums = $forums->filter(function ($forum) {
            return priv_check('ForumView', $forum)->can();
        });

        return ext_view('forum.forums.index', compact('forums', 'lastTopics'));
    }

    public function markAsRead()
    {
        if (Auth::check()) {
            $forumId = get_int(request('forum_id'));
            if ($forumId === null) {
                Forum::markAllAsRead(Auth::user());
            } else {
                $recursive = get_bool(request('recursive')) ?? false;
                $forum = Forum::findOrFail($forumId);
                priv_check('ForumView', $forum)->ensureCan();
                $forum->markAsRead(Auth::user(), $recursive);
            }
        }

        return ext_view('layout.ujs-reload', [], 'js');
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
        $forum = Forum::with('subforums.subforums')->findOrFail($id);
        $lastTopics = Forum::lastTopics($forum);

        $sort = Request::input('sort') ?? Topic::DEFAULT_SORT;
        $withReplies = Request::input('with_replies', '');

        priv_check('ForumView', $forum)->ensureCan();

        $cover = json_item(
            $forum->cover()->firstOrNew([]),
            new ForumCoverTransformer()
        );

        $showDeleted = priv_check('ForumModerate', $forum)->can();

        $pinnedTopics = $forum->topics()
            ->with('forum')
            ->pinned()
            ->showDeleted($showDeleted)
            ->orderBy('topic_type', 'desc')
            ->recent()
            ->get();
        $topics = $forum->topics()
            ->with('forum')
            ->normal()
            ->showDeleted($showDeleted)
            ->recent(compact('sort', 'withReplies'))
            ->paginate(30);

        $topicReadStatus = TopicTrack::readStatus(Auth::user(), $pinnedTopics, $topics);

        return ext_view('forum.forums.show', compact(
            'cover',
            'forum',
            'lastTopics',
            'pinnedTopics',
            'sort',
            'topicReadStatus',
            'topics'
        ));
    }
}
