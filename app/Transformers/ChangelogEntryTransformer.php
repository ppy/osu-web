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
