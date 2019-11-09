<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Libraries;

use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\User;

class CommentBundle
{
    public $depth;
    public $includeCommentableMeta;
    public $params;

    private $commentable;
    private $comment;
    private $user;

    public static function forComment(Comment $comment, bool $includeNested = false)
    {
        $options = [
            'comment' => $comment,
            'includeCommentableMeta' => true,
        ];

        if ($includeNested) {
            $options['params'] = ['parent_id' => $comment->getKey()];
        }

        return new static($comment->commentable, $options);
    }

    public static function forEmbed($commentable)
    {
        return new static($commentable, ['params' => ['parent_id' => 0]]);
    }

    public function __construct($commentable, array $options = [])
    {
        $this->commentable = $commentable;

        $this->user = $options['user'] ?? auth()->user();

        $this->params = new CommentBundleParams($options['params'] ?? [], $this->user);

        $this->comment = $options['comment'] ?? null;
        $this->depth = $options['depth'] ?? 2;
        $this->includeCommentableMeta = $options['includeCommentableMeta'] ?? false;
        $this->includeDeleted = $options['includeDeleted'] ?? true;
    }

    public function toArray()
    {
        $hasMore = false;
        $includedComments = collect();

        // Either use the provided comment as a base, or look for matching comments.
        if (isset($this->comment)) {
            $comments = collect([$this->comment]);
            if ($this->comment->parent !== null) {
                $includedComments->push($this->comment->parent);
            }
        } else {
            $comments = $this->getComments($this->commentsQuery(), false);
            if ($comments->count() > $this->params->limit) {
                $hasMore = true;
                $comments->pop();
            }
        }

        $commentIds = $comments->pluck('id');

        // Get parents when listing comments index
        if ($this->commentable === null) {
            $parents = $this->getComments(Comment::whereIn('id', $comments->pluck('parent_id')));
            $includedComments = $includedComments->concat($parents);
        }

        // Get nested comments
        if ($this->params->parentId !== null) {
            $nestedParentIds = $commentIds;

            for ($i = 0; $i < $this->depth; $i++) {
                $nestedComments = $this->getComments(Comment::whereIn('parent_id', $nestedParentIds));
                $nestedParentIds = $nestedComments->pluck('id');
                $includedComments = $includedComments->concat($nestedComments);
            }

            $parents = Comment::whereIn('id', $comments->pluck('parent_id'))->get();
            $includedComments = $includedComments->concat($parents);
        }

        $includedComments = $includedComments->unique('id', true)->reject(function ($comment) use ($commentIds) {
            return $commentIds->contains($comment->getKey());
        });
        $allComments = $comments->concat($includedComments);

        $result = [
            'comments' => json_collection($comments, 'Comment'),
            'has_more' => $hasMore,
            'has_more_id' => $this->params->parentId,
            'included_comments' => json_collection($includedComments, 'Comment'),
            'user_votes' => $this->getUserVotes($allComments),
            'user_follow' => $this->getUserFollow(),
            'users' => json_collection($this->getUsers($comments->concat($allComments)), 'UserCompact'),
            'sort' => $this->params->sort,
        ];

        if ($this->params->parentId === 0 || $this->params->parentId === null) {
            $result['top_level_count'] = $this->commentsQuery()->whereNull('parent_id')->count();
            $result['total'] = $this->commentsQuery()->count();
        }

        if ($this->includeCommentableMeta) {
            $commentables = $comments->pluck('commentable')->concat([null]);
            $result['commentable_meta'] = json_collection($commentables, 'CommentableMeta');
        }

        return $result;
    }

    public function commentsQuery()
    {
        if (isset($this->commentable)) {
            return $this->commentable->comments();
        } else {
            return Comment::select();
        }
    }

    private function getComments($query, $isChildren = true)
    {
        $sort = $this->params->sortDbOptions();
        $sorted = false;
        $queryLimit = $this->params->limit;

        if (!$isChildren) {
            if ($this->params->filterByParentId()) {
                $query->where(['parent_id' => $this->params->parentIdForWhere()]);
            }

            $queryLimit++;
            $queryCursor = [];
            $hasValidCursor = true;

            foreach ($sort as $column => $order) {
                $key = $column === 'votes_count_cache' ? 'votesCount' : camel_case($column);
                $value = $this->params->cursor[$key];
                if (isset($value)) {
                    $queryCursor[] = compact('column', 'order', 'value');
                } else {
                    $hasValidCursor = false;
                    break;
                }
            }

            if ($hasValidCursor) {
                $query->cursorWhere($queryCursor);
                $sorted = true;
            } else {
                $query->offset($this->params->limit * ($this->params->page - 1));
            }
        }

        if ($this->includeCommentableMeta) {
            $query->with('commentable');
        }

        if (!$this->includeDeleted) {
            $query->whereNull('deleted_at');
        }

        if (!$sorted) {
            foreach ($sort as $column => $order) {
                $query->orderBy($column, $order);
            }
        }

        return $query->limit($queryLimit)->get();
    }

    private function getUserFollow()
    {
        return $this->commentable !== null &&
            $this->user !== null &&
            $this
                ->user
                ->follows()
                ->whereNotifiable($this->commentable)
                ->where(['subtype' => 'comment'])
                ->exists();
    }

    private function getUserVotes($comments)
    {
        if ($this->user === null) {
            return [];
        }

        $ids = $comments->pluck('id');

        return CommentVote::where(['user_id' => $this->user->getKey()])
            ->whereIn('comment_id', $ids)
            ->pluck('comment_id');
    }

    private function getUsers($comments)
    {
        $userIds = $comments->pluck('user_id')
            ->concat($comments->pluck('edited_by_id'));

        return User::whereIn('user_id', $userIds)->get();
    }
}
