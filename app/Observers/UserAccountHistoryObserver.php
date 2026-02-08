<?php

namespace App\Observers;

use App\Jobs\Notifications\UserSilencedNotification;
use App\Models\UserAccountHistory;

class UserAccountHistoryObserver
{
    public function created(UserAccountHistory $history)
    {
        if ($history->ban_status === UserAccountHistory::TYPES['silence']) {
            (new UserSilencedNotification($history))->dispatch();
        }
    }
}
