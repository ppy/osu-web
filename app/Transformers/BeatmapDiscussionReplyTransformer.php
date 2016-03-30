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

use App\Models\BeatmapDiscussionReply;
use League\Fractal;

class BeatmapDiscussionReplyTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'user',
    ];

    public function transform(BeatmapDiscussionReply $reply)
    {
        return [
            'id' => $reply->id,
            'beatmap_discussion_id' => $reply->beatmap_discussion_id,
            'user_id' => $reply->user_id,

            'message' => $reply->message,

            'created_at' => $reply->created_at->toIso8601String(),
            'updated_at' => $reply->updated_at->toIso8601String(),
        ];
    }

    public function includeUser(BeatmapDiscussionReply $reply)
    {
        return $this->item($reply->user, new UserTransformer);
    }
}
