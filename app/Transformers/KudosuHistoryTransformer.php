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

use App\Models\KudosuHistory;
use League\Fractal;

class KudosuHistoryTransformer extends Fractal\TransformerAbstract
{
    public function transform(KudosuHistory $kudosuHistory)
    {
        return [
            'id' => $kudosuHistory->exchange_id,
            'action' => $kudosuHistory->action,
            'amount' => $kudosuHistory->amount,
            'createdAt' => $kudosuHistory->date->toIso8601String(),
            'giver' => [
                'url' => route('users.show', $kudosuHistory->giver_id),
                'name' => $kudosuHistory->giver->username,
            ],
            'post' => [
                'url' => route('forum.posts.show', $kudosuHistory->post_id),
                'title' => $kudosuHistory->post->topic->topic_title,
            ],
        ];
    }
}
