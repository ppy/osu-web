<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\LovedPoll;
use League\Fractal\Resource\ResourceInterface;

class LovedPollTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'current_user_attributes',
        'description_author',
        'results',
    ];

    protected $defaultIncludes = [
        'current_user_attributes',
        'description_author',
        'results',
    ];

    protected $permissions = [
        'current_user_attributes' => 'IsNotOAuth',
    ];

    public function transform(LovedPoll $lovedPoll): array
    {
        return [
            'description' => [
                'bbcode' => $lovedPoll->description(),
                'html' => $lovedPoll->descriptionHtml(),
            ],
            'ended_at' => json_time($lovedPoll->topic->pollEnd()),
            'excluded_beatmap_ids' => $lovedPoll->excluded_beatmap_ids,
            'pass_threshold' => $lovedPoll->pass_threshold,
            'ruleset' => $lovedPoll->ruleset,
            'topic_id' => $lovedPoll->topic_id,
            'total_vote_count' => $lovedPoll->topic->poll()->totalVoteCount(),
        ];
    }

    public function includeCurrentUserAttributes(LovedPoll $lovedPoll): ResourceInterface
    {
        return $this->primitive([
            'can_vote' => priv_check('ForumTopicVote', $lovedPoll->topic)->can(),
            'can_vote_error' => priv_check('ForumTopicVote', $lovedPoll->topic)->message(),
            'vote' => auth()->check() ? $lovedPoll->votedPollOptionFor(auth()->user()) : null,
        ]);
    }

    public function includeDescriptionAuthor(LovedPoll $lovedPoll): ResourceInterface
    {
        return $lovedPoll->descriptionAuthor === null
            ? $this->null()
            : $this->item($lovedPoll->descriptionAuthor, new UserCompactTransformer());
    }

    public function includeResults(LovedPoll $lovedPoll): ResourceInterface
    {
        return $lovedPoll->topic->pollEnd()->isFuture()
            ? $this->null()
            : $this->primitive($lovedPoll->results());
    }
}
