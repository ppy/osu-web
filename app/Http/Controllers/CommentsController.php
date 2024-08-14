<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Jobs\Notifications\CommentNew;
use App\Libraries\CommentBundle;
use App\Libraries\MorphMap;
use App\Models\Comment;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Knuckles\Scribe\Attributes\QueryParam;

/**
 * @group Comments
 */
class CommentsController extends Controller
{
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
     * @urlParam comment integer required The `id` of the [Comment](#comment)
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
     * @queryParam after integer Return comments which come after the specified comment id as per sort option. No-example
     * @queryParam commentable_type string The type of resource to get comments for. Example: beatmapset
     * @queryParam commentable_id integer The id of the resource to get comments for. Example: 1
     * @queryParam cursor Pagination option. See [CommentSort](#commentsort) for detail. The format follows [Cursor](#cursor) except it's not currently included in the response. No-example
     * @queryParam parent_id integer Limit to comments which are reply to the specified id. Specify 0 to get top level comments. Example: 1
     * @queryParam sort string Sort option as defined in [CommentSort](#commentsort). Defaults to `new` for guests and user-specified default when authenticated. Example: new
     */
    #[QueryParam('derp', 'integer')]
    public function index()
    {
        $params = request()->all();

        $userId = $params['user_id'] ?? null;

        if ($userId !== null) {
            $user = User::lookup($userId, 'id', true);

            if ($user === null || !priv_check('UserShow', $user)->can()) {
                abort(404);
            }
        }

        $id = $params['commentable_id'] ?? null;
        $type = $params['commentable_type'] ?? null;

        if (isset($type) && isset($id)) {
            if (!Comment::isValidType($type)) {
                abort(422);
            }

            $class = MorphMap::getClass($type);
            $commentable = $class::findOrFail($id);
        }

        $params['sort'] = $params['sort'] ?? Comment::DEFAULT_SORT;
        $commentBundle = new CommentBundle(
            $commentable ?? null,
            ['params' => $params]
        );

        if (is_json_request()) {
            return $commentBundle->toArray();
        } else {
            $commentBundle->depth = 0;
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
     * @urlParam comment integer required The `id` of the [Comment](#comment)
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        $commentBundle = CommentBundle::forComment($comment, true);

        if (is_json_request()) {
            return $commentBundle->toArray();
        }

        set_opengraph($comment);

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
     * @queryParam comment.commentable_id integer required Resource ID the comment thread is attached to. Example: 1
     * @queryParam comment.commentable_type string required Resource type the comment thread is attached to. Example: beatmapset
     * @queryParam comment.message string required Text of the comment
     * @queryParam comment.parent_id integer The id of the comment to reply to, null if not a reply. No-example
     */
    public function store()
    {
        $user = auth()->user();

        $params = get_params(request()->all(), 'comment', [
            'commentable_id:int',
            'commentable_type',
            'message',
            'parent_id:int',
        ]);
        $params['user_id'] = optional($user)->getKey();

        $comment = new Comment($params);
        $comment->setCommentable();

        if ($comment->commentable === null) {
            abort(422, 'invalid commentable specified');
        }

        priv_check('CommentStore', $comment->commentable)->ensureCan();

        try {
            $comment->saveOrExplode();
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        (new CommentNew($comment, $user))->dispatch();

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
     * @urlParam comment integer required The `id` of the [Comment](#comment)
     * @queryParam comment.message string required New text of the comment
     */
    public function update($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentUpdate', $comment)->ensureCan();

        $params = get_params(request()->all(), 'comment', ['message']);
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
        $comment = Comment::findOrFail($id);

        priv_check('CommentPin', $comment)->ensureCan();

        $comment->fill(['pinned' => false])->saveOrExplode();

        return CommentBundle::forComment($comment)->toArray();
    }

    public function pinStore($id)
    {
        $comment = Comment::findOrFail($id);

        priv_check('CommentPin', $comment)->ensureCan();

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
     * @urlParam comment integer required The `id` of the [Comment](#comment)
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
     * @urlParam comment integer required The `id` of the [Comment](#comment)
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
