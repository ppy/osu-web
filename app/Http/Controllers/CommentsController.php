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

class CommentsController extends Controller
{
    protected $section = 'community';

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentDestroy', $comment)->ensureCan();

        $comment->softDelete(auth()->user());

        return json_item($comment, 'Comment', ['editor', 'user']);
    }

    public function index()
    {
        $type = request('commentable_type');
        $id = request('commentable_id');

        if (isset($type) && isset($id)) {
            $class = Comment::COMMENTABLES[$type] ?? null;

            if ($class === null) {
                abort(404);
            }

            $commentable = $class::findOrFail($id);
        } else {
            abort(404);
        }

        return (new CommentBundle($commentable, [
            'parentId' => get_int(request('parent_id')),
            'lastLoadedId' => get_int(request('after')),
        ]))->toArray();
    }

    public function restore($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentRestore', $comment)->ensureCan();

        $comment->restore();

        return json_item($comment, 'Comment', ['editor', 'user']);
    }

    public function show($id)
    {
        return json_item(Comment::findOrFail($id), 'Comment', ['editor', 'user']);
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
            $comments->push($comment->parent);
        }

        return (new CommentBundle($comment->commentable, [
            'comments' => $comments,
        ]))->toArray();
    }

    public function update($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentUpdate', $comment)->ensureCan();

        $params = get_params(request(), 'comment', ['message']);
        $params['edited_by_id'] = auth()->user()->getKey();
        $params['edited_at'] = Carbon::now();
        $comment->update($params);

        return json_item($comment, 'Comment', ['editor', 'user']);
    }
}
