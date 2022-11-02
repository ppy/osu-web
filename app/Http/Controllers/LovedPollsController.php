<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Forum\Topic;
use App\Models\LovedPoll;
use App\Transformers\LovedPollTransformer;

class LovedPollsController extends Controller
{
    public function vote(int $topicId)
    {
        $pollOptionId = LovedPoll::pollOptionId(request()->input('poll_option'));

        abort_if($pollOptionId === null, 422, 'Invalid poll option');

        $topic = Topic::findOrFail($topicId);

        abort_if($topic->lovedPoll === null, 404);
        priv_check('ForumTopicVote', $topic)->ensureCan();

        $params = [
            'ip' => request()->ip(),
            'option_ids' => [$pollOptionId],
            'user_id' => auth()->id(),
        ];

        if (!$topic->vote()->fill($params)->save()) {
            return error_popup($topic->vote()->validationErrors()->toSentence());
        }

        return json_item($topic->lovedPoll, new LovedPollTransformer());
    }
}
