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

use App\Events\Fulfillment\FulfillmentValidationFailed;
use App\Libraries\ValidationFailable;
use App\Models\Store\Order;
use App\Traits\Validatable;

abstract class OrderFulfiller implements Fulfillable, ValidationFailable
{
    use Validatable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    abstract public function run();
    abstract public function revoke();

    public function getOrder()
    {
        return $this->order;
    }

    protected function throwOnFail($valid)
    {
        if (!$valid) {
            $this->dispatchValidationFailed();
            throw new FulfillmentException($this->validationErrors());
        }
    }

    abstract public function validationErrorsTranslationPrefix();

    public function dispatchValidationFailed()
    {
        event(new FulfillmentValidationFailed($this, $this->validationErrors()));
    }
}
