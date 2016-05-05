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

        $message = call_user_func_array(
            [$this, $function], array_merge([$user], $args)
        );

        return new AuthorizationResult($message);
    }

    public function checkForumView($user, $forum)
    {
        if ($user !== null && $user->isAdmin()) {
            return;
        }

        if ($forum->categoryId() === config('osu.forum.admin_forum_id')) {
            return 'forum.view.admin_only';
        }
    }

    public function checkForumPostDelete($user, $post, $positionCheck = true, $position = null, $topicPostsCount = null)
    {
        $prefix = 'forum.post.delete.';

        if ($user === null) {
            return $prefix.'require_login';
        }

        if ($user->isAdmin()) {
            return;
        }

        if ($post->poster_id !== $user->user_id) {
            return $prefix.'not_post_owner';
        }

        if ($positionCheck === false) {
            return;
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
    }

    public function checkForumPostEdit($user, $post)
    {
        $prefix = 'forum.post.edit.';

        if ($user->isAdmin()) {
            return;
        }

        if ($post->poster_id !== $user->user_id) {
            return $prefix.'not_post_owner';
        }

        if ($post->post_edit_locked) {
            return $prefix.'locked';
        }
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
    }

    public function checkForumTopicStore($user, $forum)
    {
        $prefix = 'forum.topic.store';

        if ($forum->forum_type === 1) {
            return;
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
            return $prefix.'require_login';
        }

        if ($user->isAdmin()) {
            return;
        }

        if ($cover->owner() === null) {
            return $prefix.'uneditable';
        }

        if ($cover->owner()->user_id !== $user->user_id) {
            return $prefix.'owner_only';
        }
    }
}
