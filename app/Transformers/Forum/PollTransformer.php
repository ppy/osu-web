<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Forum;

use App\Models\Forum\Topic;
use App\Transformers\TransformerAbstract;
use League\Fractal\Resource\ResourceInterface;

class PollTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'options',
        'total_vote_count',
    ];

    protected $defaultIncludes = [
        'options',
        'total_vote_count',
    ];

    public function transform(Topic $topic): array
    {
        return [
            'allow_vote_change' => $topic->poll_vote_change,
            'ended_at' => json_time($topic->pollEnd()),
            'hide_incomplete_results' => $topic->poll_hide_results,
            'last_vote_at' => json_time($topic->poll_last_vote),
            'max_votes' => $topic->poll_max_options,
            'started_at' => json_time($topic->poll_start),
            'title' => [
                'bbcode' => $topic->pollTitleRaw(),
                'html' => $topic->pollTitleHTML(),
            ],
        ];
    }

    public function includeOptions(Topic $topic): ResourceInterface
    {
        return $this->collection($topic->pollOptions, new PollOptionTransformer());
    }

    public function includeTotalVoteCount(Topic $topic): ResourceInterface
    {
        return $this->primitive($topic->totalVoteCount());
    }
}
