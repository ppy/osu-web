<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Transformers;

use App\Models\BeatmapDiscussionPost;
use League\Fractal;

class BeatmapDiscussionPostTransformer extends Fractal\TransformerAbstract
{
    public function transform(BeatmapDiscussionPost $post)
    {
        return [
            'id' => $post->id,
            'beatmap_discussion_id' => $post->beatmap_discussion_id,
            'user_id' => $post->user_id,
            'last_editor_id' => presence($post->last_editor_id, $post->user_id),

            'system' => $post->system,
            'message' => $post->message,

            'created_at' => json_time($post->created_at),
            'updated_at' => json_time($post->updated_at),
        ];
    }
}
