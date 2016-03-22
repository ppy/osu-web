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

use App\Models\BeatmapDiscussion;
use League\Fractal;
use League\Fractal\ParamBag;

class BeatmapDiscussionTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'user',
        'beatmap_discussion_replies',
        'current_user_attributes',
    ];

    public function transform(BeatmapDiscussion $discussion)
    {
        return [
            'id' => $discussion->id,
            'beatmapset_discussion_id' => $discussion->beatmapset_discussion_id,
            'beatmap_id' => $discussion->beatmap_id,
            'user_id' => $discussion->user_id,
            'message_type' => $discussion->message_type,
            'timestamp' => $discussion->timestamp,
            'message' => $discussion->message,
            'resolved' => $discussion->resolved,
            'created_at' => $discussion->created_at,
            'updated_at' => $discussion->updated_at,
            'votes' => $discussion->votes_summary,
        ];
    }

    public function includeUser(BeatmapDiscussion $discussion)
    {
        return $this->item($discussion->user, new UserTransformer);
    }

    public function includeBeatmapDiscussionReplies(BeatmapDiscussion $discussion)
    {
        return $this->collection(
            $discussion->beatmapDiscussionReplies,
            new BeatmapDiscussionReplyTransformer
        );
    }

    public function includeCurrentUserAttributes(BeatmapDiscussion $discussion, ParamBag $params = null)
    {
        if ($params === null || $params->get('user_id') === null) {
            return;
        }

        $vote = $discussion->beatmapDiscussionVotes()->where('user_id', $params->get('user_id'))->firstOrNew([]);

        return $this->item($discussion, function ($discussion) use ($vote) {
            return ['vote_score' => $vote->score];
        });
    }
}
