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

use App\Models\UserRelation;
use League\Fractal;

class UserRelationTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'target',
    ];

    public function transform(UserRelation $userRelation)
    {
        return [
            'target_id' => $userRelation->zebra_id,
            'relation_type' => $userRelation->friend ? 'friend' : 'block',
            // mutual is a bit derpy, it only applies to friends
            'mutual' => $userRelation->mutual,
        ];
    }

    public function includeTarget(UserRelation $userRelation)
    {
        return $this->item($userRelation->target, new UserCompactTransformer);
    }
}
