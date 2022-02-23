<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Jobs\Notifications;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;

class BeatmapsetDiscussionNew
{
    use HandlesProblemBeatmapsetDiscussionPost;

    private BeatmapDiscussion $discussion;
    private ?string $message;

    public function __construct(private User $user, private Beatmapset $beatmapset, array $request)
    {
        priv_check_user($this->user, 'BeatmapDiscussionPostStore', $beatmapset)->ensureCan();

        $params = get_params($request, 'beatmap_discussion', [
            'beatmap_id:int',
            'message_type',
            'timestamp:int',
        ], ['null_missing' => true]);

        $this->discussion = new BeatmapDiscussion(['resolved' => false]);
        $this->discussion->fill($params);
        $this->discussion->beatmapset()->associate($beatmapset);
        $this->discussion->user()->associate($user);

        priv_check_user($user, 'BeatmapDiscussionStore', $this->discussion)->ensureCan();

        $this->message = presence(get_string($request['beatmap_discussion_post']['message'] ?? null));

        if ($this->discussion->isProblem()) {
            $this->problemDiscussion = $this->discussion;
            $this->hasPriorOpenProblems = $this->discussion->beatmapset->beatmapDiscussions()->openProblems()->exists();
        }
    }

    public function handle(): array
    {
        return $this->discussion->getConnection()->transaction(function () {
            $this->discussion->saveOrExplode();

            $post = $this->discussion->beatmapDiscussionPosts()->make(['message' => $this->message]);
            $post->user()->associate($this->user);
            $post->saveOrExplode();

            $this->handleProblemDiscussion();

            // TODO: make transactional
            (new Notifications\BeatmapsetDiscussionPostNew($post, $this->user))->dispatch();

            return [$this->discussion, [$post]];
        });
    }

    private function getUser(): User
    {
        return $this->user;
    }
}
