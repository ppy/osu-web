<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\User;
use Ds\Set;
use Illuminate\Database\Eloquent\Collection;

class CommentBundle
{
    public int $depth;
    public bool $includeDeleted;
    public bool $includePinned;
    public CommentBundleParams $params;

    private ?Comment $comment;
    private ?User $user;

    public static function forComment(Comment $comment, bool $includeNested = false)
    {
        $options = ['comment' => $comment];

        if ($includeNested) {
            $options['params'] = ['parent_id' => $comment->getKey()];
        }

        return new static($comment->commentable, $options);
    }

    public static function forEmbed($commentable)
    {
        return new static($commentable, ['params' => ['parent_id' => 0]]);
    }


    public function __construct(private ?Commentable $commentable, array $options = [])
    {
        $this->user = auth()->user();

        $this->params = new CommentBundleParams($options['params'] ?? [], $this->user);

        $this->comment = $options['comment'] ?? null;
        $this->depth = $options['depth'] ?? 2;
        $this->includeDeleted = isset($commentable);
        $this->includePinned = isset($commentable);
    }

    public function toArray()
    {
        $hasMore = false;
        $includedComments = collect();
        $pinnedComments = collect();

        // Either use the provided comment as a base, or look for matching comments.
        if (isset($this->comment)) {
            $comments = new Collection([$this->comment]);
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

        // Get parents when listing comments index or loading comment replies
        if ($this->commentable === null || $this->params->parentId !== null) {
            $parentIds = array_reject_null($comments->pluck('parent_id'));
            if (count($parentIds) > 0) {
                $parents = $this->getComments(Comment::whereIn('id', $parentIds));
                $includedComments = $includedComments->concat($parents);
            }
        }

        $commentIds = new Set($comments->pluck('id'));

        // Get nested comments
        if ($this->params->parentId !== null) {
            $nestedParentIds = $commentIds->toArray();

            for ($i = 0; $i < $this->depth; $i++) {
                $nestedComments = $this->getComments(Comment::whereIn('parent_id', $nestedParentIds));
                $includedComments = $includedComments->concat($nestedComments);
                $nestedParentIds = array_reject_null($nestedComments->pluck('id'));
                if (count($nestedParentIds) === 0) {
                    break;
                }
            }
        }

        $includedComments = $includedComments
            ->unique('id', true)
            ->reject(fn ($comment) => $commentIds->contains($comment->getKey()));

        if ($this->includePinned) {
            $pinnedComments = $this->getComments($this->commentsQuery()->where('pinned', true), true, true);
        }

        $allComments = $comments->concat($includedComments)->concat($pinnedComments);
        $allComments->load('commentable');

        $result = [
            'comments' => json_collection($comments, 'Comment'),
            'has_more' => $hasMore,
            'has_more_id' => $this->params->parentId,
            'included_comments' => json_collection($includedComments, 'Comment'),
            'pinned_comments' => json_collection($pinnedComments, 'Comment'),
            'user_votes' => $this->getUserVotes($allComments),
            'user_follow' => $this->getUserFollow(),
            'users' => json_collection($this->getUsers($allComments), 'UserCompact'),
            'sort' => $this->params->sort,
            'cursor' => $this->params->cursorHelper->next($comments),
        ];

        if ($this->params->userId !== null) {
            $result['user'] = json_item(User::find($this->params->userId), 'UserCompact');
        }

        if ($this->params->parentId === 0 || $this->params->parentId === null) {
            $result['top_level_count'] = $this->commentsQuery()->whereNull('parent_id')->count();
            $result['total'] = $this->commentsQuery()->count();
        }

        $commentables = $comments->pluck('commentable');
        // Always include initial commentable in so it can be used for attributes
        // check even when there's no comment on it.
        if ($this->commentable !== null) {
            $commentables[] = $this->commentable;
        }
        $commentables = $commentables->uniqueStrict('commentable_identifier')->concat([null]);
        $result['commentable_meta'] = json_collection($commentables, 'CommentableMeta');

        return $result;
    }

    public function commentsQuery()
    {
        if (isset($this->commentable)) {
            $query = $this->commentable->comments();
        } else {
            $query = Comment::select();
        }

        if ($this->params->userId !== null) {
            $query->where('user_id', $this->params->userId);
        }

        return $query;
    }

    // This is named explictly for the paginator because there's another count
    // in ::toArray() which always includes deleted comments.
    public function countForPaginator()
    {
        $query = $this->commentsQuery();

        if (!$this->includeDeleted) {
            $query->withoutTrashed();
        }
        $query->select('id')->limit(config('osu.pagination.max_count'))->unorder();

        return Comment::from($query)->count();
    }

    private function getComments($query, $isChildren = true, $pinnedOnly = false)
    {
        $sortOrCursorHelper = $pinnedOnly ? 'new' : $this->params->cursorHelper;
        $queryLimit = $this->params->limit;

        if (!$isChildren) {
            if ($this->params->filterByParentId()) {
                $query->where(['parent_id' => $this->params->parentIdForWhere()]);
            }

            $queryLimit++;
            $cursor = $this->params->cursor;

            if ($cursor === null) {
                $query->offset(max_offset($this->params->page, $this->params->limit));
            }
        }

        $query->cursorSort($sortOrCursorHelper, $cursor ?? null);

        if (!$this->includeDeleted) {
            $query->whereNull('deleted_at');
        }

        if (!$pinnedOnly) {
            $query->limit($queryLimit);
        }

        return $query->get();
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

        if (priv_check('CommentModerate')->can()) {
            $userIds = $userIds->concat($comments->pluck('deleted_by_id'));
        }

        return User::whereIn('user_id', array_reject_null($userIds))->get();
    }
}
