<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers;

use App\Libraries\Commentable;
use League\Fractal;

class CommentableMetaTransformer extends Fractal\TransformerAbstract
{
    public function transform(?Commentable $commentable)
    {
        if (isset($commentable)) {
            return [
                'id' => $commentable->getKey(),
                'type' => $commentable->getMorphClass(),
                'title' => $commentable->commentableTitle(),
                'url' => $commentable->url(),
            ];
        } else {
            return [
                'title' => trans('comments.commentable_name._deleted'),
            ];
        }
    }
}
