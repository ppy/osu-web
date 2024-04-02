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

    /**
     * @dataProvider dataProviderForSetCommentableInvalid
     */
    public function testSetCommentableInvalid($type, $id)
    {
        $comment = new Comment(['commentable_type' => $type, 'commentable_id' => $id]);
        $comment->setCommentable();

        $this->assertNull($comment->commentable);
    }

    public function testReply(): void
    {
        $user = User::factory()->create();
        $commentable = Build::factory()->create();
        $parentComment = $commentable->comments()->create([
            'message' => 'Test',
            'user_id' => $user->getKey(),
        ]);

        $this->expectCountChange(fn () => $parentComment->fresh()->replies()->count(), 1);
        $this->expectCountChange(fn () => $parentComment->fresh()->replies_count_cache, 1);
        $this->expectCountChange(fn () => $parentComment->fresh()->visible_replies_count_cache, 1);

        $commentable->comments()->create([
            'message' => 'Hello',
            'parent_id' => $parentComment->getKey(),
            'user_id' => $user->getKey(),
        ]);
    }

    public function testReplyRestore(): void
    {
        $user = User::factory()->create();
        $commentable = Build::factory()->create();
        $parentComment = $commentable->comments()->create([
            'message' => 'Test',
            'user_id' => $user->getKey(),
        ]);
        $reply = $commentable->comments()->create([
            'message' => 'Hello',
            'parent_id' => $parentComment->getKey(),
            'user_id' => $user->getKey(),
        ]);
        $reply->softDelete($user);

        $this->expectCountChange(fn () => $parentComment->fresh()->replies()->count(), 0);
        $this->expectCountChange(fn () => $parentComment->fresh()->replies_count_cache, 0);
        $this->expectCountChange(fn () => $parentComment->fresh()->visible_replies_count_cache, 1);

        $reply->restore();
    }

    public function testReplySoftDelete(): void
    {
        $user = User::factory()->create();
        $commentable = Build::factory()->create();
        $parentComment = $commentable->comments()->create([
            'message' => 'Test',
            'user_id' => $user->getKey(),
        ]);
        $reply = $commentable->comments()->create([
            'message' => 'Hello',
            'parent_id' => $parentComment->getKey(),
            'user_id' => $user->getKey(),
        ]);

        $this->expectCountChange(fn () => $parentComment->fresh()->replies()->count(), 0);
        $this->expectCountChange(fn () => $parentComment->fresh()->replies_count_cache, 0);
        $this->expectCountChange(fn () => $parentComment->fresh()->visible_replies_count_cache, -1);

        $reply->softDelete($user);
    }

    public function testUnpinOnDelete()
    {
        $comment = Comment::factory(['pinned' => true])->create();
        $comment->softDelete(User::factory()->create());

        $this->assertFalse($comment->fresh()->pinned);
    }

    public static function commentReplyOptionDataProvider()
    {
        return [
            [null, true],
            [false, false],
            [true, true],
        ];
    }

    public static function dataProviderForSetCommentableInvalid()
    {
        return [
            [null, null],
            [null, 10],
            ['beatmapset', null],
            ['beatmapset', 0],
        ];
    }
}
