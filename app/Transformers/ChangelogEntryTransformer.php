<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers;

use App\Models\ChangelogEntry;
use App\Models\GithubUser;
use League\Fractal;

class ChangelogEntryTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'github_user',
    ];

    public function transform(ChangelogEntry $entry)
    {
        return [
            'id' => $entry->getKey(),
            'repository' => optional($entry->repository)->name,
            'github_pull_request_id' => $entry->github_pull_request_id,
            'github_url' => $entry->githubUrl(),
            'url' => $entry->url,
            'type' => $entry->type,
            'category' => $entry->category,
            'title' => $entry->title,
            'message_html' => $entry->messageHTML(),
            'major' => $entry->major,
            'created_at' => json_time($entry->created_at),
        ];
    }

    public function includeGithubUser(ChangelogEntry $entry)
    {
        return $this->item($entry->githubUser ?? new GithubUser, new GithubUserTransformer);
    }
}
