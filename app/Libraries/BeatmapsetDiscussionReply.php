<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapsetDiscussionPostNew;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapsetEvent;
use App\Models\User;

class BeatmapsetDiscussionReply
{
    use HandlesProblemBeatmapsetDiscussionPost;

    private BeatmapDiscussionPost $post;
    private bool $resolvedWillChange = false;

    public function __construct(private User $user, private BeatmapDiscussion $discussion, private ?string $message, private ?bool $resolve = null)
    {
        if (!$discussion->exists) {
            throw new InvariantException('Cannot reply to a new discussion.');
        }

        if ($resolve !== null) {
            if (!$discussion->canBeResolved()) {
                throw new InvariantException("{$discussion->message_type} does not support resolving.");
            }

            $this->resolvedWillChange = $discussion->resolved !== $resolve;
            $discussion->resolved = $resolve;

            if ($this->resolvedWillChange) {
                if ($discussion->resolved) {
                    priv_check_user($user, 'BeatmapDiscussionResolve', $discussion)->ensureCan();
                } else {
                    priv_check_user($user, 'BeatmapDiscussionReopen', $discussion)->ensureCan();
                }
            }
        }

        $this->post = $this->discussion->beatmapDiscussionPosts()->make(['message' => $message]);
        $this->post->user()->associate($user);
        $this->post->beatmapDiscussion()->associate($discussion);

        priv_check_user($this->user, 'BeatmapDiscussionPostStore', $this->post)->ensureCan();

        if ($discussion->message_type === 'problem') {
            $this->problemDiscussion = $discussion;
            $this->hasPriorOpenProblems = $discussion->beatmapset->beatmapDiscussions()->openProblems()->exists();
        }
    }

    /**
     * @return BeatmapDiscussionPost[]
     */
    public function handle(): array
    {
        return $this->post->getConnection()->transaction(function () {
            $this->post->saveOrExplode();
            $newPosts = [$this->post];

            $systemPost = $this->handleResolvedChange();
            if ($systemPost !== null) {
                $newPosts[] = $systemPost;
            }

            $this->handleProblemDiscussion();

            // TODO: make transactional
            (new BeatmapsetDiscussionPostNew($this->post, $this->user))->dispatch();

            return $newPosts;
        });
    }

    private function getUser(): User
    {
        return $this->user;
    }

    private function handleResolvedChange(): ?BeatmapDiscussionPost
    {
        if (!$this->resolvedWillChange) {
            return null;
        }

        $event = $this->discussion->resolved ? BeatmapsetEvent::ISSUE_RESOLVE : BeatmapsetEvent::ISSUE_REOPEN;

        $systemPost = BeatmapDiscussionPost::generateLogResolveChange($this->user, $this->discussion->resolved);
        $systemPost->beatmap_discussion_id = $this->discussion->getKey();
        $systemPost->saveOrExplode();
        BeatmapsetEvent::log($event, $this->user, $this->post)->saveOrExplode();

        return $systemPost;
    }
}
