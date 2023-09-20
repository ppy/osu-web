<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
    private function __construct($action, $userId, $data)
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
