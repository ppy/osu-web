<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Jobs\Notifications\CommentNew;
use App\Models\Build;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * @dataProvider commentReplyOptionDataProvider
     */
    public function testCommentReplyNotification($option, $shouldBeSent)
    {
        $user = User::factory()->create();
        if ($option !== null) {
            $user->notificationOptions()->create([
                'name' => Notification::COMMENT_NEW,
                'details' => [UserNotificationOption::COMMENT_REPLY => $option],
            ]);
        }

        $commenter = User::factory()->create();
        $commentable = Build::factory()->create();
        $parentComment = $commentable->comments()->create([
            'message' => 'Test',
            'user_id' => $user->getKey(),
        ]);

        $comment = $commentable->comments()->create([
            'parent_id' => $parentComment->getKey(),
            'message' => 'Hello',
            'user_id' => $commenter->getKey(),
        ]);

        $notification = new CommentNew($comment, $commenter);

        if ($shouldBeSent) {
            $this->assertSame([$user->getKey()], $notification->getReceiverIds());
        } else {
            $this->assertEmpty($notification->getReceiverIds());
        }
    }

    public function testReplyingToDeletedComment()
    {
        $user = User::factory()->create();
        $commentable = Build::factory()->create();
        $parentComment = $commentable->comments()->create([
            'message' => 'Test',
            'user_id' => $user->getKey(),
            'deleted_at' => now(),
        ]);

        $comment = new Comment([
            'parent_id' => $parentComment->getKey(),
            'message' => 'Hello',
        ]);

        $this->assertFalse($comment->isValid());
        $this->assertArrayHasKey('parent_id', $comment->validationErrors()->all());
    }

    public function commentReplyOptionDataProvider()
    {
        return [
            [null, true],
            [false, false],
            [true, true],
        ];
    }
}
