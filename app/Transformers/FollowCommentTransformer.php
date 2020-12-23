<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Follow;

class FollowCommentTransformer extends FollowTransformer
{
    protected $availableIncludes = [
        'commentable_meta',
        'latest_comment',
    ];

    private $latestComments;

    public function __construct($latestComments = null)
    {
        // should be keyed by "type:id"
        $this->latestComments = $latestComments;
    }

    public function includeCommentableMeta(Follow $follow)
    {
        return $this->item($follow->notifiable, new CommentableMetaTransformer());
    }

    public function includeLatestComment(Follow $follow)
    {
        $comment = $this->latestComments["{$follow->notifiable_type}:{$follow->notifiable_id}"] ?? null;

        if ($comment !== null) {
            return $this->item($comment, new CommentTransformer());
        }
    }
}
