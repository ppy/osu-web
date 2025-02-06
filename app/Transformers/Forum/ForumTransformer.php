<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Forum;

use App\Models\Forum\Forum;
use App\Transformers\TransformerAbstract;
use League\Fractal\Resource\ResourceInterface;

class ForumTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'subforums',
    ];

    public function transform(Forum $forum): array
    {
        return [
            'id' => $forum->getKey(),
            'name' => $forum->forum_name,
            'description' => $forum->forum_desc,
        ];
    }

    public function includeSubforums(Forum $forum): ResourceInterface
    {
        return $this->collection(
            $forum->subforums,
            new static()
        );
    }
}
