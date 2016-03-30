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
            'created_at' => $discussion->created_at->toIso8601String(),
            'updated_at' => $discussion->updated_at->toIso8601String(),
            'votes' => $discussion->votes_summary,
            'duration' => $discussion->total_length,
        ];
    }

    public function includeBeatmapDiscussionReplies(BeatmapDiscussion $discussion)
    {
        return $this->collection(
            $discussion->beatmapDiscussionReplies,
            new BeatmapDiscussionReplyTransformer()
        );
    }

    public function includeCurrentUserAttributes(BeatmapDiscussion $discussion, ParamBag $params = null)
    {
        if ($params === null) {
            return;
        }

        $userId = get_int($params->get('user_id')[0] ?? null);

        if ($userId === null) {
            return;
        }

        $score = 0;

        // This assumes beatmapDiscussionVotes are already preloaded and
        // thus will save one query.
        foreach ($discussion->beatmapDiscussionVotes as $vote) {
            if ($vote->user_id === $userId) {
                $score = $vote->score;
                break;
            }
        }

        return $this->item($discussion, function ($discussion) use ($score) {
            return ['vote_score' => $score];
        });
    }
}
