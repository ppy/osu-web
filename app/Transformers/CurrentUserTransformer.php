<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

class CurrentUserTransformer extends UserTransformer
{
    public function __construct()
    {
        $this->defaultIncludes = [
            ...$this->defaultIncludes,
            'blocks',
            'follow_user_mapping',
            'friends',
            'groups',
            'is_admin',
            'unread_pm_count',
            'user_preferences',
        ];
    }
}
