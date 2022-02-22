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

    private array $posts = [];

    public function __construct(private User $user, private BeatmapDiscussion $discussion, private ?string $message, private ?bool $resolve = null)
    {
        if (!$discussion->exists) {
            throw new InvariantException('Cannot reply to a new discussion.');
        }

        if ($resolve !== null) {
            if (!$discussion->canBeResolved()) {
                throw new InvariantException("{$discussion->message_type} does not support resolving.");
            }

            if ($discussion->resolved !== $resolve) {
                if ($resolve) {
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
            $this->posts[] = $this->post;

            $this->handleResolvedChange($this->post);
            $this->handleProblemDiscussion();

            // TODO: make transactional
            (new BeatmapsetDiscussionPostNew($this->post, $this->user))->dispatch();

            return $this->posts;
        });
    }

    private function getUser(): User
    {
        return $this->user;
    }

    private function handleResolvedChange(BeatmapDiscussionPost $post)
    {
        if ($this->resolve === null) {
            return;
        }

        // if a resolved state change was requested, check if someone else got to it first.
        $discussion = $this->discussion->lockSelf();
        if ($discussion->resolved !== $this->discussion->resolved) {
            throw new InvariantException('resolved state of the discussion has changed');
        }

        if ($discussion->resolved !== $this->resolve) {
            $discussion->resolved = $this->resolve;
            $event = $discussion->resolved ? BeatmapsetEvent::ISSUE_RESOLVE : BeatmapsetEvent::ISSUE_REOPEN;

            $systemPost = BeatmapDiscussionPost::generateLogResolveChange($this->user, $discussion->resolved);
            $systemPost->beatmap_discussion_id = $discussion->getKey();
            $systemPost->saveOrExplode();
            BeatmapsetEvent::log($event, $this->user, $post)->saveOrExplode();

            $this->posts[] = $systemPost;
        }

        $discussion->saveOrExplode();

        $this->discussion = $discussion;
        if ($this->problemDiscussion !== null) {
            $this->problemDiscussion = $discussion;
        }
    }
}
