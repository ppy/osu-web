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

namespace App\Events;

use Illuminate\Broadcasting\Channel;

class UserSessionEvent extends NotificationEventBase
{
    public $action;
    public $data;
    public $userId;

    public static function newLogout($userId, $keys)
    {
        return new static('logout', $userId, compact('keys'));
    }

    public static function newVerificationRequirementChange($userId, $isRequired)
    {
        return new static('verification_requirement_change', $userId, [
            'requires_verification' => $isRequired,
        ]);
    }

    public static function newVerified($userId, $key)
    {
        return new static('verified', $userId, compact('key'));
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($action, $userId, $data)
    {
        parent::__construct();

        $this->action = $action;
        $this->userId = $userId;
        $this->data = $data;
    }

    public function broadcastAs()
    {
        return $this->action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("user_session:{$this->userId}");
    }

    public function broadcastWith()
    {
        return $this->data;
    }
}
