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

namespace App\Libraries;

use App\Models\Build;
use App\Models\ChangelogEntry;

class GithubImporter
{
    public $eventType;
    public $data;
    public $repository;

    public function __construct($params)
    {
        $this->data = $params['data'];
        $this->eventType = $params['eventType'];
        $this->repository = $this->data['repository']['name'];
    }

    public function import()
    {
        if ($this->repository === OsuWiki::repository() && $this->isMasterPush()) {
            OsuWiki::updateFromGithub($this->data);
        } elseif ($this->isMergedPullRequest()) {
            return ChangelogEntry::importFromGithub($this->data);
        } elseif ($this->isNewTag()) {
            return Build::importFromGithubNewTag($this->data);
        }
    }

    public function isMergedPullRequest()
    {
        return $this->eventType === 'pull_request' &&
            $this->data['action'] === 'closed' &&
            $this->data['pull_request']['merged'];
    }

    public function isNewTag()
    {
        return $this->eventType === 'push' &&
            starts_with($this->data['ref'], 'refs/tags/');
    }

    public function isMasterPush()
    {
        return $this->eventType === 'push' &&
            $this->data['ref'] === 'refs/heads/master';
    }
}
