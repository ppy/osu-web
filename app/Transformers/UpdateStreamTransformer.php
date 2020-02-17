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

use App\Models\UpdateStream;
use League\Fractal;

class UpdateStreamTransformer extends Fractal\TransformerAbstract
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
        return $this->item($stream->latestBuild(), new BuildTransformer);
    }

    public function includeUserCount(UpdateStream $stream)
    {
        return $this->primitive($stream->userCount());
    }
}
