<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events\Fulfillments;

use App\Events\MessageableEvent;
use App\Models\Store\Order;
use App\Models\User;

abstract class UsernameEvent implements MessageableEvent, HasOrder
{
    protected $order;
    protected $user;

    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

    abstract public function toMessage();
}
