<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Group;

class GroupTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['description'];

    public function transform(Group $group)
    {
        return [
            'colour' => $group->colour,
            'has_listing' => $group->hasListing(),
            'has_playmodes' => $group->has_playmodes,
            'id' => $group->getKey(),
            'identifier' => $group->identifier,
            'is_probationary' => $group->isProbationary(),
            'name' => $group->group_name,
            'short_name' => $group->short_name,
        ];
    }

    public function includeDescription(Group $group)
    {
        return $this->primitive([
            'html' => $group->descriptionHtml(),
            'markdown' => $group->group_desc,
        ]);
    }
}
