<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Transformers\Forum\ForumCoverTransformer;
use App\Transformers\Forum\ForumTransformer;
use App\Transformers\Forum\TopicTransformer;
use Auth;

/**
 * @group Forum
 */
class ForumsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public', ['only' => ['index', 'show']]);
    }

    /**
     * Get Forum Listing
     *
     * Get top-level forums, their subforums (max 2 deep), and their last topics.
     *
     * ---
     *
     * ### Response Format
     *
     * Field       | Type                         |
     * ----------- | ---------------------------- |
     * forums      | [Forum](#forum)[]            |
     * last_topics | [ForumTopic](#forum-topic)[] |
     *
     * @response {
     *   "forums": [
     *     { "forum_id": 1, "...": "..." },
     *     { "forum_id": 2, "...": "..." }
     *   ]
     * }
     */
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

        if (is_api_request()) {
            return [
                'forums' => json_collection($forums, new ForumTransformer(), ['subforums.subforums']),
            ];
        }

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

    /**
     * Get Forum and Topics
     *
     * Get a forum by id, its pinned topics, recent topics, and its subforums.
     *
     * ---
     *
     * ### Response Format
     *
     * Field         | Type                         |
     * ------------- | ---------------------------- |
     * forum         | [Forum](#forum)              |
     * topics        | [ForumTopic](#forum-topic)[] |
     * pinned_topics | [ForumTopic](#forum-topic)[] |
     *
     * @urlParam forum integer required Id of the forum. Example: 1
     *
     * @response {
     *   "forum": { "id": 1, "...": "..." },
     *   "topics": [
     *     { "id": 1, "...": "..." },
     *     { "id": 2, "...": "..." },
     *   ],
     *   "pinned_topics": [
     *     { "id": 1, "...": "..." },
     *     { "id": 2, "...": "..." },
     *   ]
     * }
     */
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
            ->recent(compact('sort', 'withReplies'));

        if (is_api_request()) {
            $topics->limit(Topic::PER_PAGE);

            return [
                'forum' => json_item($forum, new ForumTransformer(), ['subforums.subforums']),
                'topics' => json_collection($topics, new TopicTransformer()),
                'pinned_topics' => json_collection($pinnedTopics, new TopicTransformer()),
            ];
        }

        $topics = $topics->paginate();

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

        $cover = json_item(
            $forum->cover()->firstOrNew([]),
            new ForumCoverTransformer()
        );

        $noindex = !$forum->enable_indexing;

        set_opengraph($forum);

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
