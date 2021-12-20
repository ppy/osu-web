<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Libraries\Commentable;
use App\Models\Beatmapset;

class CommentableMetaTransformer extends TransformerAbstract
{
    public function transform(?Commentable $commentable)
    {
        if (isset($commentable)) {
            if ($commentable instanceof Beatmapset) {
                $ownerId = $commentable->user_id;
                $ownerTitle = 'MAPPER';
            }

            return [
                'id' => $commentable->getKey(),
                'type' => $commentable->getMorphClass(),
                'title' => $commentable->commentableTitle(),
                'url' => $commentable->url(),
                'owner_id' => $ownerId ?? null,
                'owner_title' => $ownerTitle ?? null,
            ];
        } else {
            return [
                'title' => osu_trans('comments.commentable_name._deleted'),
            ];
        }
    }
}
