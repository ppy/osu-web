<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Jobs\Notifications;
use App\Models\BeatmapDiscussion;
use App\Models\User;

abstract class BeatmapsetDiscussionPostHandlesProblem
{
    protected int $priorOpenProblemCount = 0;
    protected ?BeatmapDiscussion $problemDiscussion = null;
    protected User $user;

    protected function handleProblemDiscussion()
    {
        if ($this->problemDiscussion === null) {
            return;
        }

        $beatmapset = $this->problemDiscussion->beatmapset;

        if ($this->shouldDisqualifyOrResetNominations()) {
            return $beatmapset->disqualifyOrResetNominations($this->user, $this->problemDiscussion);
        }

        if ($beatmapset->isQualified() && $this->priorOpenProblemCount === 0 && !$this->problemDiscussion->resolved) {
            (new Notifications\BeatmapsetDiscussionQualifiedProblem(
                $this->problemDiscussion->startingPost,
                $this->user
            ))->dispatch();
        }
    }

    protected function shouldDisqualifyOrResetNominations(): bool
    {
        // disqualify or reset nominations requires a new discussion.
        if ($this->problemDiscussion->wasRecentlyCreated || !$this->problemDiscussion->exists) {
            $beatmapset = $this->problemDiscussion->beatmapset;
            if ($beatmapset->isQualified()) {
                if (priv_check_user($this->user, 'BeatmapsetDisqualify', $beatmapset)->can()) {
                    return true;
                }
            }

            if ($beatmapset->isPending()) {
                if ($beatmapset->hasNominations() && priv_check_user($this->user, 'BeatmapsetResetNominations', $beatmapset)->can()) {
                    return true;
                }
            }
        }

        return false;
    }
}
