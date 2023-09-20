<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\BeatmapDiscussion;
use App\Models\KudosuHistory;

class KudosuHistoryTransformer extends TransformerAbstract
{
    public function transform(KudosuHistory $kudosuHistory)
    {
        if ($kudosuHistory->giver !== null) {
            $giver = [
                'url' => route('users.show', $kudosuHistory->giver->user_id),
                'username' => $kudosuHistory->giver->username,
            ];
        }

        if (($kudosuHistory->post->topic ?? null) !== null) {
            $post = [
                'url' => route('forum.posts.show', $kudosuHistory->post_id),
                'title' => $kudosuHistory->post->topic->topic_title,
            ];

            $model = 'forum_post';
            $action = $kudosuHistory->action;
        } elseif (($kudosuable = $kudosuHistory->kudosuable) !== null) {
            $post = [
                'url' => $kudosuable->url(),
                'title' => $kudosuable->title(),
            ];

            $model = $kudosuable instanceof BeatmapDiscussion
                // Old name, used at least in translation file.
                ? 'beatmap_discussion'
                : $kudosuable->getMorphClass();
            $action = $kudosuHistory->details['event'].'.'.$kudosuHistory->action;
        } else {
            $post = [
                'url' => null,
                'title' => '[deleted beatmap]',
            ];

            $model = 'forum_post';
            $action = $kudosuHistory->action;
        }

        return [
            'id' => $kudosuHistory->exchange_id,
            'action' => $action,
            'amount' => $kudosuHistory->amount,
            'model' => $model,
            'created_at' => json_time($kudosuHistory->date),
            'giver' => $giver ?? null,
            'post' => $post,
            'details' => $kudosuHistory->details,
        ];
    }
}
