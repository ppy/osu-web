<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Transformers\Forum\ForumCoverTransformer;
use Auth;

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

    public function show($id)
    {
        $params = get_params(request()->all(), null, [
            'sort',
            'with_replies',
        ]);

        $user = auth()->user();

        $forum = Forum::with('subforums.subforums')->findOrFail($id);
        $lastTopics = Forum::lastTopics($forum);

        $sort = $params['sort'] ?? Topic::DEFAULT_SORT;
        $withReplies = $params['with_replies'] ?? null;

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

        $allTopics = array_merge($pinnedTopics->all(), $topics->all());
        $topicReadStatus = TopicTrack::readStatus($user, $allTopics);
        $topicReplyStatus = $user === null
            ? []
            : Post
                ::where('poster_id', $user->getKey())
                ->whereIn('topic_id', array_pluck($allTopics, 'topic_id'))
                ->distinct('topic_id')
                ->select('topic_id')
                ->get()
                ->keyBy('topic_id');

        $noindex = !$forum->enable_indexing;

        return ext_view('forum.forums.show', compact(
            'cover',
            'forum',
            'lastTopics',
            'noindex',
            'pinnedTopics',
            'sort',
            'topicReadStatus',
            'topicReplyStatus',
            'topics'
        ));
    }
}
