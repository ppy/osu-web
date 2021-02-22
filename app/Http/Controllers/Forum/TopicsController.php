<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Exceptions\ModelNotSavedException;
use App\Jobs\Notifications\ForumTopicReply;
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
use Request;

class TopicsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

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

        return ext_view(
            'forum.topics.create',
            (new NewForumTopic($forum, Auth::user()))->toArray()
        );
    }

    public function destroy($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);

        priv_check('ForumTopicDelete', $topic)->ensureCan();

        DB::transaction(function () use ($topic) {
            if ((auth()->user()->user_id ?? null) !== $topic->topic_poster) {
                $this->logModerate(
                    'LOG_DELETE_TOPIC',
                    [$topic->topic_title],
                    $topic
                );
            }

            if (!$topic->delete()) {
                throw new ModelNotSavedException($topic->validationErrors()->toSentence());
            }
        });

        if (priv_check('ForumModerate', $topic->forum)->can()) {
            return ext_view('forum.topics.delete', ['post' => $topic->firstPost], 'js');
        } else {
            return ujs_redirect(route('forum.forums.show', $topic->forum));
        }
    }

    public function restore($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);

        priv_check('ForumModerate', $topic->forum)->ensureCan();

        DB::transaction(function () use ($topic) {
            $this->logModerate(
                'LOG_RESTORE_TOPIC',
                [$topic->topic_title],
                $topic
            );

            if (!$topic->restore()) {
                throw new ModelNotSavedException($topic->validationErrors()->toSentence());
            }
        });

        return ext_view('forum.topics.restore', ['post' => $topic->firstPost], 'js');
    }

    public function editPollGet($topicId)
    {
        $topic = Topic::findOrFail($topicId);

        priv_check('ForumTopicPollEdit', $topic)->ensureCan();

        return ext_view('forum.topics._edit_poll', compact('topic'));
    }

    public function editPollPost($topicId)
    {
        $topic = Topic::findOrFail($topicId);

        priv_check('ForumTopicPollEdit', $topic)->ensureCan();

        $poll = (new TopicPoll())->fill($this->getPollParams());
        $poll->setTopic($topic);

        $topic->getConnection()->transaction(function () use ($poll, $topic) {
            if (!$poll->save()) {
                return;
            }

            if (Auth::user()->getKey() !== $topic->topic_poster) {
                $this->logModerate(
                    'LOG_EDIT_POLL',
                    [$topic->poll_title],
                    $topic
                );
            }
        });

        if ($poll->validationErrors()->isAny()) {
            return error_popup($poll->validationErrors()->toSentence());
        }

        $pollSummary = PollOption::summary($topic, Auth::user());
        $canEditPoll = $poll->canEdit();

        return ext_view('forum.topics._poll', compact('canEditPoll', 'pollSummary', 'topic'));
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

        return ext_view('forum.topics.replace_button', compact('topic', 'type', 'state'), 'js');
    }

    public function lock($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);

        priv_check('ForumModerate', $topic->forum)->ensureCan();

        $type = 'lock';
        $state = get_bool(Request::input('lock'));
        $this->logModerate($state ? 'LOG_LOCK' : 'LOG_UNLOCK', [$topic->topic_title], $topic);
        $topic->lock($state);

        return ext_view('forum.topics.replace_button', compact('topic', 'type', 'state'), 'js');
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
            return ext_view('layout.ujs-reload', [], 'js');
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
        DB::transaction(function () use ($topic, $state) {
            $topic->pin($state);

            $this->logModerate(
                'LOG_TOPIC_TYPE',
                ['title' => $topic->topic_title, 'type' => $topic->topic_type],
                $topic
            );
        });

        return ext_view('forum.topics.replace_button', compact('topic', 'type', 'state'), 'js');
    }

    public function reply($id)
    {
        $topic = Topic::findOrFail($id);

        priv_check('ForumTopicReply', $topic)->ensureCan();

        try {
            $post = Post::createNew($topic, auth()->user(), get_string(request('body')));
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        $posts = collect([$post]);
        $firstPostPosition = $topic->postPosition($post->post_id);

        $post->markRead(Auth::user());
        (new ForumTopicReply($post, auth()->user()))->dispatch();

        return ext_view('forum.topics._posts', compact('posts', 'firstPostPosition', 'topic'));
    }

    public function show($id)
    {
        $params = get_params(request()->all(), null, [
            'start', // either number or "unread"
            'end:int',
            'n:int',
            'skip_layout:bool',
            'with_deleted:bool',
        ]);

        $postStartId = $params['start'] ?? null;
        $postEndId = $params['end'] ?? null;
        $nthPost = $params['n'] ?? null;
        $skipLayout = $params['skip_layout'] ?? false;
        $showDeleted = $params['with_deleted'] ?? null;
        $jumpTo = null;
        $currentUser = auth()->user();

        $topic = Topic::with(['forum'])->withTrashed()->findOrFail($id);

        $userCanModerate = priv_check('ForumModerate', $topic->forum)->can();

        if ($topic->trashed() && !$userCanModerate) {
            abort(404);
        }

        if ($topic->forum === null) {
            abort(404);
        }

        if ($userCanModerate) {
            $showDeleted = $showDeleted ?? $currentUser->profileCustomization()->forum_posts_show_deleted;
        } else {
            $showDeleted = false;
        }

        priv_check('ForumView', $topic->forum)->ensureCan();

        $posts = $topic->posts()->showDeleted($showDeleted);

        if ($postStartId === 'unread') {
            $postStartId = Post::lastUnreadByUser($topic, $currentUser);
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
            $jumpTo = $postStartId ?? $postEndId ?? 0;
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
            ->with([
                'lastEditor',
                'user.country',
                'user.rank',
                'user.supporterTagPurchases',
                'user.userGroups',
            ])->get()
            ->each(function ($item) use ($topic) {
                $item
                    ->setRelation('forum', $topic->forum)
                    ->setRelation('topic', $topic);
            })->sortBy('post_id');

        if ($posts->count() === 0) {
            abort($skipLayout ? 204 : 404);
        }

        $firstPostId = $topic->topic_first_post_id;
        $firstShownPostId = $posts->first()->post_id;

        // position of the first post, incremented in the view
        // to generate positions of further posts
        $firstPostPosition = $topic->postPosition($firstShownPostId);

        $poll = $topic->poll();
        if ($poll->exists()) {
            $topic->load([
                'pollOptions.votes',
                'pollOptions.post',
            ]);
            $canEditPoll = $poll->canEdit() && priv_check('ForumTopicPollEdit', $topic)->can();
        } else {
            $canEditPoll = false;
        }

        $pollSummary = PollOption::summary($topic, $currentUser);

        $posts->last()->markRead($currentUser);

        $template = $skipLayout ? '_posts' : 'show';

        $coverModel = $topic->cover()->firstOrNew([]);
        $coverModel->setRelation('topic', $topic);
        $cover = json_item($coverModel, new TopicCoverTransformer());

        $watch = TopicWatch::lookup($topic, $currentUser);

        $featureVotes = $this->groupFeatureVotes($topic);
        $noindex = !$topic->forum->enable_indexing;

        return ext_view(
            "forum.topics.{$template}",
            compact(
                'canEditPoll',
                'cover',
                'watch',
                'jumpTo',
                'pollSummary',
                'posts',
                'featureVotes',
                'firstPostPosition',
                'firstPostId',
                'noindex',
                'topic',
                'userCanModerate',
                'showDeleted'
            )
        );
    }

    public function store()
    {
        $params = get_params(request()->all(), null, [
            'body:string',
            'cover_id:int',
            'forum_id:int',
            'title:string',
            'with_poll:bool',
        ], ['null_missing' => true]);

        $forum = Forum::findOrFail($params['forum_id']);
        $user = auth()->user();

        priv_check('ForumTopicStore', $forum)->ensureCan();

        if ($params['with_poll']) {
            $poll = (new TopicPoll())->fill($this->getPollParams());

            if (!$poll->isValid()) {
                return error_popup($poll->validationErrors()->toSentence());
            }
        }

        $topicParams = [
            'title' => $params['title'],
            'user' => $user,
            'body' => $params['body'],
            'cover' => TopicCover::findForUse($params['cover_id'], $user),
        ];

        try {
            $topic = Topic::createNew($forum, $topicParams, $poll ?? null);
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        if ($user->user_notify || $forum->isHelpForum()) {
            TopicWatch::setState($topic, $user, 'watching_mail');
        }

        $post = $topic->posts->last();
        $post->markRead($user);

        return ujs_redirect(route('forum.topics.show', $topic));
    }

    public function update($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);

        if (!priv_check('ForumTopicEdit', $topic)->can()) {
            abort(403);
        }

        $params = get_params(request()->all(), 'forum_topic', ['topic_title']);

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

    private function getPollParams()
    {
        return get_params(request()->all(), 'forum_topic_poll', [
            'hide_results:bool',
            'length_days:int',
            'max_options:int',
            'options:string_split',
            'title',
            'vote_change:bool',
        ]);
    }

    private function groupFeatureVotes($topic)
    {
        if (!$topic->isFeatureTopic()) {
            return [];
        }

        $ret = [];

        foreach ($topic->featureVotes()->with('user')->get() as $vote) {
            $username = optional($vote->user)->username;
            $ret[$username] ?? ($ret[$username] = 0);
            $ret[$username] += $vote->voteIncrement();
        }

        arsort($ret);

        return $ret;
    }
}
