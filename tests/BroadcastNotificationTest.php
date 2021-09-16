<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Events\NewPrivateNotificationEvent;
use App\Jobs\Notifications\BeatmapsetDiscussionPostNew;
use App\Jobs\Notifications\BroadcastNotificationBase;
use App\Libraries\Chat;
use App\Mail\UserNotificationDigest;
use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;
use Event;
use Mail;
use Queue;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class BroadcastNotificationTest extends TestCase
{
    protected $sender;

    public function testNoNotificationForBotUser()
    {
        $bot = $this->createUserWithGroup('bot', ['user_allow_pm' => true]);
        $this->sender->markSessionVerified();
        $notificationsCount = Notification::count();

        Chat::sendPrivateMessage($this->sender, $bot, 'hello', false);
        $this->runFakeQueue();

        $this->assertSame($notificationsCount, Notification::count());
        Event::assertNotDispatched(NewPrivateNotificationEvent::class);
    }

    /**
     * @dataProvider notificationNamesDataProvider
     */
    public function testAllNotificationNamesHaveNotificationClasses($name)
    {
        $this->assertNotNull(BroadcastNotificationBase::getNotificationClass($name));
    }

    /**
     * @dataProvider notificationJobClassesDataProvider
     */
    public function testNotificationOptionNameHasDeliveryModes($class)
    {
        $predicate = $class::NOTIFICATION_OPTION_NAME === null
        || in_array($class::NOTIFICATION_OPTION_NAME, UserNotificationOption::HAS_DELIVERY_MODES, true);

        $this->assertTrue($predicate, "NOTIFICATION_OPTION_NAME for {$class} must be null or in UserNotificationOption::HAS_DELIVERY_MODES");
    }

    /**
     * @dataProvider userNotificationDetailsDataProvider
     */
    public function testSendNotificationWithOptions($details)
    {
        $user = factory(User::class)->create();
        $user->notificationOptions()->create([
            'name' => UserNotificationOption::BEATMAPSET_MODDING,
            'details' => $details,
        ]);

        $beatmapset = factory(Beatmapset::class)->states('with_discussion')->create([
            'user_id' => $user->getKey(),
        ]);
        $beatmapset->watches()->create([
            'last_read' => now()->subSecond(), // make sure last_read isn't the same second the test runs.
            'user_id' => $user->getKey(),
        ]);

        $this
            ->actingAsVerified($this->sender)
            ->post(route('beatmapsets.discussions.posts.store'), $this->makeBeatmapsetDiscussionPostParams($beatmapset, 'praise'))
            ->assertStatus(200);

        Queue::assertPushed(BeatmapsetDiscussionPostNew::class);
        $this->runFakeQueue();

        if ($details['push'] ?? UserNotificationOption::DELIVERY_MODE_DEFAULTS['push']) {
            Event::assertDispatched(NewPrivateNotificationEvent::class);
        } else {
            Event::assertNotDispatched(NewPrivateNotificationEvent::class);
        }

        // make sure the mailer we want to check wasn't done by something else...
        Mail::assertNotSent(UserNotificationDigest::class);
        $this->artisan('notifications:send-mail');
        $this->runFakeQueue();

        if ($details['mail'] ?? UserNotificationOption::DELIVERY_MODE_DEFAULTS['mail']) {
            Mail::assertSent(UserNotificationDigest::class);
        } else {
            Mail::assertNotSent(UserNotificationDigest::class);
        }
    }

    public function notificationJobClassesDataProvider()
    {
        $this->refreshApplication();

        $path = app()->path('Jobs/Notifications');
        $files = Finder::create()->files()->in($path)->sortByName();
        foreach ($files as $file) {
            $baseName = $file->getBasename(".{$file->getExtension()}");
            $classes[] = ["\\App\\Jobs\\Notifications\\{$baseName}"];
        }

        return $classes;
    }

    public function notificationNamesDataProvider()
    {
        // TODO: move notification names to different class instead of filtering
        $constants = collect((new ReflectionClass(Notification::class))->getConstants())
            ->except(['NAME_TO_CATEGORY', 'NOTIFIABLE_CLASSES', 'SUBTYPES', 'CREATED_AT', 'UPDATED_AT'])
            ->values();

        return $constants->map(function ($name) {
            return [$name];
        });
    }

    public function userNotificationDetailsDataProvider()
    {
        return [
            [null], // for testing defaults.
            [['mail' => false, 'push' => false]],
            [['mail' => false, 'push' => true]],
            [['mail' => true, 'push' => true]],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        // mocking the queue so we can run the job manually to get the created notification.
        Queue::fake();
        Event::fake();
        Mail::fake();

        $this->sender = factory(User::class)->create();
    }
}
