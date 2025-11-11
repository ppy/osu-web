<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Events\NewPrivateNotificationEvent;
use App\Models\NewsPost;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class NewsPostTest extends TestCase
{
    public static function dataProviderForNewsPostSeries(): array
    {
        return [
            [null, 'none'],
            ['none', 'none'],
            ['not real', 'none'],
            ['project_loved', 'project_loved'],
            ['Project Loved', 'project_loved'],
        ];
    }

    public static function dataProviderForNotificationDelivery(): array
    {
        return [
            [['none'], 'none', false], // default setting for news is no notifications
            [['push' => true, 'series' => ['none']], 'none', true],
            [['push' => true, 'series' => ['none']], null, true], // news post with no series defaults to none
            [['push' => true, 'series' => []], 'none', false],
            [['push' => true, 'series' => ['none']], 'project_loved', false],
            [['push' => true, 'series' => ['none', 'project_loved']], 'project_loved', true],
            // not setting any series is equivalent to all series
            [['push' => true, 'series' => null], 'project_loved', true],
            [['push' => true], 'project_loved', true],
        ];
    }

    #[DataProvider('dataProviderForNewsPostSeries')]
    public function testNewsPostSeries(?string $series, string $expected): void
    {
        $newsPost = NewsPost::factory()->series($series)->create();
        $this->assertSame($expected, $newsPost->series());
    }

    public function testNotificationNone()
    {
        User::factory()->create();

        $this->expectCountChange(fn () => Notification::count(), 0);

        NewsPost::factory()->create(['published_at' => now()]);

        $this->runFakeQueue();

        \Event::assertNotDispatched(NewPrivateNotificationEvent::class);
    }

    #[DataProvider('dataProviderForNotificationDelivery')]
    public function testNotificationDelivery(array $options, ?string $series, bool $shouldNotify)
    {
        $user = User::factory()->create();
        $user->notificationOptions()->create([
            'name' => UserNotificationOption::NEWS_POST,
            'details' => $options,
        ]);

        $this->expectCountChange(fn () => Notification::count(), $shouldNotify ? 1 : 0);

        NewsPost::factory()->series($series)->create(['published_at' => now()]);

        $this->runFakeQueue();

        if ($shouldNotify) {
            \Event::assertDispatched(
                NewPrivateNotificationEvent::class,
                fn (NewPrivateNotificationEvent $event) => $event->notification->name === Notification::NEWS_POST_NEW
            );
        } else {
            \Event::assertNotDispatched(NewPrivateNotificationEvent::class);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        \Queue::fake();
        \Event::fake();
    }
}
