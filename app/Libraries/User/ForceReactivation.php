<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\User;

use App\Libraries\Session\Store as SessionStore;
use App\Mail\UserForceReactivation;
use App\Models\UserAccountHistory;
use App\Models\UserClient;
use Mail;

class ForceReactivation
{
    const INACTIVE = 'inactive';
    const INACTIVE_DIFFERENT_COUNTRY = 'inactive_different_country';

    private $country;
    private $reason;
    private $request;
    private $user;

    public function __construct($user, $request)
    {
        $this->user = $user;
        $this->request = $request;

        $this->country = request_country($this->request);

        if ($this->user->isInactive()) {
            if ($this->user->country_acronym !== $this->country) {
                $this->reason = static::INACTIVE_DIFFERENT_COUNTRY;
            } elseif ($GLOBALS['cfg']['osu']['user']['inactive_force_password_reset']) {
                $this->reason = static::INACTIVE;
            }
        }
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function isRequired()
    {
        return $this->reason !== null;
    }

    public function run()
    {
        $userId = $this->user->getKey();
        $waitingActivation = !present($this->user->user_password);

        $this->addHistoryNote();
        $this->user->update(['user_password' => '']);
        SessionStore::batchDelete($userId);
        UserClient::where('user_id', $userId)->update(['verified' => false]);

        if (!$waitingActivation && is_valid_email_format($this->user->user_email)) {
            Mail::to($this->user)->send(new UserForceReactivation([
                'user' => $this->user,
                'reason' => $this->reason,
            ]));
        }
    }

    private function addHistoryNote()
    {
        $message = match ($this->reason) {
            static::INACTIVE => "First login after {$this->daysSinceLastLogin()} days. Forcing password reset.",
            static::INACTIVE_DIFFERENT_COUNTRY => "First login after {$this->daysSinceLastLogin()} days from {$this->country}. Forcing password reset.",
            default => null,
        };

        if ($message !== null) {
            UserAccountHistory::addNote($this->user, $message);
        }
    }

    private function daysSinceLastLogin(): int
    {
        return (int) $this->user->user_lastvisit->diffInDays();
    }
}
