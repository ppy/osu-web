<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Exceptions\ModelNotSavedException;
use App\Models\Forum\Post;
use Auth;
use DB;
use Request;

/**
 * @group Forum
 */
class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'destroy',
            'raw',
        ]]);

        $this->middleware('require-scopes:forum.write', ['only' => ['update']]);

        return parent::__construct();
    }

    public function destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        priv_check('ForumPostDelete', $post)->ensureCan();

        DB::transaction(function () use ($post) {
            if ((auth()->user()->user_id ?? null) !== $post->poster_id) {
                $this->logModerate(
                    'LOG_DELETE_POST',
                    [$post->topic->topic_title],
                    $post
                );
            }

            $post->deleteOrExplode();
        });

        return ext_view('forum.topics.delete', compact('post'), 'js');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        priv_check('ForumModerate', $post->forum)->ensureCan();

        DB::transaction(function () use ($post) {
            $this->logModerate(
                'LOG_RESTORE_POST',
                [$post->topic->topic_title],
                $post
            );

            if (!$post->restore()) {
                throw new ModelNotSavedException($post->validationErrors()->toSentence());
            }
        });

        return ext_view('forum.topics.restore', compact('post'), 'js');
    }

    public function edit($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        priv_check('ForumPostEdit', $post)->ensureCan();

        return ext_view('forum.posts.edit', compact('post'));
    }

    /**
     * Edit Post
     *
     * Edit specified forum post.
     *
     * ---
     *
     * ### Response Format
     *
     * [ForumPost](#forum-post) with `body` included.
     *
     * @urlParam post integer required Id of the post. Example: 1
     *
     * @bodyParam body string required New post content in BBCode format. Example: hello
     */
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
                        'post_text' => get_string(request('body')),
                        'post_edit_user' => $userId,
                    ])
                    ->saveOrExplode();
            });
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        $post->refresh();

        if (is_api_request()) {
            return json_item($post, 'Forum\Post', ['body']);
        }

        return ext_view('forum.topics._posts', [
            'posts' => collect([$post]),
            'firstPostPosition' => $post->topic->postPosition($post->post_id),
            'topic' => $post->topic,
        ]);
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
