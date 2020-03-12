<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Exceptions\ModelNotSavedException;
use App\Models\Forum\Post;
use Auth;
use DB;
use Request;

class PostsController extends Controller
{
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
        $post = Post::withTrashed()->findOrFail($id);

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

        return ext_view('forum.topics.delete', compact('post'), 'js');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        priv_check('ForumModerate', $post->forum)->ensureCan();

        $topic = $post->topic()->withTrashed()->first();

        $this->logModerate(
            'LOG_RESTORE_POST',
            [$topic->topic_title],
            $post
        );

        $topic->restorePost($post);

        return ext_view('forum.topics.restore', compact('post'), 'js');
    }

    public function edit($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        priv_check('ForumPostEdit', $post)->ensureCan();

        return ext_view('forum.topics._post_edit', compact('post'));
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

        return ext_view('forum.topics._posts', compact('posts', 'firstPostPosition', 'topic'));
    }

    public function raw($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if ($post->trashed()) {
            priv_check('ForumModerate', $post->forum)->ensureCan();
        }

        if ($post->forum === null || $post->topic === null) {
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
        $post = Post::withTrashed()->findOrFail($id);

        if ($post->trashed()) {
            priv_check('ForumModerate', $post->forum)->ensureCan();
        }

        if ($post->forum === null || $post->topic === null) {
            abort(404);
        }

        priv_check('ForumView', $post->forum)->ensureCan();

        return ujs_redirect(post_url($post->topic_id, $post->post_id));
    }
}
