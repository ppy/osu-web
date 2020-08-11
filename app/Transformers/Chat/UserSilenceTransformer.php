<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Chat;

use App\Transformers\TransformerAbstract;

class UserSilenceTransformer extends TransformerAbstract
{
    public function transform($userAccountHistory)
    {
        return [
            'id' => $userAccountHistory->getKey(),
            'user_id' => $userAccountHistory->user_id,
        ];
    }
}
