<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Jobs\Notifications;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;

class BeatmapsetDiscussionPostNew extends BeatmapsetDiscussionPostHandlesProblem
{
    private Beatmapset $beatmapset;
    private BeatmapDiscussionPost $post;
    private bool $willResolvedChange = false;

    private function __construct(protected User $user, private BeatmapDiscussion $discussion, private string $message)
    {
        $this->beatmapset = $discussion->beatmapset;
        $this->post = $this->discussion->beatmapDiscussionPosts()->make(['message' => $message]);
        $this->post->user()->associate($user);
        $this->post->beatmapDiscussion()->associate($discussion);

        if ($discussion->message_type === 'problem') {
            $this->problemDiscussion = $discussion;
            $this->priorOpenProblemCount = $this->beatmapset->beatmapDiscussions()->openProblems()->count();
        }

        $this->willResolvedChange = $this->discussion->exists
            && $this->discussion->canBeResolved()
            && $this->discussion->isDirty('resolved');
    }

    public static function create(User $user, array $params)
    {
        $discussion = static::prepareDiscussion($user, $params);

        if (!$discussion->exists) {
            priv_check('BeatmapDiscussionStore', $discussion)->ensureCan();
        }

        $postParams = get_params($params, 'beatmap_discussion_post', ['message']);

        return [
            $discussion,
            (new static($user, $discussion, $postParams['message']))->handle(),
        ];
    }

    private static function prepareDiscussion(User $user, array $request): BeatmapDiscussion
    {
        $params = get_params($request, null, [
            'beatmap_discussion_id:int',
            'beatmapset_id:int',
        ], ['null_missing' => true]);

        $discussionId = $params['beatmap_discussion_id'];

        if ($discussionId === null) {
            $beatmapset = Beatmapset
                ::where('discussion_enabled', true)
                ->findOrFail($params['beatmapset_id']);

            $discussion = new BeatmapDiscussion(['resolved' => false]);
            $discussion->beatmapset()->associate($beatmapset);
            $discussion->user()->associate($user);

            $discussionFilters = [
                'beatmap_id:int',
                'message_type',
                'timestamp:int',
            ];
        } else {
            $discussion = BeatmapDiscussion::findOrFail($discussionId);
            $discussionFilters = ['resolved:bool'];
        }

        $discussionParams = get_params($request, 'beatmap_discussion', $discussionFilters);
        $discussion->fill($discussionParams);

        return $discussion;
    }

    /**
     * @return BeatmapDiscussionPost[]
     */
    public function handle(): array
    {
        priv_check_user($this->user, 'BeatmapDiscussionPostStore', $this->post)->ensureCan();

        $posts = $this->discussion->getConnection()->transaction(function () {
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

            return $newPosts;
        });

        (new Notifications\BeatmapsetDiscussionPostNew($this->post, $this->user))->dispatch();

        return $posts;
    }

    private function logResolveChange(): ?BeatmapDiscussionPost
    {
        if ($this->willResolvedChange) {
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
