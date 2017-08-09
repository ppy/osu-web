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

namespace App\Libraries\Fulfillments;

use App\Models\User;
use App\Exceptions\UsernameChangeException;

class UsernameChangeFulfillment extends OrderFulfiller
{
    private $orderItems;

    public function run($context)
    {
        $this->isValid();

        $user = $this->order->user;
        $item = $this->getOrderItems()->first();
        $user->changeUsername($this->getNewUserName());
    }

    public function revoke($context)
    {
        $user = $this->order->user;
        $item = $this->getOrderItems()->first();
        if ($user['username'] !== $this->getNewUsername()) {
            throw new UsernameChangeException(
                "Current username ({$user['username']}) is not the same as change to revoke: {$this->getNewUsername()}"
            );
        }

        $user->revertUsername();
    }

    public function isValid()
    {
        $user = $this->order->user;
        $items = $this->getOrderItems();
        if ($items->count() !== 1) {
            throw new \Exception('only 1 username change allowed per order fulfillment.');
        }

        $item = $items->first();
        \Log::debug("{$item->cost}, {$user->usernameChangeCost()}");
        return $item['cost'] >= $user->usernameChangeCost();
    }

    private function getOrderItems()
    {
        if (!isset($this->orderItems)) {
            $this->orderItems = $this->order->items()->customClass('username-change')->get();
        }

        return $this->orderItems;
    }

    private function getNewUsername()
    {
        return $this->getOrderItems()->first()['extra_info'];
    }
}
