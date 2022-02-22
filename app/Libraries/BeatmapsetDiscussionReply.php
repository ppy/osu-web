<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapsetDiscussionPostNew;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;

class BeatmapsetDiscussionReply
{
    use HandlesProblemBeatmapsetDiscussionPost;

    private Beatmapset $beatmapset;
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
        }

        priv_check_user($user, 'BeatmapDiscussionStore', $discussion)->ensureCan();

        $this->beatmapset = $discussion->beatmapset;
        $this->post = $this->discussion->beatmapDiscussionPosts()->make(['message' => $message]);
        $this->post->user()->associate($user);
        $this->post->beatmapDiscussion()->associate($discussion);

        priv_check_user($this->user, 'BeatmapDiscussionPostStore', $this->post)->ensureCan();

        if ($discussion->message_type === 'problem') {
            $this->problemDiscussion = $discussion;
            $this->hasPriorOpenProblems = $this->beatmapset->beatmapDiscussions()->openProblems()->exists();
        }
    }

    /**
     * @return BeatmapDiscussionPost[]
     */
    public function handle(): array
    {
        return $this->discussion->getConnection()->transaction(function () {
            $this->discussion->saveOrExplode();

            // done here since discussion may or may not previously exist
            $this->post->beatmap_discussion_id = $this->discussion->getKey();
            $this->post->saveOrExplode();
            $newPosts = [$this->post];

            $systemPost = $this->logResolveChange();
            if ($systemPost !== null) {
                $newPosts[] = $systemPost;
            }

            $this->handleProblemDiscussion();

            // TODO: make transactional
            (new BeatmapsetDiscussionPostNew($this->post, $this->user))->dispatch();

            return $newPosts;
        });
    }

    private function logResolveChange(): ?BeatmapDiscussionPost
    {
        if ($this->resolvedWillChange) {
            if ($this->discussion->resolved) {
                priv_check_user($this->user, 'BeatmapDiscussionResolve', $this->discussion)->ensureCan();

                $event = BeatmapsetEvent::ISSUE_RESOLVE;
            } else {
                priv_check_user($this->user, 'BeatmapDiscussionReopen', $this->discussion)->ensureCan();

                $event = BeatmapsetEvent::ISSUE_REOPEN;
            }
        }

        if (!isset($event)) {
            return null;
        }

        $systemPost = BeatmapDiscussionPost::generateLogResolveChange($this->user, $this->discussion->resolved);
        $systemPost->beatmap_discussion_id = $this->discussion->getKey();
        $systemPost->saveOrExplode();
        BeatmapsetEvent::log($event, $this->user, $this->post)->saveOrExplode();

        return $systemPost;
    }
}
