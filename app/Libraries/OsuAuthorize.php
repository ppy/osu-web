<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use App\Models\Chat\Channel as ChatChannel;
use App\Models\Forum\Authorize as ForumAuthorize;
use App\Models\Multiplayer\Match as MultiplayerMatch;

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

                $message = call_user_func_array(
                    [$this, $function], [$user, $object]
                );
            }

            $this->cache[$cacheKey] = new AuthorizationResult($message);
        }

        return $this->cache[$cacheKey];
    }

    public function checkBeatmapDiscussionPost($user, $discussion)
    {
        if ($user === null) {
            return 'require_login';
        }

        if ($user->isSilenced()) {
            return 'silenced';
        }

        if ($user->isRestricted()) {
            return 'restricted';
        }

        return 'ok';
    }

    public function checkBeatmapDiscussionResolve($user, $discussion)
    {
        $prefix = 'beatmap_discussion.resolve.';

        if ($user === null) {
            return 'require_login';
        }

        // no point resolving general discussion?
        if ($discussion->timestamp === null) {
            return $prefix.'general_discussion';
        }

        if ($user->user_id === $discussion->user_id) {
            return 'ok';
        }

        if ($user->user_id === $discussion->beatmapset->user_id) {
            return 'ok';
        }

        return $prefix.'not_owner';
    }

    public function checkBeatmapDiscussionVote($user, $discussion)
    {
        if ($user === null) {
            return 'require_login';
        }

        if ($user->isSilenced()) {
            return 'silenced';
        }

        if ($user->isRestricted()) {
            return 'restricted';
        }

        return 'ok';
    }

    public function checkBeatmapDiscussionPostEdit($user, $post)
    {
        $prefix = 'beatmap_discussion_post.edit.';

        if ($user === null) {
            return 'require_login';
        }

        if ($user->isSilenced()) {
            return 'silenced';
        }

        if ($user->isRestricted()) {
            return 'restricted';
        }

        if ($post->system) {
            return $prefix.'system_generated';
        }

        if ($user->user_id !== $post->user_id) {
            return $prefix.'not_owner';
        }

        return 'ok';
    }

    public function checkChatMessageSend($user, $target)
    {
        $prefix = 'chat.message.send.';

        if ($target instanceof ChatChannel) {
            if (!$this->doCheckUser($user, 'ChatChannelRead', $channel)->can()) {
                return $prefix.'channel.no_access';
            }

            if ($target->moderated) {
                return $prefix.'channel.moderated';
            }
        } elseif ($target instanceof User) {
            // TODO: blocklist/ignore, etc
        }

        if ($user->isBanned() || $user->isRestricted() || $user->isSilenced()) {
            return $prefix.'not_allowed';
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

    public function checkForumView($user, $forum)
    {
        if ($user !== null && $user->isGMT()) {
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

        if (!$this->doCheckUser($user, 'ForumTopicReply', $post->topic)->can()) {
            return $prefix.'can_not_post';
        }

        if ($user === null) {
            return 'require_login';
        }

        if ($user->isGMT()) {
            return 'ok';
        }

        if ($post->poster_id !== $user->user_id) {
            return $prefix.'not_owner';
        }

        $position = $post->postPosition;
        $topicPostsCount = $post->topic->postsCount();

        if ($position !== $topicPostsCount) {
            return $prefix.'can_only_delete_last_post';
        }

        return 'ok';
    }

    public function checkForumPostEdit($user, $post)
    {
        $prefix = 'forum.post.edit.';

        if (!$this->doCheckUser($user, 'ForumTopicReply', $post->topic)->can()) {
            return $prefix.'can_not_post';
        }

        if ($user === null) {
            return 'require_login';
        }

        if ($user->isGMT()) {
            return 'ok';
        }

        if ($post->poster_id !== $user->user_id) {
            return $prefix.'not_owner';
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

    public function checkForumTopicLock($user, $topic)
    {
        if ($user === null) {
            return 'require_login';
        }

        if ($user->isGMT()) {
            return 'ok';
        }
    }

    public function checkForumTopicMove($user, $topic)
    {
        if ($user === null) {
            return 'require_login';
        }

        if ($user->isGMT()) {
            return 'ok';
        }
    }

    public function checkForumTopicReply($user, $topic)
    {
        $prefix = 'forum.topic.reply.';

        if (!$this->doCheckUser($user, 'ForumTopicStore', $topic->forum)->can()) {
            return $prefix.'can_not_post';
        }

        if ($user === null) {
            return 'require_login';
        }

        if ($topic->isLocked()) {
            return $prefix.'locked';
        }
        if ($topic->isDoublePostBy($user)) {
            return $prefix.'doublepost_message';
        }

        return 'ok';
    }

    public function checkForumTopicStore($user, $forum)
    {
        $prefix = 'forum.topic.store.';

        if (!$this->doCheckUser($user, 'ForumView', $forum)->can()) {
            return $prefix.'can_not_view_forum';
        }

        if ($user === null) {
            return 'require_login';
        }

        if (!$forum->isOpen()) {
            return $prefix.'forum_closed';
        }

        if ($user->isGMT()) {
            return 'ok';
        }

        if ($user->isSilenced()) {
            return $prefix.'user.silenced';
        }

        if ($user->isRestricted()) {
            return $prefix.'user.restricted';
        }

        if (!ForumAuthorize::aclCheck($user, 'f_post', $forum)) {
            return $prefix.'can_not_post';
        }

        return 'ok';
    }

    public function checkForumTopicCoverEdit($user, $cover)
    {
        $prefix = 'forum.topic_cover.edit.';

        if ($cover->topic !== null) {
            return $this->checkForumTopicEdit($user, $cover->topic);
        }

        if ($user === null) {
            return 'require_login';
        }

        if ($user->isGMT()) {
            return 'ok';
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

        if ($user === null) {
            return $prefix.'require_login';
        }

        if (!$topic->poll_vote_change) {
            $userHasVoted = $topic->pollVotes()->where('vote_user_id', $user->getKey())->exists();

            if ($userHasVoted) {
                return $prefix.'voted';
            }
        }

        return 'ok';
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

        $page = $pageOwner->userPage;

        if ($page === null) {
            if (!$user->osu_subscriber) {
                return $prefix.'require_support_to_create';
            }
        } else {
            if ($user->getKey() !== $page->poster_id) {
                return $prefix.'not_owner';
            }

            if ($user->isSilenced()) {
                return $prefix.'user.silenced';
            }

            if ($user->isRestricted()) {
                return $prefix.'user.restricted';
            }

            if ($page->post_edit_locked || $page->topic->isLocked()) {
                return $prefix.'locked';
            }
        }

        return 'ok';
    }
}
