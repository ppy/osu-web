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

namespace App\Transformers;

use App\Models\KudosuHistory;
use League\Fractal;

class KudosuHistoryTransformer extends Fractal\TransformerAbstract
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
        } elseif ($kudosuHistory->kudosuable !== null) {
            $post = [
                'url' => $kudosuHistory->kudosuable->url(),
                'title' => $kudosuHistory->kudosuable->title(),
            ];

            $model = get_model_basename($kudosuHistory->kudosuable);
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
            'post' => $post ?? null,
            'details' => $kudosuHistory->details,
        ];
    }
}
