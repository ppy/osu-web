<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\GithubUser;

class GithubUserTransformer extends TransformerAbstract
{
    public function transform(GithubUser $githubUser): array
    {
        return [
            'display_name' => $githubUser->displayUsername(),
            'github_url' => $githubUser->githubUrl(),
            'github_username' => $githubUser->username,
            'id' => $githubUser->getKey(),
            'osu_username' => $githubUser->osuUsername(),
            'user_id' => $githubUser->user_id,
            'user_url' => $githubUser->userUrl(),
        ];
    }
}
