<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Forum;

use App\Models\Forum\ForumCover;
use App\Transformers\TransformerAbstract;

class ForumCoverTransformer extends TransformerAbstract
{
    public function transform(ForumCover $cover = null)
    {
        if ($cover === null) {
            $cover = new ForumCover();
        }

        if ($cover->getFileProperties() === null) {
            $data = [
                'method' => 'post',
                'url' => route('forum.forum-covers.store', ['forum_id' => $cover->forum_id]),
            ];
        } else {
            $data = [
                'method' => 'patch',
                'url' => route('forum.forum-covers.update', [$cover, 'forum_id' => $cover->forum_id]),

                'id' => $cover->id,
                'fileUrl' => $cover->fileUrl(),
            ];
        }

        $data['dimensions'] = $cover->getMaxDimensions();

        return $data;
    }
}
