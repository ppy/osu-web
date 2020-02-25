<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
use App\Libraries\CommentBundleParams;
use App\Libraries\MorphMap;
use App\Models\Comment;
use App\Models\Log;
use App\Models\Notification;
use Carbon\Carbon;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @group Comments
 */
class CommentsController extends Controller
{
    protected $section = 'community';
    protected $actionPrefix = 'comments-';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Delete Comment
     *
     * Deletes the specified comment.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [CommentBundle](#commentbundle)
     *
     * @authenticated
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentDestroy', $comment)->ensureCan();

        $comment->softDelete(auth()->user());

        if ($comment->user_id !== auth()->user()->getKey()) {
            $this->logModerate('LOG_COMMENT_DELETE', $comment);
        }

        return CommentBundle::forComment($comment)->toArray();
    }

    /**
     * Get Comments
     *
     * Returns a list comments and their replies up to 2 levels deep.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [CommentBundle](#commentbundle).
     *
     * `pinned_comments` is only included when `commentable_type` and `commentable_id` are specified.
     *
     * @authenticated
     *
     * @queryParam commentable_type The type of resource to get comments for.
     * @queryParam commentable_id The id of the resource to get comments for.
     * @queryParam cursor Pagination option. See [CommentSort](#commentsort) for detail. The format follows [Cursor](#cursor) except it's not currently included in the response.
     * @queryParam parent_id Limit to comments which are reply to the specified id. Specify 0 to get top level comments.
     * @queryParam sort Sort option as defined in [CommentSort](#commentsort). Defaults to `new` for guests and user-specified default when authenticated.
     */
    public function index()
    {
        $params = request()->all();

        $id = $params['commentable_id'] ?? null;
        $type = $params['commentable_type'] ?? null;

        if (isset($type) && isset($id)) {
            if (!Comment::isValidType($type)) {
                abort(422);
            }

            $class = MorphMap::getClass($type);
            $commentable = $class::findOrFail($id);
        }

        $params['sort'] = $params['sort'] ?? CommentBundleParams::DEFAULT_SORT;
        $commentBundle = new CommentBundle(
            $commentable ?? null,
            ['params' => $params]
        );

        if (is_json_request()) {
            return $commentBundle->toArray();
        } else {
            $commentBundle->depth = 0;
            $commentBundle->includeCommentableMeta = true;
            $commentBundle->includePinned = false;

            $commentPagination = new LengthAwarePaginator(
                [],
                $commentBundle->countForPaginator(),
                $commentBundle->params->limit,
                $commentBundle->params->page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'query' => $commentBundle->params->forUrl(),
                ]
            );

            return ext_view('comments.index', compact('commentBundle', 'commentPagination'));
        }
    }

    public function restore($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentRestore', $comment)->ensureCan();

        $comment->restore();

        $this->logModerate('LOG_COMMENT_RESTORE', $comment);

        return CommentBundle::forComment($comment)->toArray();
    }

    /**
     * Get a Comment
     *
     * Gets a comment and its replies up to 2 levels deep.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [CommentBundle](#commentbundle)
     *
     * @authenticated
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        $commentBundle = CommentBundle::forComment($comment, true);

        if (is_json_request()) {
            return $commentBundle->toArray();
        }

        return ext_view('comments.show', compact('commentBundle'));
    }

    /**
     * Post a new comment
     *
     * Posts a new comment to a comment thread.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [CommentBundle](#commentbundle)
     *
     * @authenticated
     *
     * @queryParam comment.commentable_id Resource ID the comment thread is attached to
     * @queryParam comment.commentable_type Resource type the comment thread is attached to
     * @queryParam comment.message Text of the comment
     * @queryParam comment.parent_id The id of the comment to reply to, null if not a reply
     */
    public function store()
    {
        $user = auth()->user();

        $params = get_params(request(), 'comment', [
            'commentable_id:int',
            'commentable_type',
            'message',
            'parent_id:int',
        ]);
        $params['user_id'] = optional($user)->getKey();

        $comment = new Comment($params);

        priv_check('CommentStore', $comment)->ensureCan();

        try {
            $comment->saveOrExplode();
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        broadcast_notification(Notification::COMMENT_NEW, $comment, $user);

        return CommentBundle::forComment($comment)->toArray();
    }

    /**
     * Edit Comment
     *
     * Edit an existing comment.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [CommentBundle](#commentbundle)
     *
     * @authenticated
     *
     * @queryParam comment.message New text of the comment
     */
    public function update($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentUpdate', $comment)->ensureCan();

        $params = get_params(request(), 'comment', ['message']);
        $params['edited_by_id'] = auth()->user()->getKey();
        $params['edited_at'] = Carbon::now();
        $comment->update($params);

        if ($comment->user_id !== auth()->user()->getKey()) {
            $this->logModerate('LOG_COMMENT_UPDATE', $comment);
        }

        return CommentBundle::forComment($comment)->toArray();
    }

    public function pinDestroy($id)
    {
        priv_check('CommentPin')->ensureCan();

        $comment = Comment::findOrFail($id);
        $comment->fill(['pinned' => false])->saveOrExplode();

        return CommentBundle::forComment($comment)->toArray();
    }

    public function pinStore($id)
    {
        priv_check('CommentPin')->ensureCan();

        $comment = Comment::findOrFail($id);
        $comment->fill(['pinned' => true])->saveOrExplode();

        return CommentBundle::forComment($comment)->toArray();
    }

    /**
     * Remove Comment vote
     *
     * Un-upvotes a comment.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [CommentBundle](#commentbundle)
     *
     * @authenticated
     */
    public function voteDestroy($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentVote', $comment)->ensureCan();

        $vote = $comment->votes()->where([
            'user_id' => auth()->user()->getKey(),
        ])->first();

        optional($vote)->delete();

        return CommentBundle::forComment($comment->fresh(), false)->toArray();
    }

    /**
     * Add Comment vote
     *
     * Upvotes a comment.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns [CommentBundle](#commentbundle)
     *
     * @authenticated
     */
    public function voteStore($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentVote', $comment)->ensureCan();

        try {
            $comment->votes()->create([
                'user_id' => auth()->user()->getKey(),
            ]);
        } catch (Exception $e) {
            if (!is_sql_unique_exception($e)) {
                throw $e;
            }
        }

        return CommentBundle::forComment($comment->fresh(), false)->toArray();
    }

    private function logModerate($operation, $comment)
    {
        $this->log([
            'log_type' => Log::LOG_COMMENT_MOD,
            'log_operation' => $operation,
            'log_data' => [
                'commentable_type' => $comment->commentable_type,
                'commentable_id' => $comment->commentable_id,
                'id' => $comment->getKey(),
            ],
        ]);
    }
}
