<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\Build;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

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
