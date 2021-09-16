<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Forum;

use App\Models\Forum\TopicCover;
use App\Transformers\TransformerAbstract;

class TopicCoverTransformer extends TransformerAbstract
{
    public function transform(TopicCover $cover = null)
    {
        if ($cover === null) {
            $cover = new TopicCover();
        }

        if ($cover->getFileProperties() === null) {
            $data = [
                'method' => 'post',
                'url' => route('forum.topic-covers.store', ['topic_id' => $cover->topic_id]),
            ];
        } else {
            $data = [
                'method' => 'put',
                'url' => route('forum.topic-covers.update', [$cover, 'topic_id' => $cover->topic_id]),

                'id' => $cover->id,
                'fileUrl' => $cover->fileUrl(),
            ];
        }

        $data['dimensions'] = $cover->getMaxDimensions();
        $data['defaultFileUrl'] = $cover->defaultFileUrl();

        return $data;
    }
}
