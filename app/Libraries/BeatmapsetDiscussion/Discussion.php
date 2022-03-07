<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\BeatmapsetDiscussion;

use App\Jobs\Notifications\BeatmapsetDiscussionPostNew;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\User;

class Discussion
{
    use HandlesProblem;

    private BeatmapDiscussion $discussion;
    private ?string $message;

    public function __construct(private User $user, private Beatmapset $beatmapset, array $request)
    {
        $params = get_params($request, 'beatmap_discussion', [
            'beatmap_id:int',
            'message_type',
            'timestamp:int',
        ], ['null_missing' => true]);

        $this->discussion = $beatmapset->beatmapDiscussions()->make($params);
        $this->discussion->beatmapset()->associate($beatmapset);
        $this->discussion->user()->associate($user);

        priv_check_user($user, 'BeatmapsetDiscussionNew', $this->discussion)->ensureCan();

        $this->message = presence(get_string($request['beatmap_discussion_post']['message'] ?? null));

        $this->maybeSetProblemDiscussion($this->discussion);
    }

    public function handle(): array
    {
        return $this->discussion->getConnection()->transaction(function () {
            $this->discussion->saveOrExplode();

            $post = $this->discussion->beatmapDiscussionPosts()->make(['message' => $this->message]);
            $post->beatmapDiscussion()->associate($this->discussion);
            $post->user()->associate($this->user);
            $post->saveOrExplode();

            $this->handleProblemDiscussion();

            // TODO: make transactional
            (new BeatmapsetDiscussionPostNew($post, $this->user))->dispatch();

            return [$this->discussion, [$post]];
        });
    }

    private function getUser(): User
    {
        return $this->user;
    }
}
