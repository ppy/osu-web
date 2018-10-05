<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Libraries\CommentBundle;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentsController extends Controller
{
    protected $section = 'community';
    protected $actionPrefix = 'comments-';

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentDestroy', $comment)->ensureCan();

        $comment->softDelete(auth()->user());

        return json_item($comment, 'Comment', ['editor', 'user', 'commentable_meta']);
    }

    public function index()
    {
        if (!request()->expectsJson()) {
            priv_check('CommentModerate')->ensureCan();
        }

        $type = request('commentable_type');
        $id = request('commentable_id');

        if (isset($type) && isset($id)) {
            $class = Comment::COMMENTABLES[$type] ?? null;

            if ($class === null) {
                abort(404);
            }

            $commentable = $class::findOrFail($id);
        }

        $commentBundle = new CommentBundle(
            $commentable ?? null,
            ['params' => request()->all()]
        );

        if (request()->expectsJson()) {
            return $commentBundle->toArray();
        } else {
            $commentBundle->depth = 0;
            $commentBundle->includeCommentableMeta = true;
            $commentBundle->includeParent = true;
            $commentBundle->filterByParentId = false;

            $commentPagination = new LengthAwarePaginator(
                [],
                Comment::count(),
                $commentBundle->params['limit'],
                $commentBundle->params['page'],
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'query' => $commentBundle->getParams(),
                ]
            );

            return view('comments.index', compact('commentBundle', 'commentPagination'));
        }
    }

    public function restore($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentRestore', $comment)->ensureCan();

        $comment->restore();

        return json_item($comment, 'Comment', ['editor', 'user', 'commentable_meta']);
    }

    public function show($id)
    {
        priv_check('CommentModerate')->ensureCan();

        $comment = Comment::findOrFail($id);

        $commentBundle = new CommentBundle($comment->commentable, [
            'params' => ['parent_id' => $comment->getKey()],
        ]);

        $commentJson = json_item($comment, 'Comment', [
            'editor', 'user', 'commentable_meta', 'parent',
        ]);

        return view('comments.show', compact('commentJson', 'commentBundle'));
    }

    public function store()
    {
        $params = get_params(request(), 'comment', [
            'commentable_id:int',
            'commentable_type',
            'message',
            'parent_id:int',
        ]);
        $params['user_id'] = optional(auth()->user())->getKey();

        $comment = new Comment($params);

        priv_check('CommentStore', $comment)->ensureCan();

        try {
            $comment->saveOrExplode();
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        $comments = collect([$comment]);

        if ($comment->parent !== null) {
            $comments[] = $comment->parent;
        }

        $bundle = new CommentBundle($comment->commentable, [
            'comments' => $comments,
            'includeCommentableMeta' => true,
        ]);

        return $bundle->toArray();
    }

    public function update($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentUpdate', $comment)->ensureCan();

        $params = get_params(request(), 'comment', ['message']);
        $params['edited_by_id'] = auth()->user()->getKey();
        $params['edited_at'] = Carbon::now();
        $comment->update($params);

        return json_item($comment, 'Comment', ['editor', 'user', 'commentable_meta']);
    }
}
