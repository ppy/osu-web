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

use App\Exceptions\ModelNotSavedException;
use App\Libraries\ForumUpdateNotifier;
use App\Libraries\NewForumTopic;
use App\Models\Forum\FeatureVote;
use App\Models\Forum\Forum;
use App\Models\Forum\PollOption;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicCover;
use App\Models\Forum\TopicPoll;
use App\Models\Forum\TopicWatch;
use App\Transformers\Forum\TopicCoverTransformer;
use Auth;
use DB;
use Illuminate\Http\Request as HttpRequest;
use Request;

class TopicsController extends Controller
{
    protected $section = 'community';

    public function __construct()
    {
        parent::__construct();

        view()->share('currentAction', 'forum-topics-'.current_action());

        $this->middleware('auth', ['only' => [
            'create',
            'lock',
            'preview',
            'reply',
            'store',
        ]]);
    }

    public function create()
    {
        $forum = Forum::findOrFail(request('forum_id'));

        priv_check('ForumTopicStore', $forum)->ensureCan();

        return view(
            'forum.topics.create',
            (new NewForumTopic($forum, Auth::user()))->toArray()
        );
    }

    public function issueTag($id)
    {
        $topic = Topic::findOrFail($id);

        priv_check('ForumModerate', $topic->forum)->ensureCan();

        $issueTag = presence(Request::input('issue_tag'));
        $state = get_bool(Request::input('state'));
        $type = 'issue_tag_'.$issueTag;

        if ($issueTag === null || !$topic->isIssue() || !in_array($issueTag, $topic::ISSUE_TAGS, true)) {
            abort(422);
        }

        $this->logModerate('LOG_ISSUE_TAG', compact('issueTag', 'state'), $topic);

        $method = $state ? 'setIssueTag' : 'unsetIssueTag';

        $topic->$method($issueTag);

        return js_view('forum.topics.replace_button', compact('topic', 'type', 'state'));
    }

    public function lock($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);

        $moderationPriv = priv_check('ForumModerate', $topic->forum);

        $moderationPriv->ensureCan();
        $userCanModerate = $moderationPriv->can();

        $type = 'lock';
        $state = get_bool(Request::input('lock'));
        $this->logModerate($state ? 'LOG_LOCK' : 'LOG_UNLOCK', [$topic->topic_title], $topic);
        $topic->lock($state);

        return js_view('forum.topics.replace_button', compact('topic', 'type', 'state', 'userCanModerate'));
    }

    public function move($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);
        $originForum = $topic->forum;
        $destinationForum = Forum::findOrFail(Request::input('destination_forum_id'));

        priv_check('ForumModerate', $originForum)->ensureCan();
        priv_check('ForumModerate', $destinationForum)->ensureCan();

        $this->logModerate('LOG_MOVE', [$originForum->forum_name], $topic);
        if ($topic->moveTo($destinationForum)) {
            return js_view('layout.ujs-reload');
        } else {
            abort(422);
        }
    }

    public function pin($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);

        priv_check('ForumModerate', $topic->forum)->ensureCan();

        $type = 'moderate_pin';
        $state = get_int(Request::input('pin'));
        DB::transaction(function () use ($topic, $type, $state) {
            $topic->pin($state);

            $this->logModerate(
                'LOG_TOPIC_TYPE',
                ['title' => $topic->topic_title, 'type' => $topic->topic_type],
                $topic
            );
        });

        return js_view('forum.topics.replace_button', compact('topic', 'type', 'state'));
    }

    public function reply(HttpRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);

        priv_check('ForumTopicReply', $topic)->ensureCan();

        try {
            $post = $topic->addPostOrExplode(Auth::user(), request('body'));
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        if ($post->post_id !== null) {
            $posts = collect([$post]);
            $firstPostPosition = $topic->postPosition($post->post_id);

            $post->markRead(Auth::user());
            ForumUpdateNotifier::onReply([
                'topic' => $topic,
                'post' => $post,
                'user' => Auth::user(),
            ]);

            return view('forum.topics._posts', compact('posts', 'firstPostPosition', 'topic'));
        }
    }

    public function show($id)
    {
        $postStartId = Request::input('start');
        $postEndId = get_int(Request::input('end'));
        $nthPost = get_int(Request::input('n'));
        $skipLayout = Request::input('skip_layout') === '1';
        $jumpTo = null;

        $topic = Topic
            ::with([
                'forum.cover',
                'pollOptions.votes',
                'pollOptions.post',
            ])->withTrashed()->findOrFail($id);

        $userCanModerate = priv_check('ForumModerate', $topic->forum)->can();

        if ($topic->trashed() && !$userCanModerate) {
            abort(404);
        }

        if ($topic->forum === null) {
            abort(404);
        }

        priv_check('ForumView', $topic->forum)->ensureCan();

        $posts = $topic->posts()->showDeleted($userCanModerate);

        if ($postStartId === 'unread') {
            $postStartId = Post::lastUnreadByUser($topic, Auth::user());
        } else {
            $postStartId = get_int($postStartId);
        }

        if ($nthPost !== null) {
            $post = $topic->nthPost($nthPost);
            if ($post) {
                $postStartId = $post->post_id;
            }
        }

        if (!$skipLayout) {
            foreach ([$postStartId, $postEndId, 0] as $jumpPoint) {
                if ($jumpPoint === null) {
                    continue;
                }

                $jumpTo = $jumpPoint;
                break;
            }
        }

        if ($postStartId !== null && !$skipLayout) {
            // move starting post up by ten to avoid hitting
            // page autoloader right after loading the page.
            $postPosition = $topic->postPosition($postStartId);
            $post = $topic->nthPost($postPosition - 10);
            $postStartId = $post->post_id;
        }

        if ($postStartId !== null) {
            $posts = $posts
                ->where('post_id', '>=', $postStartId);
        } elseif ($postEndId !== null) {
            $posts = $posts
                ->where('post_id', '<=', $postEndId)
                ->orderBy('post_id', 'desc');
        }

        $posts = $posts
            ->take(20)
            ->with('forum')
            ->with('topic')
            ->with('user.rank')
            ->with('user.country')
            ->with('user.supporterTags')
            ->get()
            ->sortBy('post_id');

        if ($posts->count() === 0) {
            abort($skipLayout ? 204 : 404);
        }

        $firstPostId = $topic->posts()
            ->showDeleted($userCanModerate)
            ->orderBy('post_id', 'asc')
            ->select('post_id')
            ->first()
            ->post_id;

        $firstShownPostId = $posts->first()->post_id;

        // position of the first post, incremented in the view
        // to generate positions of further posts
        $firstPostPosition = $topic->postPosition($firstShownPostId);

        $pollSummary = PollOption::summary($topic, Auth::user());

        $posts->last()->markRead(Auth::user());

        $template = $skipLayout ? '_posts' : 'show';

        $cover = json_item(
            $topic->cover()->firstOrNew([]),
            new TopicCoverTransformer()
        );

        $watch = TopicWatch::lookup($topic, Auth::user());

        return view(
            "forum.topics.{$template}",
            compact(
                'cover',
                'watch',
                'jumpTo',
                'pollSummary',
                'posts',
                'firstPostPosition',
                'firstPostId',
                'topic',
                'userCanModerate'
            )
        );
    }

    public function store(HttpRequest $request)
    {
        $forum = Forum::findOrFail($request->get('forum_id'));

        priv_check('ForumTopicStore', $forum)->ensureCan();

        if (get_bool($request->get('with_poll'))) {
            $pollParams = get_params($request, 'forum_topic_poll', [
                'length_days:int',
                'max_options:int',
                'options:string_split',
                'title',
                'vote_change:bool',
            ]);

            $poll = (new TopicPoll())->fill($pollParams);

            if (!$poll->isValid()) {
                return error_popup($poll->validationErrors()->toSentence());
            }
        }

        $params = [
            'title' => $request->get('title'),
            'user' => Auth::user(),
            'body' => $request->get('body'),
            'cover' => TopicCover::findForUse(presence($request->input('cover_id')), Auth::user()),
        ];

        try {
            $topic = Topic::createNew($forum, $params, $poll ?? null);
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        ForumUpdateNotifier::onNew([
            'topic' => $topic,
            'post' => $topic->posts->last(),
            'user' => Auth::user(),
        ]);

        return ujs_redirect(route('forum.topics.show', $topic));
    }

    public function update($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);

        if (!priv_check('ForumTopicEdit', $topic)->can()) {
            abort(403);
        }

        $params = get_params(request(), 'forum_topic', ['topic_title']);

        if ($topic->update($params)) {
            if ((Auth::user()->user_id ?? null) !== $topic->topic_poster) {
                $this->logModerate(
                    'LOG_EDIT_TOPIC',
                    [$topic->topic_title],
                    $topic
                );
            }

            return [];
        } else {
            return error_popup($topic->validationErrors()->toSentence());
        }
    }

    public function vote($topicId)
    {
        $topic = Topic::findOrFail($topicId);

        priv_check('ForumTopicVote', $topic)->ensureCan();

        $params = get_params(Request::input(), 'forum_topic_vote', ['option_ids:int[]']);
        $params['user_id'] = Auth::user()->user_id;
        $params['ip'] = Request::ip();

        if ($topic->vote()->fill($params)->save()) {
            return ujs_redirect(route('forum.topics.show', $topic->topic_id));
        } else {
            return error_popup($topic->vote()->validationErrors()->toSentence());
        }
    }

    public function voteFeature($topicId)
    {
        $star = FeatureVote::createNew([
            'user_id' => Auth::user()->user_id,
            'topic_id' => $topicId,
        ]);

        if ($star->getKey() !== null) {
            return ujs_redirect(route('forum.topics.show', $topicId));
        } else {
            return error_popup($star->validationErrors()->toSentence());
        }
    }
}
