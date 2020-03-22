<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\User;

use App\Libraries\Session\Store as SessionStore;
use App\Mail\UserForceReactivation;
use App\Models\LegacySession;
use App\Models\UserAccountHistory;
use App\Models\UserClient;
use Mail;

class ForceReactivation
{
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

        if ($this->user->isInactive() && $this->user->country_acronym !== $this->country) {
            $this->reason = static::INACTIVE_DIFFERENT_COUNTRY;
        }
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
        SessionStore::destroy($userId);
        LegacySession::where('session_user_id', $userId)->delete();
        UserClient::where('user_id', $userId)->update(['verified' => false]);

        if (!$waitingActivation && present($this->user->user_email)) {
            Mail::to($this->user)->send(new UserForceReactivation([
                'user' => $this->user,
                'reason' => $this->reason,
            ]));
        }
    }

    private function addHistoryNote()
    {
        if ($this->reason === static::INACTIVE_DIFFERENT_COUNTRY) {
            $message = "First login after {$this->user->user_lastvisit->diffInDays()} days from {$this->country}. Forcing password reset.";
        }

        if ($message !== null) {
            UserAccountHistory::addNote($this->user, $message);
        }
    }
}
