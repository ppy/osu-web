<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UserGroup;

class UserGroupTransformer extends TransformerAbstract
{
    public function transform(UserGroup $userGroup)
    {
        // TODO: "group" should be an include. implemented like this for now
        // to keep API backward-compatible
        return array_merge(
            json_item($userGroup->group, 'Group'),
            ['playmodes' => $userGroup->playmodes],
        );
    }
}
