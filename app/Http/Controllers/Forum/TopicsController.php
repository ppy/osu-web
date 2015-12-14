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

use App\Events\Forum\TopicWasCreated;
use App\Events\Forum\TopicWasReplied;
use App\Events\Forum\TopicWasViewed;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicCover;
use App\Transformers\Forum\TopicCoverTransformer;
use Auth;
use Carbon\Carbon;
use Event;
use Illuminate\Http\Request as HttpRequest;
use Request;

class TopicsController extends Controller
{
    protected $section = 'community';

    public function __construct()
    {
        parent::__construct();

        view()->share('current_action', 'forum-topics-'.current_action());

        $this->middleware('auth', ['only' => [
            'create',
            'preview',
            'reply',
            'store',
            'lock',
        ]]);
    }

    public function create($forum_id)
    {
        $forum = Forum::findOrFail($forum_id);

        $this->authorizePost($forum, null);

        $cover = fractal_item_array(
            TopicCover::findForUse(Request::old('cover_id'), Auth::user()),
            new TopicCoverTransformer()
        );

        return view('forum.topics.create', compact('forum', 'cover'));
    }

    public function preview($forumId)
    {
        $forum = Forum::findOrFail($forumId);

        $this->authorizePost($forum, null);

        $post = new Post([
            'post_text' => Request::input('body'),
            'user' => Auth::user(),
            'post_time' => Carbon::now(),
        ]);

        $options = [
            'overlay' => true,
            'signature' => $forum->enable_sigs,
        ];

        return view('forum.topics._post', compact('post', 'options'));
    }

    public function store(HttpRequest $request, $forum_id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $forum = Forum::findOrFail($forum_id);

        $this->authorizePost($forum, null);

        $topic = Topic::createNew([
            'forum' => $forum,
            'title' => $request->input('title'),
            'poster' => Auth::user(),
            'body' => $request->input('body'),
            'notifyReplies' => false,
            'cover' => TopicCover::findForUse(presence($request->input('cover_id')), Auth::user()),
        ]);

        Event::fire(new TopicWasCreated($topic, $topic->posts->last(), Auth::user()));

        return ujs_redirect(route('forum.topics.show', $topic));
    }

    public function show($id)
    {
        $postStartId = Request::input('start');
        $postEndId = get_int(Request::input('end'));
        $nthPost = get_int(Request::input('n'));
        $skipLayout = Request::input('skip_layout') === '1';
        $jumpTo = null;

        $topic = Topic::findOrFail($id);

        $this->authorizeView($topic->forum);

        $posts = $topic->posts();

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
            ->with('user.rank')
            ->with('user.country')
            ->with('user.supports')
            ->get()
            ->sortBy(function ($p) { return $p->post_id; });

        if ($posts->count() === 0) {
            abort($skipLayout ? 204 : 404);
        }

        $postsPosition = $topic->postsPosition($posts);

        Event::fire(new TopicWasViewed($topic, $posts->last(), Auth::user()));

        $template = $skipLayout ? '_posts' : 'show';

        $cover = fractal_item_array(
            $topic->cover()->firstOrNew([]),
            new TopicCoverTransformer()
        );

        return view("forum.topics.{$template}", compact('topic', 'posts', 'postsPosition', 'jumpTo', 'cover'));
    }

    public function reply(HttpRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);

        $this->authorizePost($topic->forum, $topic);

        $this->validate($request, [
            'body' => 'required',
        ]);

        if ($topic->addPost(Auth::user(), Request::input('body'), false)) {
            $posts = Post::where('post_id', $topic->topic_last_post_id)->get();
            $postsPosition = $topic->postsPosition($posts);

            Event::fire(new TopicWasReplied($topic, $posts->last(), Auth::user()));

            return view('forum.topics._posts', compact('posts', 'postsPosition', 'topic'));
        }
    }

    public function lock($id)
    {
        // FIXME: should be moderator check?
        // And maybe even its own controller or something.
        if (Auth::user()->isAdmin() !== true) {
            abort(403);
        }

        $topic = Topic::findOrFail($id);
        $lock = Request::input('lock') !== '0';
        $topic->lock($lock);

        return ['message' => trans('forum.topics.lock.locked-'.($lock === true ? '1' : '0'))];
    }
}
