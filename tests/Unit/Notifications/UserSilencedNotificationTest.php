<?php

namespace Tests\Unit\Notifications;

use App\Jobs\Notifications\UserSilencedNotification;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserAccountHistory;
use App\Models\UserNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Dataset;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Tests\TestCase;

class UserSilencedNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function testSilenceTriggersNotification()
    {
        $user = User::factory()->create();
        $admin = User::factory()->create();

        Bus::fake();

        // $this->expectsJobs(UserSilencedNotification::class);

        UserAccountHistory::create([
            'user_id' => $user->id,
            'banner_id' => $admin->id,
            'ban_status' => UserAccountHistory::TYPES['silence'],
            'period' => 60,
            'reason' => 'Misbehavior',
        ]);

        Bus::assertDispatched(UserSilencedNotification::class);
    }

    public function testNotificationDetails()
    {
        $user = User::factory()->create();
        $admin = User::factory()->create();

        $history = UserAccountHistory::create([
            'user_id' => $user->id,
            'banner_id' => $admin->id,
            'ban_status' => UserAccountHistory::TYPES['silence'],
            'period' => 120, // 2 minutes
            'reason' => 'Spamming',
        ]);

        $notification = new UserSilencedNotification($history);
        $details = $notification->getDetails();

        $this->assertEquals('Spamming', $details['reason']);
        $this->assertEquals(2, $details['duration']);
        $this->assertEquals([$user->id], $notification->getListeningUserIds());
        $this->assertEquals($user->id, $notification->getNotifiable()->id);

        // Test Mail Link
        $dbNotification = new Notification();
        $dbNotification->notifiable_id = $user->id;
        $this->assertStringContainsString(route('users.show', ['user' => $user->id]).'#account-standing', UserSilencedNotification::getMailLink($dbNotification));
    }
    
    public function testNonSilenceDoesNotTriggerNotification()
    {
        $user = User::factory()->create();
        $admin = User::factory()->create();

        Bus::fake();

        // $this->doesntExpectJobs(UserSilencedNotification::class);

        UserAccountHistory::create([
            'user_id' => $user->id,
            'banner_id' => $admin->id,
            'ban_status' => UserAccountHistory::TYPES['note'],
            'reason' => 'Just a note',
        ]);

        Bus::assertNotDispatched(UserSilencedNotification::class);
    }

    public function testJobExecutionCreatesNotification()
    {
        $user = User::factory()->create();
        $admin = User::factory()->create();

        $history = UserAccountHistory::create([
            'user_id' => $user->id,
            'banner_id' => $admin->id,
            'ban_status' => UserAccountHistory::TYPES['silence'],
            'period' => 60,
            'reason' => 'Bad behavior',
        ]);

        $job = new UserSilencedNotification($history);
        $job->handle();

        $this->assertDatabaseHas('notifications', [
            'name' => Notification::USER_SILENCED,
            'notifiable_id' => $user->id,
            'notifiable_type' => $user->getMorphClass(),
        ]);

        $this->assertDatabaseHas('user_notifications', [
            'user_id' => $user->id,
        ]);
    }
}
