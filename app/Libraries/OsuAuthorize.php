<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Libraries;

use App\Exceptions\AuthorizationException;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\Chat\Channel as ChatChannel;
use App\Models\Forum\Authorize as ForumAuthorize;
use App\Models\Multiplayer\Match as MultiplayerMatch;
use App\Models\UserContestEntry;
use Carbon\Carbon;

class OsuAuthorize
{
    private $cache = [];

    public function doCheckUser($user, $ability, $object)
    {
        $cacheKey = serialize([
            $ability,
            $user === null ? null : $user->getKey(),
            $object === null ? null : $object->getKey(),
        ]);

        if (!isset($this->cache[$cacheKey])) {
            if ($user !== null && $user->isAdmin()) {
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

    public function checkBeatmapShow($user, $beatmap)
    {
        if (!$beatmap->trashed()) {
            return 'ok';
        }

        if ($user !== null) {
            if ($user->isBNG() || $user->isGMT() || $user->isQAT()) {
                return 'ok';
            }

            if ($user->getKey() === $beatmap->beatmapset->user_id) {
                return 'ok';
            }
        }
    }

    public function checkBeatmapDiscussionAllowOrDenyKudosu($user, $discussion)
    {
        if ($user !== null && ($user->isBNG() || $user->isGMT() || $user->isQAT())) {
            return 'ok';
        }
    }

    public function checkBeatmapDiscussionDestroy($user, $discussion)
    {
        $prefix = 'beatmap_discussion.destroy.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($user->isGMT() || $user->isQAT()) {
            return 'ok';
        }

        if ($user->user_id !== $discussion->user_id) {
            return;
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
        } elseif ($discussion->beatmapDiscussionPosts()->withoutDeleted()->withoutSystem()->count() > 1) {
            return $prefix.'has_reply';
        }

        return 'ok';
    }

    public function checkBeatmapDiscussionModerate($user)
    {
        if ($user !== null && ($user->isGMT() || $user->isQAT())) {
            return 'ok';
        }
    }

    public function checkBeatmapDiscussionResolve($user, $discussion)
    {
        $prefix = 'beatmap_discussion.resolve.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($user->user_id === $discussion->user_id) {
            return 'ok';
        }

        if ($user->user_id === $discussion->beatmapset->user_id) {
            return 'ok';
        }

        if ($user->isBNG() || $user->isGMT() || $user->isQAT()) {
            return 'ok';
        }

        return $prefix.'not_owner';
    }

    public function checkBeatmapDiscussionRestore($user, $discussion)
    {
        if ($user !== null && ($user->isGMT() || $user->isQAT())) {
            return 'ok';
        }
    }

    public function checkBeatmapDiscussionShow($user, $discussion)
    {
        if ($discussion->deleted_at === null) {
            if ($discussion->beatmap_id === null) {
                return 'ok';
            }

            if ($this->doCheckUser($user, 'BeatmapShow', $discussion->beatmap)->can()) {
                return 'ok';
            }
        }

        if ($user !== null && ($user->isGMT() || $user->isQAT())) {
            return 'ok';
        }
    }

    public function checkBeatmapDiscussionVote($user, $discussion)
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
            if (!$user->isBNG() && !$user->isGMT() && !$user->isQAT()) {
                return $prefix.'wrong_beatmapset_state';
            }
        }

        if ($discussion->user_id === $user->user_id) {
            return $prefix.'owner';
        }

        if ($user->isBNG() || $user->isGMT() || $user->isQAT()) {
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

    public function checkBeatmapDiscussionVoteDown($user, $discussion)
    {
        $prefix = 'beatmap_discussion.vote.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($discussion->user_id === $user->user_id) {
            return $prefix.'owner';
        }

        if ($user->isBNG() || $user->isGMT() || $user->isQAT()) {
            return 'ok';
        }

        return 'unauthorized';
    }

    public function checkBeatmapDiscussionPostDestroy($user, $post)
    {
        $prefix = 'beatmap_discussion_post.destroy.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($post->system) {
            return $prefix.'system_generated';
        }

        if ($user->isGMT() || $user->isQAT()) {
            return 'ok';
        }

        if ($user->user_id !== $post->user_id) {
            return $prefix.'not_owner';
        }

        return 'ok';
    }

    public function checkBeatmapDiscussionPostEdit($user, $post)
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

        return 'ok';
    }

    public function checkBeatmapDiscussionPostRestore($user, $post)
    {
        if ($user !== null && ($user->isGMT() || $user->isQAT())) {
            return 'ok';
        }
    }

    public function checkBeatmapDiscussionPostShow($user, $post)
    {
        if ($post->deleted_at === null) {
            return 'ok';
        }

        if ($user !== null && ($user->isGMT() || $user->isQAT())) {
            return 'ok';
        }
    }

    public function checkBeatmapDiscussionPostStore($user, $discussion)
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        return 'ok';
    }

    public function checkBeatmapsetNominate($user, $beatmapset)
    {
        $this->ensureLoggedIn($user);

        if (!$user->isBNG() && !$user->isQAT()) {
            return 'unauthorized';
        }

        if ($beatmapset->approved !== Beatmapset::STATES['pending']) {
            return 'beatmap_discussion.nominate.incorrect-state';
        }

        if ($user->beatmapsetNominationsToday() >= config('osu.beatmapset.user_daily_nominations')) {
            return 'beatmap_discussion.nominate.exhausted';
        }

        return 'ok';
    }

    public function checkBeatmapsetResetNominations($user, $beatmapset)
    {
        $this->ensureLoggedIn($user);

        if (!$user->isBNG() && !$user->isQAT()) {
            return 'unauthorized';
        }

        if ($beatmapset->approved !== Beatmapset::STATES['pending']) {
            return 'beatmap_discussion.nominate.incorrect-state';
        }

        return 'ok';
    }

    public function checkBeatmapsetDescriptionEdit($user, $beatmapset)
    {
        $this->ensureLoggedIn($user);

        if ($user->user_id === $beatmapset->user_id || $user->isGMT() || $user->isQAT()) {
            return 'ok';
        }

        return 'beatmapset_description.edit.not_owner';
    }

    public function checkBeatmapsetDisqualify($user, $beatmapset)
    {
        $this->ensureLoggedIn($user);

        if (!$user->isQAT()) {
            return 'unauthorized';
        }

        if ($beatmapset->approved !== Beatmapset::STATES['qualified']) {
            return 'beatmap_discussion.disqualify.incorrect-state';
        }

        return 'ok';
    }

    public function checkBeatmapsetEventViewUserId($user, $event)
    {
        if ($user !== null && $user->isQAT()) {
            return 'ok';
        }

        static $publicEvents = [
            BeatmapsetEvent::NOMINATE,
            BeatmapsetEvent::QUALIFY,
            BeatmapsetEvent::DISQUALIFY,
            BeatmapsetEvent::APPROVE,
            BeatmapsetEvent::RANK,
            BeatmapsetEvent::KUDOSU_GAIN,
            BeatmapsetEvent::KUDOSU_LOST,
        ];

        if (in_array($event->type, $publicEvents, true)) {
            return 'ok';
        }

        static $kudosuModerationEvents = [
            BeatmapsetEvent::KUDOSU_ALLOW,
            BeatmapsetEvent::KUDOSU_DENY,
        ];

        if (in_array($event->type, $kudosuModerationEvents, true)) {
            if ($this->checkBeatmapDiscussionAllowOrDenyKudosu($user, null) === 'ok') {
                return 'ok';
            }
        }
    }

    public function checkBeatmapsetDownload($user, $beatmapset)
    {
        // restricted users are still allowed to download
        $this->ensureLoggedIn($user);

        return 'ok';
    }

    public function checkChatMessageSend($user, $target)
    {
        $prefix = 'chat.message.send.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($target instanceof ChatChannel) {
            if (!$this->doCheckUser($user, 'ChatChannelRead', $target)->can()) {
                return $prefix.'channel.no_access';
            }

            if ($target->moderated) {
                return $prefix.'channel.moderated';
            }
        } elseif ($target instanceof User) {
            // TODO: blocklist/ignore, etc
        }

        return 'ok';
    }

    public function checkChatChannelRead($user, $channel)
    {
        $prefix = 'chat.channel.read.';

        switch (strtolower($channel->type)) {
            case 'public':
                return 'ok';

            case 'private':
                $commonGroupIds = array_intersect(
                    $user->groupIds(),
                    $channel->allowed_groups
                );

                if (count($commonGroupIds) > 0) {
                    return 'ok';
                }
                break;

            case 'spectator':
            case 'multiplayer':
            case 'temporary': // this and the comparisons below are needed until bancho is updated to use the new channel types
                if (starts_with($channel->name, '#spect_')) {
                    return 'ok';
                }

                if (starts_with($channel->name, '#mp_')) {
                    $matchId = intval(str_replace('#mp_', '', $channel->name));

                    if (in_array($user->user_id, MultiplayerMatch::findOrFail($matchId)->currentPlayers(), true)) {
                        return 'ok';
                    }
                }
                break;
        }

        return $prefix.'no_access';
    }

    public function checkContestEntryStore($user, $contest)
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

    public function checkContestEntryDestroy($user, $contestEntry)
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

    public function checkContestVote($user, $contest)
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if (!$contest->isVotingOpen()) {
            return 'contest.voting.over';
        }

        return 'ok';
    }

    public function checkForumView($user, $forum)
    {
        if ($user !== null && ($user->isGMT() || $user->isQAT())) {
            return 'ok';
        }

        if ($forum->categoryId() !== config('osu.forum.admin_forum_id')) {
            return 'ok';
        }

        return 'forum.view.admin_only';
    }

    public function checkForumPostDelete($user, $post)
    {
        $prefix = 'forum.post.delete.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($user->isGMT() || $user->isQAT()) {
            return 'ok';
        }

        if (!$this->doCheckUser($user, 'ForumView', $post->topic->forum)->can()) {
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

    public function checkForumPostEdit($user, $post)
    {
        $prefix = 'forum.post.edit.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($user->isGMT() || $user->isQAT()) {
            return 'ok';
        }

        if (!$this->doCheckUser($user, 'ForumView', $post->topic->forum)->can()) {
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

    public function checkForumTopicEdit($user, $topic)
    {
        return $this->checkForumPostEdit($user, $topic->posts()->first());
    }

    public function checkForumTopicModerate($user, $topic)
    {
        if ($user !== null && ($user->isGMT() || $user->isQAT())) {
            return 'ok';
        }
    }

    public function checkForumTopicReply($user, $topic)
    {
        $prefix = 'forum.topic.reply.';

        $this->ensureLoggedIn($user, $prefix.'user.');
        $this->ensureCleanRecord($user, $prefix.'user.');

        if ($user->isGMT() || $user->isQAT()) {
            return 'ok';
        }

        if (!$this->doCheckUser($user, 'ForumView', $topic->forum)->can()) {
            return $prefix.'no_forum_access';
        }

        if (!ForumAuthorize::aclCheck($user, 'f_reply', $topic->forum)) {
            return $prefix.'no_permission';
        }

        if ($topic->isLocked()) {
            return $prefix.'locked';
        }

        if ($topic->isDoublePostBy($user)) {
            return $prefix.'double_post';
        }

        return 'ok';
    }

    public function checkForumTopicStore($user, $forum)
    {
        $prefix = 'forum.topic.store.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($user->isGMT() || $user->isQAT()) {
            return 'ok';
        }

        if (!$this->doCheckUser($user, 'ForumView', $forum)->can()) {
            return $prefix.'no_forum_access';
        }

        if (!$forum->isOpen()) {
            return $prefix.'forum_closed';
        }

        if (!ForumAuthorize::aclCheck($user, 'f_post', $forum)) {
            return $prefix.'no_permission';
        }

        return 'ok';
    }

    public function checkForumTopicWatchAdd($user, $topic)
    {
        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if (!$this->doCheckUser($user, 'ForumView', $topic->forum)->can()) {
            return 'forum.topic.watch.no_forum_access';
        }

        return 'ok';
    }

    public function checkForumTopicWatchRemove($user, $topic)
    {
        $this->ensureLoggedIn($user);

        return 'ok';
    }

    public function checkForumTopicCoverEdit($user, $cover)
    {
        $prefix = 'forum.topic_cover.edit.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        if ($user->isGMT() || $user->isQAT()) {
            return 'ok';
        }

        if ($cover->topic !== null) {
            return $this->checkForumTopicEdit($user, $cover->topic);
        }

        if ($cover->owner() === null) {
            return $prefix.'uneditable';
        }

        if ($cover->owner()->user_id !== $user->user_id) {
            return $prefix.'not_owner';
        }

        return 'ok';
    }

    public function checkForumTopicVote($user, $topic)
    {
        $prefix = 'forum.topic.vote.';

        if ($topic->pollEnd() !== null && $topic->pollEnd()->isPast()) {
            return $prefix.'over';
        }

        $this->ensureLoggedIn($user, $prefix.'user.');
        $this->ensureCleanRecord($user, $prefix.'user.');

        if (!$this->doCheckUser($user, 'ForumView', $topic->forum)->can()) {
            return $prefix.'no_forum_access';
        }

        if (!$topic->poll_vote_change) {
            $userHasVoted = $topic->pollVotes()->where('vote_user_id', $user->getKey())->exists();

            if ($userHasVoted) {
                return $prefix.'voted';
            }
        }

        return 'ok';
    }

    public function checkNewsIndexUpdate($user)
    {
        // yet another admin only =D
    }

    public function checkNewsPostUpdate($user)
    {
        // yet another admin only =D
    }

    public function checkLivestreamPromote($user)
    {
        if ($user !== null && $user->isGMT()) {
            return 'ok';
        }
    }

    public function checkUserPageEdit($user, $pageOwner)
    {
        $prefix = 'user.page.edit.';

        $this->ensureLoggedIn($user);
        $this->ensureCleanRecord($user);

        $page = $pageOwner->userPage;

        if ($page === null) {
            if (!$user->osu_subscriber) {
                return $prefix.'require_supporter_tag';
            }
        } else {
            if ($user->getKey() !== $page->poster_id) {
                return $prefix.'not_owner';
            }

            if ($page->post_edit_locked || $page->topic->isLocked()) {
                return $prefix.'locked';
            }
        }

        return 'ok';
    }

    public function checkUserFavourite($user)
    {
        $prefix = 'errors.beatmapsets.';

        $this->ensureLoggedIn($user);

        if ($user->favouriteBeatmapsets()->count() > 99) {
            return $prefix.'too-many-favourites';
        }

        return 'ok';
    }

    public function checkUserFavouriteRemove($user)
    {
        $this->ensureLoggedIn($user);

        return 'ok';
    }

    public function checkUserShow($user, $owner)
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

    public function checkWikiPageRefresh($user)
    {
        $this->ensureLoggedIn($user);

        // yet another admin only =D
    }

    public function ensureLoggedIn($user, $prefix = '')
    {
        if ($user === null) {
            throw new AuthorizationException($prefix.'require_login');
        }
    }

    public function ensureCleanRecord($user, $prefix = '')
    {
        if ($user === null) {
            return;
        }

        if ($user->isRestricted()) {
            throw new AuthorizationException($prefix.'restricted');
        }

        if ($user->isSilenced()) {
            throw new AuthorizationException($prefix.'silenced');
        }
    }
}
