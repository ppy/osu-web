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

namespace App\Transformers\Forum;

use App\Models\Forum\TopicCover;
use League\Fractal;

class TopicCoverTransformer extends Fractal\TransformerAbstract
{
    public function transform(TopicCover $cover = null)
    {
        if ($cover === null) {
            $cover = new TopicCover;
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
