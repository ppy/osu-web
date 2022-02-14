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

class BeatmapsetDiscussionPostNew
{
    private BeatmapDiscussionPost $post;
    private Beatmapset $beatmapset;

    private ?string $event;

    private function __construct(private User $user, private BeatmapDiscussion $discussion, private string $message)
    {
        $this->beatmapset = $discussion->beatmapset;
        $this->post = $this->discussion->beatmapDiscussionPosts()->make(['message' => $message]);
        $this->post->user()->associate($user);
        $this->post->beatmapDiscussion()->associate($discussion);
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

        $this->event = BeatmapsetEvent::getBeatmapsetEventType($this->discussion, $this->user);
        $notifyQualifiedProblem = $this->shouldNotifyQualifiedProblem();

        $posts = $this->discussion->getConnection()->transaction(function () {
            $this->discussion->saveOrExplode();

            // done here since discussion may or may not previously exist
            $this->post->beatmap_discussion_id = $this->discussion->getKey();
            $this->post->saveOrExplode();
            $newPosts = [$this->post];

            $systemPost = $this->logEvent();
            if ($systemPost !== null) {
                $newPosts[] = $systemPost;
            }

            $this->disqualifyOrResetNominations();

            return $newPosts;
        });

        if ($notifyQualifiedProblem) {
            (new Notifications\BeatmapsetDiscussionQualifiedProblem($this->post, $this->user))->dispatch();
        }

        (new Notifications\BeatmapsetDiscussionPostNew($this->post, $this->user))->dispatch();

        return $posts;
    }

    private function disqualifyOrResetNominations()
    {
        if (in_array($this->event, [BeatmapsetEvent::DISQUALIFY, BeatmapsetEvent::NOMINATION_RESET], true)) {
            $this->beatmapset->disqualifyOrResetNominations($this->user, $this->discussion);
        }
    }

    private function logEvent(): ?BeatmapDiscussionPost
    {
        if (!in_array($this->event, [BeatmapsetEvent::ISSUE_REOPEN, BeatmapsetEvent::ISSUE_RESOLVE], true)) {
            return null;
        }

        $systemPost = BeatmapDiscussionPost::generateLogResolveChange($this->user, $this->discussion->resolved);
        $systemPost->beatmap_discussion_id = $this->discussion->getKey();
        $systemPost->saveOrExplode();
        BeatmapsetEvent::log($this->event, $this->user, $this->post)->saveOrExplode();

        return $systemPost;
    }

    /**
     * To get the correct result, this should be called before discussions are updated, as it checks the open problems count.
     */
    private function shouldNotifyQualifiedProblem(): bool
    {
        return $this->beatmapset->isQualified() && (
            $this->event === BeatmapsetEvent::ISSUE_REOPEN
            || $this->event === null && !$this->discussion->exists && $this->discussion->isProblem()
        ) && $this->beatmapset->beatmapDiscussions()->openProblems()->count() === 0;
    }
}
