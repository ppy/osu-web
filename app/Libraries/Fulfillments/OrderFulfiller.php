<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
