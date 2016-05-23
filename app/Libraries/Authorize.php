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

class Authorize
{
    private $cache = [];

    public function doCheckUser($user, $ability, $args)
    {
        if (!is_array($args)) {
            $args = [$args];
        }

        $function = "check{$ability}";

        if ($user !== null && $user->isAdmin()) {
            $message = 'ok';
        } else {
            $message = call_user_func_array(
                [$this, $function], array_merge([$user], $args)
            );
        }

        return new AuthorizationResult($message);
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

    public function checkForumPostDelete($user, $post, $positionCheck = true, $position = null, $topicPostsCount = null)
    {
        $prefix = 'forum.post.delete.';

        if ($user === null) {
            return 'require_login';
        }

        if ($user->isGMT()) {
            return 'ok';
        }

        if ($post->poster_id !== $user->user_id) {
            return $prefix.'not_post_owner';
        }

        if ($positionCheck === false) {
            return 'ok';
        }

        if ($position === null) {
            $position = $post->postPosition;
        }

        if ($topicPostsCount === null) {
            $topicPostsCount = $post->topic->postsCount();
        }

        if ($position !== $topicPostsCount) {
            return $prefix.'can_only_delete_last_post';
        }

        return 'ok';
    }

    public function checkForumPostEdit($user, $post)
    {
        $prefix = 'forum.post.edit.';

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

        if (!ForumAuthorize::canPost($user, $topic->forum, $topic)) {
            return $prefix.'can_not_post';
        }

        return 'ok';
    }

    public function checkForumTopicStore($user, $forum)
    {
        $prefix = 'forum.topic.store';

        if ($forum->forum_type === 1) {
            return 'ok';
        }

        return $prefix.'closed';
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
            return $prefix.'owner_only';
        }

        return 'ok';
    }
}
