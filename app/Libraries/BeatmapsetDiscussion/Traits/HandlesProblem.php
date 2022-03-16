<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\BeatmapsetDiscussion\Traits;

use App\Jobs\Notifications\BeatmapsetDiscussionQualifiedProblem;
use App\Models\BeatmapDiscussion;
use App\Models\User;

trait HandlesProblem
{
    private bool $hasPriorOpenProblems = false;
    private bool $isNew = false;
    private ?BeatmapDiscussion $problemDiscussion = null;
    private User $user;

    private function handleProblemDiscussion(): void
    {
        if ($this->problemDiscussion === null) {
            return;
        }

        $beatmapset = $this->problemDiscussion->beatmapset;

        if ($this->shouldDisqualifyOrResetNominations()) {
            $beatmapset->disqualifyOrResetNominations($this->user, $this->problemDiscussion);

            return;
        }

        if ($beatmapset->isQualified() && !$this->hasPriorOpenProblems && !$this->problemDiscussion->resolved) {
            (new BeatmapsetDiscussionQualifiedProblem(
                $this->problemDiscussion->startingPost,
                $this->user
            ))->dispatch();
        }
    }

    /**
     * This should be called _before_ any updates to the problem discussion are saved.
     *
     * @param BeatmapDiscussion $discussion The discussion flagging the problem.
     * @param bool $isNew Whether the discussion should be considered a new discussion or reply.
     */
    private function maybeSetProblemDiscussion(BeatmapDiscussion $discussion, bool $isNew = true)
    {
        if ($discussion->isProblem() && $this->problemDiscussion === null) {
            $this->hasPriorOpenProblems = $discussion->beatmapset->beatmapDiscussions()->openProblems()->exists();
            $this->problemDiscussion = $discussion;
            $this->isNew = $isNew;
        }
    }

    private function shouldDisqualifyOrResetNominations(): bool
    {
        // disqualify or reset nominations requires a new discussion.
        if ($this->problemDiscussion !== null && $this->isNew) {
            $beatmapset = $this->problemDiscussion->beatmapset;
            if ($beatmapset->isQualified()) {
                return priv_check_user($this->user, 'BeatmapsetDisqualify', $beatmapset)->can();
            } elseif ($beatmapset->isPending()) {
                return $beatmapset->hasNominations()
                    && priv_check_user($this->user, 'BeatmapsetResetNominations', $beatmapset)->can();
            }
        }

        return false;
    }
}
