<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\AuthorizationException;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\Chat\Channel;
use App\Models\Comment;
use App\Models\Contest;
use App\Models\Forum\Authorize as ForumAuthorize;
use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicCover;
use App\Models\Multiplayer\Match;
use App\Models\OAuth\Client;
use App\Models\User;
use App\Models\UserContestEntry;
use Carbon\Carbon;

class OsuAuthorize
{
    const ALWAYS_CHECK = [
        'IsOwnClient',
        'IsNotOAuth',
        'IsSpecialScope',
    ];

    /** @var AuthorizationResult[] */
    private $cache = [];

    public function cacheReset(): void
    {
        $this->cache = [];
    }

    /**
     * @param User|null $user
     * @param string $ability
     * @param object|null $object
     * @return AuthorizationResult
     */
    public function doCheckUser(?User $user, string $ability, object $object = null): AuthorizationResult
    {
        $cacheKey = serialize([
            $ability,
            $user === null ? null : $user->getKey(),
            $object === null ? null : [$object->getTable(), $object->getKey()],
        ]);

        if (!isset($this->cache[$cacheKey])) {
            if ($user !== null && $user->isAdmin() && !in_array($ability, static::ALWAYS_CHECK, true)) {
                $message = 'ok';
            } else {
                $function = "check{$ability}";

                try {
                    $message = $this->$function($user, $object);
                } catch (AuthorizationException $e) {
                    $message = $e->getMessage();
                }
            }

            $this->cache[$cacheKey] = new AuthorizationResult($message);
        }

        return $this->cache[$cacheKey];
    }

    /**
     * @param User|null $user
     * @param Beatmap $beatmap
     * @return string
     */
    public function checkBeatmapShow(?User $user, Beatmap $beatmap): string
    {
        if (!$beatmap->trashed()) {
            return 'ok';
        }

        if ($this->doCheckUser($user, 'BeatmapsetShow', $beatmap->beatmapset)->can()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussion|null $discussion
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionAllowOrDenyKudosu(?User $user, ?BeatmapDiscussion $discussion): string
    {
        $this->ensureLoggedIn($user);

        if ($user->isBNG() || $user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussion $discussion
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionDestroy(?User $user, BeatmapDiscussion $discussion): string
    {
        $prefix = 'beatmap_discussion.destroy.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($user->isModerator()) {
            return 'ok';
        }

        if ($user->user_id !== $discussion->user_id) {
            return 'unauthorized';
        }

        if ($discussion->message_type === 'hype') {
            return $prefix.'is_hype';
        }

        if ($discussion->relationLoaded('beatmapDiscussionPosts')) {
            $visiblePosts = 0;

            foreach ($discussion->beatmapDiscussionPosts as $post) {
                if ($post->deleted_at !== null || $post->system) {
                    continue;
                }

                $visiblePosts++;

                if ($visiblePosts > 1) {
                    return $prefix.'has_reply';
                }
            }
        } elseif ($discussion->beatmapDiscussionPosts()->withoutTrashed()->withoutSystem()->count() > 1) {
            return $prefix.'has_reply';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionModerate(?User $user): string
    {
        $this->ensureLoggedIn($user);

        if ($user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussion $discussion
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionReopen(?User $user, BeatmapDiscussion $discussion): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussion $discussion
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionResolve(?User $user, BeatmapDiscussion $discussion): string
    {
        $prefix = 'beatmap_discussion.resolve.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($user->user_id === $discussion->user_id) {
            return 'ok';
        }

        if ($user->user_id === $discussion->beatmapset->user_id && $discussion->beatmapset->approved !== Beatmapset::STATES['qualified']) {
            return 'ok';
        }

        if ($user->isModerator()) {
            return 'ok';
        }

        return $prefix.'not_owner';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussion $discussion
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionRestore(?User $user, BeatmapDiscussion $discussion): string
    {
        $this->ensureLoggedIn($user);

        if ($user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Beatmapset $beatmapset
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetDiscussionReviewStore(?User $user, Beatmapset $beatmapset): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);
        $this->ensureHasPlayed($user);

        if ($beatmapset->discussion_locked) {
            return 'beatmap_discussion_post.store.beatmapset_locked';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussion $discussion
     * @return string
     */
    public function checkBeatmapDiscussionShow(?User $user, BeatmapDiscussion $discussion): string
    {
        if ($discussion->deleted_at === null) {
            if ($discussion->beatmap_id === null) {
                return 'ok';
            }

            if ($this->doCheckUser($user, 'BeatmapShow', $discussion->beatmap)->can()) {
                return 'ok';
            }
        }

        if ($user !== null && $user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussion $discussion
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionStore(?User $user, BeatmapDiscussion $discussion): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);
        $this->ensureHasPlayed($user);

        if ($discussion->message_type === 'mapper_note') {
            if ($user->getKey() !== $discussion->beatmapset->user_id && !$user->isModerator() && !$user->isBNG()) {
                return 'beatmap_discussion.store.mapper_note_wrong_user';
            }
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussion $discussion
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionVote(?User $user, BeatmapDiscussion $discussion): string
    {
        $prefix = 'beatmap_discussion.vote.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        static $votableStates = [
            Beatmapset::STATES['wip'],
            Beatmapset::STATES['pending'],
            Beatmapset::STATES['qualified'],
        ];

        if (!in_array($discussion->beatmapset->approved, $votableStates, true)) {
            if (!$user->isBNG() && !$user->isModerator()) {
                return $prefix.'wrong_beatmapset_state';
            }
        }

        if ($discussion->user_id === $user->user_id) {
            return $prefix.'owner';
        }

        if ($user->isBNG() || $user->isModerator()) {
            return 'ok';
        }

        // rate limit
        $recentVotesCount = $user
            ->beatmapDiscussionVotes()
            ->where('created_at', '>', Carbon::now()->subHour())
            ->count();

        if ($recentVotesCount > 60) {
            return $prefix.'limit_exceeded';
        }

        if ($discussion->userRecentVotesCount($user) >= 3) {
            return $prefix.'limit_exceeded';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussion $discussion
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionVoteDown(?User $user, BeatmapDiscussion $discussion): string
    {
        $prefix = 'beatmap_discussion.vote.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($discussion->user_id === $user->user_id) {
            return $prefix.'owner';
        }

        if ($user->isBNG() || $user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussionPost $post
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionPostDestroy(?User $user, BeatmapDiscussionPost $post): string
    {
        $prefix = 'beatmap_discussion_post.destroy.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($post->system) {
            return $prefix.'system_generated';
        }

        if ($user->isModerator()) {
            return 'ok';
        }

        if ($user->user_id !== $post->user_id) {
            return $prefix.'not_owner';
        }

        if (!$post->canEdit()) {
            return $prefix.'resolved';
        }

        if ($post->beatmapDiscussion->beatmapset->discussion_locked) {
            return 'beatmap_discussion_post.store.beatmapset_locked';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussionPost $post
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionPostEdit(?User $user, BeatmapDiscussionPost $post): string
    {
        $prefix = 'beatmap_discussion_post.edit.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($post->system) {
            return $prefix.'system_generated';
        }

        if ($user->user_id !== $post->user_id) {
            return $prefix.'not_owner';
        }

        if (!$post->canEdit()) {
            return $prefix.'resolved';
        }

        if ($post->beatmapDiscussion->beatmapset->discussion_locked) {
            return 'beatmap_discussion_post.store.beatmapset_locked';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussionPost $post
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionPostRestore(?User $user, BeatmapDiscussionPost $post): string
    {
        $this->ensureLoggedIn($user);

        if ($user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussionPost $post
     * @return string
     */
    public function checkBeatmapDiscussionPostShow(?User $user, BeatmapDiscussionPost $post): string
    {
        if ($post->deleted_at === null) {
            return 'ok';
        }

        if ($user !== null && $user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param BeatmapDiscussionPost $post
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapDiscussionPostStore(?User $user, BeatmapDiscussionPost $post): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);
        $this->ensureHasPlayed($user);

        if ($user->isModerator()) {
            return 'ok';
        }

        if ($post->beatmapDiscussion->beatmapset->discussion_locked) {
            return 'beatmap_discussion_post.store.beatmapset_locked';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Beatmapset $beatmapset
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetDelete(?User $user, Beatmapset $beatmapset): string
    {
        $this->ensureLoggedIn($user);

        if ($beatmapset->isGraveyard() && $user->getKey() === $beatmapset->user_id) {
            return 'ok';
        }

        if (!$beatmapset->isScoreable() && $user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetLove(?User $user): string
    {
        $this->ensureLoggedIn($user);

        if (!$user->isProjectLoved()) {
            return 'unauthorized';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Beatmapset $beatmapset
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetNominate(?User $user, Beatmapset $beatmapset): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        static $prefix = 'beatmap_discussion.nominate.';

        if (!$user->isBNG() && !$user->isNAT()) {
            return 'unauthorized';
        }

        if ($beatmapset->approved !== Beatmapset::STATES['pending']) {
            return $prefix.'incorrect_state';
        }

        if ($user->beatmapsetNominationsToday() >= config('osu.beatmapset.user_daily_nominations')) {
            return $prefix.'exhausted';
        }

        if ($user->getKey() === $beatmapset->user_id) {
            return $prefix.'owner';
        }

        if ($user->isLimitedBN()) {
            if ($beatmapset->playmodeCount() > 1) {
                return $prefix.'full_bn_required_hybrid';
            }

            if ($beatmapset->requiresFullBNNomination()) {
                return $prefix.'full_bn_required';
            }
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Beatmapset $beatmapset
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetResetNominations(?User $user, Beatmapset $beatmapset): string
    {
        $this->ensureLoggedIn($user);

        if (!$user->isBNG() && !$user->isModerator()) {
            return 'unauthorized';
        }

        if ($beatmapset->approved !== Beatmapset::STATES['pending']) {
            return 'beatmap_discussion.nominate.incorrect_state';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Beatmapset $beatmapset
     * @return string
     */
    public function checkBeatmapsetShow(?User $user, Beatmapset $beatmapset): string
    {
        if (!$beatmapset->trashed()) {
            return 'ok';
        }

        if ($user !== null) {
            if ($user->isBNG() || $user->isModerator()) {
                return 'ok';
            }

            if ($user->getKey() === $beatmapset->user_id) {
                return 'ok';
            }
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Beatmapset $beatmapset
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetDescriptionEdit(?User $user, Beatmapset $beatmapset): string
    {
        $this->ensureLoggedIn($user);

        if ($user->user_id === $beatmapset->user_id || $user->isModerator()) {
            return 'ok';
        }

        return 'beatmapset_description.edit.not_owner';
    }

    /**
     * @param User|null $user
     * @param Beatmapset $beatmapset
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetDisqualify(?User $user, Beatmapset $beatmapset): string
    {
        $this->ensureLoggedIn($user);

        if (!$user->isFullBN() && !$user->isModerator()) {
            return 'unauthorized';
        }

        if (!$beatmapset->isQualified()) {
            return 'beatmap_discussion.nominate.incorrect_state';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetDiscussionLock(?User $user): string
    {
        $this->ensureLoggedIn($user);

        if ($user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param BeatmapsetEvent $event
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetEventViewUserId(?User $user, BeatmapsetEvent $event): string
    {
        if ($user !== null && $user->isModerator()) {
            return 'ok';
        }

        if (in_array($event->type, BeatmapsetEvent::types('public'), true)) {
            return 'ok';
        }

        if (in_array($event->type, BeatmapsetEvent::types('kudosuModeration'), true)) {
            if ($this->checkBeatmapDiscussionAllowOrDenyKudosu($user, null) === 'ok') {
                return 'ok';
            }
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Beatmapset $beatmapset
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetMetadataEdit(?User $user, Beatmapset $beatmapset): string
    {
        $this->ensureLoggedIn($user);

        static $ownerEditable = [
            Beatmapset::STATES['graveyard'],
            Beatmapset::STATES['wip'],
            Beatmapset::STATES['pending'],
        ];

        if ($user->isModerator()) {
            return 'ok';
        }

        if ($user->getKey() === $beatmapset->user_id && in_array($beatmapset->approved, $ownerEditable, true)) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Beatmapset $beatmapset
     * @return string
     * @throws AuthorizationException
     */
    public function checkBeatmapsetDownload(?User $user, Beatmapset $beatmapset): string
    {
        // restricted users are still allowed to download
        $this->ensureLoggedIn($user);

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param User $target
     * @return string
     * @throws AuthorizationException
     */
    public function checkChatStart(?User $user, User $target): string
    {
        $prefix = 'chat.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user, $prefix);
        $this->ensureHasPlayed($user);

        if ($target->hasBlocked($user) || $user->hasBlocked($target)) {
            return $prefix.'blocked';
        }

        if ($target->pm_friends_only && !$target->hasFriended($user)) {
            return $prefix.'friends_only';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Channel $channel
     * @return string
     * @throws AuthorizationException
     */
    public function checkChatChannelSend(?User $user, Channel $channel): string
    {
        $prefix = 'chat.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user, $prefix);
        $this->ensureHasPlayed($user);

        if (!$this->doCheckUser($user, 'ChatChannelRead', $channel)->can()) {
            return $prefix.'no_access';
        }

        if ($channel->moderated) {
            return $prefix.'moderated';
        }

        if ($channel->isPM()) {
            $chatStartPermission = $this->doCheckUser($user, 'ChatStart', $channel->pmTargetFor($user));
            if (!$chatStartPermission->can()) {
                return $chatStartPermission->rawMessage();
            }
        }

        // TODO: add actual permission checks for bancho multiplayer games?
        if ($channel->isBanchoMultiplayerChat()) {
            return $prefix.'no_access';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Channel $channel
     * @return string
     * @throws AuthorizationException
     */
    public function checkChatChannelRead(?User $user, Channel $channel): string
    {
        $prefix = 'chat.';

        $this->ensureLoggedIn($user);

        if ($channel->hasUser($user)) {
            return 'ok';
        }

        return $prefix.'no_access';
    }

    /**
     * @param User|null $user
     * @param Channel $channel
     * @return string
     * @throws AuthorizationException
     */
    public function checkChatChannelJoin(?User $user, Channel $channel): string
    {
        // TODO: be able to rejoin multiplayer channels you were a part of?
        $prefix = 'chat.';

        $this->ensureLoggedIn($user);

        if ($channel->type === Channel::TYPES['public']) {
            return 'ok';
        }

        $this->ensureCleanRecord($user, $prefix);

        // allow joining of 'tournament' matches (for lazer/tournament client)
        if (optional($channel->multiplayerMatch)->isTournamentMatch()) {
            return 'ok';
        }

        return $prefix.'no_access';
    }

    /**
     * @param User|null $user
     * @param Channel $channel
     * @return string
     * @throws AuthorizationException
     */
    public function checkChatChannelPart(?User $user, Channel $channel): string
    {
        $prefix = 'chat.';

        $this->ensureLoggedIn($user);

        if ($channel->type !== Channel::TYPES['private']) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Comment $comment
     * @return string
     * @throws AuthorizationException
     */
    public function checkCommentDestroy(?User $user, Comment $comment): string
    {
        if ($this->doCheckUser($user, 'CommentModerate')->can()) {
            return 'ok';
        }

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($comment->user_id === $user->getKey()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @return string
     * @throws AuthorizationException
     */
    public function checkCommentModerate(?User $user): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Comment $comment
     * @return string
     */
    public function checkCommentRestore(?User $user, Comment $comment): string
    {
        if ($this->doCheckUser($user, 'CommentModerate')->can()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Comment $comment
     * @return string
     */
    public function checkCommentShow(?User $user, Comment $comment): string
    {
        if ($this->doCheckUser($user, 'CommentModerate')->can()) {
            return 'ok';
        }

        if (!$comment->trashed()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Comment $comment
     * @return string
     * @throws AuthorizationException
     */
    public function checkCommentStore(?User $user, Comment $comment): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);
        $this->ensureHasPlayed($user);

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Comment $comment
     * @return string
     * @throws AuthorizationException
     */
    public function checkCommentUpdate(?User $user, Comment $comment): string
    {
        if ($this->doCheckUser($user, 'CommentModerate')->can()) {
            return 'ok';
        }

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($comment->user_id === $user->getKey()) {
            if ($comment->trashed()) {
                return 'comment.update.deleted';
            }

            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Comment $comment
     * @return string
     * @throws AuthorizationException
     */
    public function checkCommentVote(?User $user, Comment $comment): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($comment->user_id === $user->getKey()) {
            return 'unauthorized';
        }

        return 'ok';
    }

    public function checkCommentPin(?User $user): string
    {
        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Contest $contest
     * @return string
     * @throws AuthorizationException
     */
    public function checkContestEntryStore(?User $user, Contest $contest): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if (!$contest->isSubmissionOpen()) {
            return 'contest.entry.over';
        }

        $currentEntries = UserContestEntry::where(['contest_id' => $contest->id, 'user_id' => $user->user_id])->count();
        if ($currentEntries >= $contest->max_entries) {
            return 'contest.entry.limit_reached';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param UserContestEntry $contestEntry
     * @return string
     * @throws AuthorizationException
     */
    public function checkContestEntryDestroy(?User $user, UserContestEntry $contestEntry): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($contestEntry->user_id !== $user->user_id) {
            return 'unauthorized';
        }

        if (!$contestEntry->contest->isSubmissionOpen()) {
            return 'contest.entry.over';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Contest $contest
     * @return string
     * @throws AuthorizationException
     */
    public function checkContestVote(?User $user, Contest $contest): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if (!$contest->isVotingOpen()) {
            return 'contest.voting.over';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Forum $forum
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumModerate(?User $user, Forum $forum): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($user->isModerator()) {
            return 'ok';
        }

        if ($forum->moderator_groups !== null && !empty(array_intersect($user->groupIds(), $forum->moderator_groups))) {
            return 'ok';
        }

        return 'forum.moderate.no_permission';
    }

    /**
     * @param User|null $user
     * @param Forum $forum
     * @return string
     */
    public function checkForumView(?User $user, Forum $forum): string
    {
        if ($this->doCheckUser($user, 'ForumModerate', $forum)->can()) {
            return 'ok';
        }

        if ($forum->categoryId() !== config('osu.forum.admin_forum_id')) {
            return 'ok';
        }

        return 'forum.view.admin_only';
    }

    /**
     * @param User|null $user
     * @param Post $post
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumPostDelete(?User $user, Post $post): string
    {
        $prefix = 'forum.post.delete.';

        if ($this->doCheckUser($user, 'ForumModerate', $post->forum)->can()) {
            return 'ok';
        }

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if (!$this->doCheckUser($user, 'ForumView', $post->forum)->can()) {
            return $prefix.'no_forum_access';
        }

        if ($post->poster_id !== $user->user_id) {
            return $prefix.'not_owner';
        }

        if ($post->topic->isLocked()) {
            return $prefix.'locked';
        }

        $position = $post->postPosition;
        $topicPostsCount = $post->topic->postsCount();

        if ($position !== $topicPostsCount) {
            return $prefix.'only_last_post';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Post $post
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumPostEdit(?User $user, Post $post): string
    {
        $prefix = 'forum.post.edit.';

        if ($this->doCheckUser($user, 'ForumModerate', $post->forum)->can()) {
            return 'ok';
        }

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if (!$this->doCheckUser($user, 'ForumView', $post->forum)->can()) {
            return $prefix.'no_forum_access';
        }

        if ($post->poster_id !== $user->user_id) {
            return $prefix.'not_owner';
        }

        if ($post->trashed()) {
            return $prefix.'deleted';
        }

        if ($post->topic->isLocked()) {
            return $prefix.'topic_locked';
        }

        if ($post->post_edit_locked) {
            return $prefix.'locked';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Forum $forum
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumPostStore(?User $user, Forum $forum): string
    {
        $prefix = 'forum.post.store.';

        if ($this->doCheckUser($user, 'ForumModerate', $forum)->can()) {
            return 'ok';
        }

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        $plays = $user->playCount();
        $posts = $user->user_posts;
        $forInitialHelpForum = in_array($forum->forum_id, config('osu.forum.initial_help_forum_ids'), true);

        if ($forInitialHelpForum) {
            if ($plays < 10 && $posts > 10) {
                return $prefix.'too_many_help_posts';
            }
        } else {
            if ($plays < config('osu.forum.minimum_plays') && $plays < $posts + 1) {
                return $prefix.'play_more';
            }

            $this->ensureHasPlayed($user);
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Topic $topic
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumTopicEdit(?User $user, Topic $topic): string
    {
        $firstPost = $topic->posts()->first() ?? $topic->posts()->withTrashed()->first();

        return $this->checkForumPostEdit($user, $firstPost);
    }

    /**
     * @param User|null $user
     * @param Topic $topic
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumTopicReply(?User $user, Topic $topic): string
    {
        $prefix = 'forum.topic.reply.';

        if ($this->doCheckUser($user, 'ForumModerate', $topic->forum)->can()) {
            return 'ok';
        }

        $this->ensureLoggedIn($user, $prefix.'user.');
        $this->ensureCleanRecord($user, $prefix.'user.');

        if (!$this->doCheckUser($user, 'ForumView', $topic->forum)->can()) {
            return $prefix.'no_forum_access';
        }

        $postStorePermission = $this->doCheckUser($user, 'ForumPostStore', $topic->forum);

        if (!$postStorePermission->can()) {
            return $postStorePermission->rawMessage();
        }

        if (!ForumAuthorize::aclCheck($user, 'f_reply', $topic->forum)) {
            return $prefix.'no_permission';
        }

        if ($topic->isLocked()) {
            return $prefix.'locked';
        }

        if (!$topic->allowsDoublePosting() && $topic->isDoublePostBy($user)) {
            return $prefix.'double_post';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Forum $forum
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumTopicStore(?User $user, Forum $forum): string
    {
        $prefix = 'forum.topic.store.';

        if ($this->doCheckUser($user, 'ForumModerate', $forum)->can()) {
            return 'ok';
        }

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if (!$this->doCheckUser($user, 'ForumView', $forum)->can()) {
            return $prefix.'no_forum_access';
        }

        $postStorePermission = $this->doCheckUser($user, 'ForumPostStore', $forum);

        if (!$postStorePermission->can()) {
            return $postStorePermission->rawMessage();
        }

        if (!$forum->isOpen()) {
            return $prefix.'forum_closed';
        }

        if (!ForumAuthorize::aclCheck($user, 'f_post', $forum)) {
            return $prefix.'no_permission';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Topic $topic
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumTopicWatch(?User $user, Topic $topic): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if (!$this->doCheckUser($user, 'ForumView', $topic->forum)->can()) {
            return 'forum.topic.watch.no_forum_access';
        }

        return 'ok';
    }

    /**
     * @param  User|null $user
     * @param  Topic|TopicCover $object
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumTopicCoverEdit(?User $user, /* Topic|TopicCover */ $object): string
    {
        $prefix = 'forum.topic_cover.edit.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        $topic = $object instanceof Topic ? $object : $object->topic;

        if ($topic !== null) {
            $forumTopicCoverStorePermission = $this->doCheckUser($user, 'ForumTopicCoverStore', $topic->forum);
            if (!$forumTopicCoverStorePermission->can()) {
                return $forumTopicCoverStorePermission->rawMessage();
            }

            return $this->checkForumTopicEdit($user, $topic);
        }

        if ($object->owner() === null) {
            return $prefix.'uneditable';
        }

        if ($object->owner()->user_id !== $user->user_id) {
            return $prefix.'not_owner';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Forum $forum
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumTopicCoverStore(?User $user, Forum $forum): string
    {
        $prefix = 'forum.topic_cover.store.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if (!$forum->allow_topic_covers && !$this->doCheckUser($user, 'ForumModerate', $forum)->can()) {
            return $prefix.'forum_not_allowed';
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param Topic $topic
     * @return string
     */
    public function checkForumTopicPollEdit(?User $user, Topic $topic): string
    {
        if ($this->doCheckUser($user, 'ForumModerate', $topic->forum)->can()) {
            return 'ok';
        }

        $forumTopicStorePermission = $this->doCheckUser($user, 'ForumTopicStore', $topic->forum);
        if (!$forumTopicStorePermission->can()) {
            return $forumTopicStorePermission->rawMessage();
        }

        if ($topic->posts()->withTrashed()->first()->poster_id === $user->user_id) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Topic $topic
     * @return string
     */
    public function checkForumTopicPollShowResults(?User $user, Topic $topic): string
    {
        if (!$topic->poll_hide_results) {
            return 'ok';
        }

        if ($this->doCheckUser($user, 'ForumModerate', $topic->forum)->can()) {
            return 'ok';
        }

        if ($topic->pollEnd() === null || $topic->pollEnd()->isPast()) {
            return 'ok';
        }

        if ($user !== null && $topic->posts()->withTrashed()->first()->poster_id === $user->user_id) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param Topic $topic
     * @return string
     * @throws AuthorizationException
     */
    public function checkForumTopicVote(?User $user, Topic $topic): string
    {
        $prefix = 'forum.topic.vote.';

        if (!$topic->poll()->isOpen()) {
            return $prefix.'over';
        }

        $this->ensureLoggedIn($user, $prefix.'user.');
        $this->ensureCleanRecord($user, $prefix.'user.');

        if (!$this->doCheckUser($user, 'ForumView', $topic->forum)->can()) {
            return $prefix.'no_forum_access';
        }

        $plays = $user->playCount();
        if ($plays < config('osu.forum.minimum_plays')) {
            return $prefix.'play_more';
        }

        if (!$topic->poll_vote_change) {
            if ($topic->poll()->votedBy($user)) {
                return $prefix.'voted';
            }
        }

        return 'ok';
    }

    public function checkIsOwnClient(?User $user, Client $client): string
    {
        if ($user === null || $user->getKey() !== $client->user_id) {
            return 'unauthorized';
        }

        return 'ok';
    }

    public function checkIsNotOAuth(?User $user): string
    {
        if (optional($user)->token() === null) {
            return 'ok';
        }

        return 'unauthorized';
    }

    // Allow non-OAuth requests or OAuth requests with * scope.
    public function checkIsSpecialScope(?User $user): string
    {
        if ($user === null) {
            return 'unauthorzied';
        }

        $token = $user->token();
        if ($token === null || $token->can('*')) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @return string
     */
    public function checkNewsIndexUpdate(?User $user): string
    {
        // yet another admin only =D
        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @return string
     */
    public function checkNewsPostUpdate(?User $user): string
    {
        // yet another admin only =D
        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @return string
     * @throws AuthorizationException
     */
    public function checkLivestreamPromote(?User $user): string
    {
        $this->ensureLoggedIn($user);

        if ($user->isModerator()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @return string
     * @throws AuthorizationException
     */
    public function checkMultiplayerRoomCreate(?User $user): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        return 'ok';
    }

    /**
     * @param User|null $user
     * @return string
     * @throws AuthorizationException
     */
    public function checkMultiplayerScoreSubmit(?User $user): string
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param User $pageOwner
     * @return string
     * @throws AuthorizationException
     */
    public function checkUserPageEdit(?User $user, User $pageOwner): string
    {
        $prefix = 'user.page.edit.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        $page = $pageOwner->userPage;

        if ($page === null) {
            if (!$user->hasSupported()) {
                return $prefix.'require_supporter_tag';
            }
        } else {
            if ($user->isModerator()) {
                return 'ok';
            }

            if ($user->getKey() !== $page->poster_id) {
                return $prefix.'not_owner';
            }

            // Some user pages (posts) are orphaned and don't have parent topic.
            if ($page->post_edit_locked || optional($page->topic)->isLocked() ?? false) {
                return $prefix.'locked';
            }
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @param User $owner
     * @return string
     */
    public function checkUserShow(?User $user, User $owner): string
    {
        $prefix = 'user.show.';

        if ($user !== null && $user->user_id === $owner->user_id) {
            return 'ok';
        }

        if ($owner->hasProfile()) {
            return 'ok';
        } else {
            return $prefix.'no_access';
        }
    }

    /**
     * @param User|null $user
     * @param Match $match
     * @return string
     * @throws AuthorizationException
     */
    public function checkMatchView(?User $user, Match $match): string
    {
        if (!$match->private) {
            return 'ok';
        }

        $this->ensureLoggedIn($user);

        if ($user->isModerator() || $match->hadPlayer($user)) {
            return 'ok';
        }

        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @return string
     */
    public function checkUserSilenceShowExtendedInfo(?User $user): string
    {
        // admin only, i guess =D
        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @return string
     * @throws AuthorizationException
     */
    public function checkWikiPageRefresh(?User $user): string
    {
        $this->ensureLoggedIn($user);

        // yet another admin only =D
        return 'unauthorized';
    }

    /**
     * @param User|null $user
     * @param string $prefix
     * @throws AuthorizationException
     */
    public function ensureLoggedIn(?User $user, string $prefix = ''): void
    {
        if ($user === null) {
            throw new AuthorizationException($prefix.'require_login');
        }
    }

    /**
     * @param User|null $user
     * @param string $prefix
     * @return string
     * @throws AuthorizationException
     */
    public function ensureCleanRecord(?User $user, string $prefix = ''): string
    {
        if ($user === null) {
            return 'unauthorized';
        }

        if ($user->isRestricted()) {
            throw new AuthorizationException($prefix.'restricted');
        }

        if ($user->isSilenced()) {
            throw new AuthorizationException($prefix.'silenced');
        }

        return 'ok';
    }

    /**
     * @param User|null $user
     * @throws AuthorizationException
     */
    public function ensureHasPlayed(?User $user): void
    {
        if ($user === null) {
            return;
        }

        $minPlays = config('osu.user.min_plays_for_posting');

        if ($user->playCount() >= $minPlays) {
            return;
        }

        if ($user->isSessionVerified()) {
            return;
        }

        throw new AuthorizationException('require_verification');
    }
}
