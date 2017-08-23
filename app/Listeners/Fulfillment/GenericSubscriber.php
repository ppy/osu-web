<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Listeners\Fulfillment;

use App\Events\Fulfillment\UsernameChanged;
use App\Events\Fulfillment\UsernameReverted;

class GenericSubscriber
{
    use Notifiable;

    public function onUsernameChanged($event)
    {
        $user = $event->user;
        $this->notifyOrder(
            $event->order,
            "`User {$user->user_id}` Changed username from `{$user->username_previous}` to `{$user->username}`."
        );
    }

    public function onUsernameReverted($event)
    {
        $user = $event->user;
        $this->notifyOrder(
            $event->order,
            "`User {$user->user_id}` Reverted username to `{$user->username}`."
        );
    }

    public function subscribe($events)
    {
        $events->listen(
            UsernameChanged::class,
            static::class.'@onUsernameChanged'
        );

        $events->listen(
            UsernameReverted::class,
            static::class.'@onUsernameReverted'
        );
    }
}
