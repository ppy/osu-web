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

use App\Models\Store\Order;

class OrderNumber
{
    const ORDER_NUMBER_REGEX = '/^store-(?<userId>\d+)-(?<orderId>\d+)$/';

    private $userId;
    private $orderId;
    private $isValid = true;

    public function __construct(string $orderNumberString)
    {
        if (preg_match(static::ORDER_NUMBER_REGEX, $orderNumberString, $matches)) {
            $this->userId = $matches['userId'];
            $this->orderId = $matches['orderId'];
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
            return "store-{$this->userId}-{$this->orderId}";
        }

        return '';
    }
}
