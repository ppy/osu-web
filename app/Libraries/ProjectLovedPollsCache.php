<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Models\Forum\Topic;
use App\Models\User;
use App\Traits\LocallyCached;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ProjectLovedPollsCache
{
    use LocallyCached;

    /**
     * Get all topics on the Project Loved forum that have an open poll and finite poll length.
     */
    public function all(): Collection
    {
        $topics = $this->cachedMemoize(__FUNCTION__, function () {
            return Topic
                ::where('forum_id', config('osu.forum.project_loved_forum_id'))
                ->whereRaw('poll_start + poll_length > ?', [Carbon::now()->getTimestamp()])
                ->get();
        });

        if ($topics->contains(fn (Topic $topic) => !$topic->poll()->isOpen())) {
            $this->resetCache();
            return $this->all();
        }

        return $topics;
    }

    /**
     * Check if the user voted in any open Project Loved polls.
     */
    public function userVotedAny(User $user): bool
    {
        return $this->memoize(__FUNCTION__.':'.$user->getKey(), function () use ($user) {
            return $this->all()->contains(fn (Topic $topic) => $topic->poll()->votedBy($user));
        });
    }
}
