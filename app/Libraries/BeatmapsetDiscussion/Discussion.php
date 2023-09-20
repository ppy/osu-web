<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\BeatmapsetDiscussion;

use App\Jobs\Notifications\BeatmapsetDiscussionPostNew;
use App\Libraries\BeatmapsetDiscussion\Traits\HandlesProblem;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\User;

class Discussion
{
    use HandlesProblem;

    private BeatmapDiscussion $discussion;

    public function __construct(private User $user, private Beatmapset $beatmapset, array $discussionParams, private ?string $message)
    {
        $this->discussion = $beatmapset->beatmapDiscussions()->make($discussionParams);
        $this->discussion->beatmapset()->associate($beatmapset);
        $this->discussion->user()->associate($user);

        priv_check_user($user, 'BeatmapsetDiscussionNew', $this->discussion)->ensureCan();

        $this->maybeSetProblemDiscussion($this->discussion);
    }

    public function handle(): array
    {
        $newPost = $this->discussion->getConnection()->transaction(function () {
            $this->discussion->saveOrExplode();

            $post = $this->discussion->beatmapDiscussionPosts()->make(['message' => $this->message]);
            $post->beatmapDiscussion()->associate($this->discussion);
            $post->user()->associate($this->user);
            $post->saveOrExplode();

            $this->handleProblemDiscussion();

            return $post;
        });

        // TODO: make transactional
        (new BeatmapsetDiscussionPostNew($newPost, $this->user))->dispatch();

        return [$this->discussion, [$newPost]];
    }
}
