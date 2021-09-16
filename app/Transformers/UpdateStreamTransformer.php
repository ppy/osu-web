<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UpdateStream;

class UpdateStreamTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'latest_build',
        'user_count',
    ];

    public function transform(UpdateStream $stream)
    {
        return [
            'id' => $stream->getKey(),
            'name' => $stream->name,
            'display_name' => $stream->pretty_name,
            'is_featured' => $stream->isFeatured(),
        ];
    }

    public function includeLatestBuild(UpdateStream $stream)
    {
        return $this->item($stream->latestBuild(), new BuildTransformer());
    }

    public function includeUserCount(UpdateStream $stream)
    {
        return $this->primitive($stream->userCount());
    }
}
