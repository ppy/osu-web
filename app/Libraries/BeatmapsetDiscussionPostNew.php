<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Jobs\Notifications;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;

class BeatmapsetDiscussionPostNew
{
    private BeatmapDiscussionPost $post;
    private Beatmapset $beatmapset;

    public function __construct(private User $user, private BeatmapDiscussion $discussion, private string $message)
    {
        $this->beatmapset = $discussion->beatmapset;
        $this->post = $this->discussion->beatmapDiscussionPosts()->make(['message' => $message]);
        $this->post->user()->associate($user);
        $this->post->beatmapDiscussion()->associate($discussion);
    }

    /**
     * @return BeatmapDiscussionPost[]
     */
    public function handle(): array
    {
        priv_check_user($this->user, 'BeatmapDiscussionPostStore', $this->post)->ensureCan();

        $event = BeatmapsetEvent::getBeatmapsetEventType($this->discussion, $this->user);
        $notifyQualifiedProblem = $this->discussion->shouldNotifyQualifiedProblem($event);

        $posts = $this->discussion->getConnection()->transaction(function () use ($event) {
            $this->discussion->saveOrExplode();

            // done here since discussion may or may not previously exist
            $this->post->beatmap_discussion_id = $this->discussion->getKey();
            $this->post->saveOrExplode();
            $newPosts = [$this->post];

            switch ($event) {
                case BeatmapsetEvent::ISSUE_REOPEN:
                case BeatmapsetEvent::ISSUE_RESOLVE:
                    $systemPost = BeatmapDiscussionPost::generateLogResolveChange($this->user, $this->discussion->resolved);
                    $systemPost->beatmap_discussion_id = $this->discussion->getKey();
                    $systemPost->saveOrExplode();
                    BeatmapsetEvent::log($event, $this->user, $this->post)->saveOrExplode();
                    $newPosts[] = $systemPost;
                    break;

                case BeatmapsetEvent::DISQUALIFY:
                case BeatmapsetEvent::NOMINATION_RESET:
                    $this->beatmapset->disqualifyOrResetNominations($this->user, $this->discussion);
                    break;
            }

            return $newPosts;
        });

        if ($notifyQualifiedProblem) {
            (new Notifications\BeatmapsetDiscussionQualifiedProblem($this->post, $this->user))->dispatch();
        }

        (new Notifications\BeatmapsetDiscussionPostNew($this->post, $this->user))->dispatch();

        return $posts;
    }
}
