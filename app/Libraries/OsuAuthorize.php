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

use App\Models\Forum\Authorize as ForumAuthorize;

class OsuAuthorize
{
    private $cache = [];

    public function doCheckUser($user, $ability, $object)
    {
        $cacheKey = serialize([
            $ability,
            $user === null ? null : $user->getKey(),
            $object->getKey(),
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

    public function cheackBeatmapDiscussionPost($user, $discussion)
    {
        if ($user === null) {
            return 'require_login';
        }

        return 'ok';
    }

    public function cheackBeatmapDiscussionResolve($user, $discussion)
    {
        $prefix = 'beatmap_discussion.resolve.';

        if ($user === null) {
            return 'require_login';
        }

        // no point resolving general discussion?
        if ($this->timestamp === null) {
            return $prefix.'general_discussion';
        }

        if ($user->user_id === $this->user_id) {
            return 'ok';
        }

        if ($user->user_id === $this->beatmapset->user_id) {
            return 'ok';
        }

        return $prefix.'not_owner';
    }

    public function cheackBeatmapDiscussionVote($user, $discussion)
    {
        if ($user === null) {
            return 'require_login';
        }

        return 'ok';
    }

    public function checkBeatmapDiscussionPostEdit($user, $post)
    {
        $prefix = 'beatmap_discussion_post.edit.';

        if ($user === null) {
            return 'require_login';
        }

        if ($post->system) {
            return $prefix.'system_generated';
        }

        if ($user->user_id !== $post->user_id) {
            return $prefix.'not_owner';
        }

        return 'ok';
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
            return $prefix.'not_post_owner';
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
            return 'forum.topic.store.forum_closed';
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
                return $prefix.'silenced';
            }

            if ($user->isRestricted()) {
                return $prefix.'restricted';
            }

            if ($page->post_edit_locked || $page->topic->isLocked()) {
                return $prefix.'locked';
            }
        }

        return 'ok';
    }
}
