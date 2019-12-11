<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
