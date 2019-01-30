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

namespace App\Libraries\Fulfillments;

use App\Events\Fulfillments\FulfillmentValidationFailed;
use App\Models\Store\Order;
use App\Traits\Validatable;

abstract class OrderFulfiller implements Fulfillable
{
    use Validatable;

    const TAGGED_NAME = 'order-fulfiller';

    /** @var Order */
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    abstract public function run();

    abstract public function revoke();

    /**
     * Tag for context in system message events and stuff.
     *
     * @return string
     */
    public function taggedName()
    {
        return static::TAGGED_NAME;
    }

    public function getOrder()
    {
        return $this->order;
    }

    protected function throwOnFail(bool $valid = false)
    {
        if (!$valid) {
            $this->throwValidationFailed(new FulfillmentException($this->validationErrors()));
        }
    }

    abstract public function validationErrorsTranslationPrefix();

    protected function dispatchValidationFailed()
    {
        event(
            "store.fulfillments.validation.failed.{$this->taggedName()}",
            new FulfillmentValidationFailed($this, $this->validationErrors())
        );
    }

    /**
     * Convenience method that calls dispatchValidationFailed() and then throws the supplied exception.
     *
     * @param Exception $exception
     * @return void
     */
    protected function throwValidationFailed(\Exception $exception)
    {
        $this->dispatchValidationFailed();
        throw $exception;
    }
}
