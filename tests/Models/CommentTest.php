<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
use App\Models\Build;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;

class CommentTest extends TestCase
{
    public function testReplyingToDeletedComment()
    {
        $user = factory(User::class)->create();
        $commentable = factory(Build::class)->create();
        $parentComment = $commentable->comments()->create([
            'message' => 'Test',
            'user_id' => $user->getKey(),
            'deleted_at' => Carbon::now(),
        ]);

        $comment = new Comment([
            'parent_id' => $parentComment->getKey(),
            'message' => 'Hello',
        ]);

        $this->assertFalse($comment->isValid());
        $this->assertArrayHasKey('parent_id', $comment->validationErrors()->all());
    }
}
