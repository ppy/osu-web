<?php

namespace App\Jobs\Notifications;

use App\Models\Notification;
use App\Models\User;
use App\Models\UserAccountHistory;

class UserSilencedNotification extends BroadcastNotificationBase
{
    /** @var UserAccountHistory */
    private $history;

    public function __construct(UserAccountHistory $history)
    {
        parent::__construct(null);
        $this->history = $history;
        $this->name = Notification::USER_SILENCED;
    }

    public static function getMailLink(Notification $notification): string
    {
        return route('users.show', ['user' => $notification->notifiable_id]).'#account-standing';
    }

    public function getDetails(): array
    {
        return [
            'reason' => $this->history->reason,
            'duration' => $this->history->period / 60, // minutes
        ];
    }

    public function getListeningUserIds(): array
    {
        return [$this->history->user_id];
    }

    public function getNotifiable()
    {
        return $this->history->user;
    }
}
