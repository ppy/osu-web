<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\GithubUser;

class GithubUserTransformer extends TransformerAbstract
{
    public function transform(GithubUser $githubUser)
    {
        return [
            'id' => $githubUser->getKey(),
            'display_name' => $githubUser->displayName(),
            'github_url' => $githubUser->githubUrl(),
            'osu_username' => optional($githubUser->user)->username,
            'user_id' => $githubUser->user_id,
            'user_url' => $githubUser->userUrl(),
        ];
    }
}
