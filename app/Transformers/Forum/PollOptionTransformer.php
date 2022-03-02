<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Forum;

use App\Models\Forum\PollOption;
use App\Transformers\TransformerAbstract;
use League\Fractal\Resource\ResourceInterface;

class PollOptionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'vote_count',
    ];

    protected $defaultIncludes = [
        'vote_count',
    ];

    protected $permissions = [
        'vote_count' => 'ForumTopicPollOptionShowResult',
    ];

    public function transform(PollOption $pollOption): array
    {
        return [
            'id' => $pollOption->poll_option_id,
            'text' => [
                'bbcode' => $pollOption->optionTextRaw(),
                'html' => $pollOption->optionTextHTML(),
            ],
        ];
    }

    public function includeVoteCount(PollOption $pollOption): ResourceInterface
    {
        return $this->primitive($pollOption->poll_option_total);
    }
}
