<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Jobs\Notifications;
use App\Models\BeatmapDiscussion;
use App\Models\User;

// TODO: should go into namespace
trait HandlesProblemBeatmapsetDiscussionPost
{
    private bool $hasPriorOpenProblems = false;
    private ?BeatmapDiscussion $problemDiscussion = null;

    abstract private function getUser(): User;

    private function handleProblemDiscussion()
    {
        if ($this->problemDiscussion === null) {
            return;
        }

        $beatmapset = $this->problemDiscussion->beatmapset;

        if ($this->shouldDisqualifyOrResetNominations()) {
            return $beatmapset->disqualifyOrResetNominations($this->getUser(), $this->problemDiscussion);
        }

        if ($beatmapset->isQualified() && !$this->hasPriorOpenProblems && !$this->problemDiscussion->resolved) {
            (new Notifications\BeatmapsetDiscussionQualifiedProblem(
                $this->problemDiscussion->startingPost,
                $this->getUser()
            ))->dispatch();
        }
    }

    private function shouldDisqualifyOrResetNominations(): bool
    {
        // disqualify or reset nominations requires a new discussion.
        if ($this->problemDiscussion->wasRecentlyCreated || !$this->problemDiscussion->exists) {
            $beatmapset = $this->problemDiscussion->beatmapset;
            if ($beatmapset->isQualified()) {
                return priv_check_user($this->getUser(), 'BeatmapsetDisqualify', $beatmapset)->can();
            } elseif ($beatmapset->isPending()) {
                return $beatmapset->hasNominations()
                    && priv_check_user($this->getUser(), 'BeatmapsetResetNominations', $beatmapset)->can();
            }
        }

        return false;
    }
}
