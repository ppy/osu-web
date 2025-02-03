<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UserRelation;
use League\Fractal\ParamBag;

class UserRelationTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'target',
    ];

    public function transform(UserRelation $userRelation)
    {
        return [
            'target_id' => $userRelation->zebra_id,
            'relation_type' => $userRelation->friend ? 'friend' : 'block',
            // mutual is a bit derpy, it only applies to friends
            'mutual' => (bool) $userRelation->mutual,
        ];
    }

    public function includeTarget(UserRelation $userRelation, ?ParamBag $params = null)
    {
        $transformer = new UserCompactTransformer();

        $rulesetName = $params?->get('ruleset')[0];
        if ($rulesetName !== null) {
            $transformer->setMode($rulesetName);
        }

        return $this->item($userRelation->target, $transformer);
    }
}
