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
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use Auth;
use DB;
use Request;

class PostsController extends Controller
{
    protected $section = 'community';

    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'destroy',
            'raw',
        ]]);

        return parent::__construct();
    }

    public function destroy($id)
    {
        $post = Post::showDeleted(priv_check('ForumTopicModerate')->can())
            ->findOrFail($id);

        priv_check('ForumPostDelete', $post)->ensureCan();

        $topic = $post->topic()->withTrashed()->first();

        try {
            DB::transaction(function () use ($post, $topic) {
                if ((Auth::user()->user_id ?? null) !== $post->poster_id) {
                    $this->logModerate(
                        'LOG_DELETE_POST',
                        [$topic->topic_title],
                        $post
                    );
                }

                $topic->removePostOrExplode($post);
            });
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        if ($topic->trashed()) {
            $redirect = route('forum.forums.show', $topic->forum);

            return ujs_redirect($redirect);
        }

        return js_view('forum.topics.delete', compact('post'));
    }

    public function restore($id)
    {
        priv_check('ForumTopicModerate')->ensureCan();

        $post = Post::withTrashed()->findOrFail($id);
        $topic = $post->topic()->withTrashed()->first();

        $this->logModerate(
            'LOG_RESTORE_POST',
            [$topic->topic_title],
            $post
        );

        $topic->restorePost($post);

        return js_view('forum.topics.restore', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        priv_check('ForumPostEdit', $post)->ensureCan();

        return view('forum.topics._post_edit', compact('post'));
    }

    public function update($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        priv_check('ForumPostEdit', $post)->ensureCan();

        try {
            DB::transaction(function () use ($post) {
                $userId = Auth::user() === null ? null : Auth::user()->getKey();

                if ($userId !== $post->poster_id) {
                    $this->logModerate(
                        'LOG_POST_EDITED',
                        [
                            $post->topic->topic_title,
                            $post->user->username,
                        ],
                        $post
                    );
                }

                $post
                    ->fill([
                        'post_text' => request('body'),
                        'post_edit_user' => $userId,
                    ])
                    ->saveOrExplode();
            });
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        $posts = collect([$post->fresh()]);
        $topic = $post->topic;
        $firstPostPosition = $topic->postPosition($post->post_id);

        return view('forum.topics._posts', compact('posts', 'firstPostPosition', 'topic'));
    }

    public function raw($id)
    {
        $showDeleted = priv_check('ForumTopicModerate')->can();

        $post = Post::showDeleted($showDeleted)->findOrFail($id);

        if ($post->forum === null) {
            abort(404);
        }

        priv_check('ForumView', $post->forum)->ensureCan();

        $text = $post->bodyRaw;

        if (Request::input('quote') === '1') {
            $text = sprintf('[quote="%s"]%s[/quote]', $post->userNormalized()->username, $text);
        }

        return $text;
    }

    public function show($id)
    {
        $showDeleted = priv_check('ForumTopicModerate')->can();

        $post = Post::showDeleted($showDeleted)->findOrFail($id);

        if ($post->forum === null) {
            abort(404);
        }

        priv_check('ForumView', $post->forum)->ensureCan();

        return ujs_redirect(post_url($post->topic_id, $post->post_id));
    }
}
