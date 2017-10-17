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

namespace App\Libraries;

class OrderNumber
{
    private $userId;
    private $orderId;
    private $isValid = true;

    public function __construct(string $orderNumberString = null)
    {
        $regex = '/^'.config('store.order.prefix').'-(?<userId>\d+)-(?<orderId>\d+)$/';
        if (preg_match($regex, $orderNumberString, $matches)) {
            $this->userId = (int) $matches['userId'];
            $this->orderId = (int) $matches['orderId'];
        } else {
            $this->isValid = false;
        }
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function isValid()
    {
        return $this->isValid;
    }

    public function __toString()
    {
        if ($this->userId && $this->orderId) {
            return config('store.order.prefix')."-{$this->userId}-{$this->orderId}";
        }

        return '';
    }
}
