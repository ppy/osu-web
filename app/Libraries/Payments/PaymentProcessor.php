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

namespace App\Libraries\Payments;

use App\Events\Fulfillment\PaymentCancelled;
use App\Events\Fulfillment\PaymentCompleted;
use App\Events\Fulfillment\ProcessorValidationFailed;
use App\Libraries\ValidationFailable;
use App\Libraries\Fulfillments\Fulfillment;
use App\Models\Store\Order;
use App\Traits\Validatable;
use Carbon\Carbon;
use DB;

abstract class PaymentProcessor implements \ArrayAccess, ValidationFailable
{
    use Validatable;

    private $json;
    protected $order;
    protected $request;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
        $this->json = $request->json()->all();
    }

    /**
     * Gets the string that corresponds to an internal Order id.
     *
     * @return string
     */
    abstract public function getOrderId();

    /**
     * Gets a more friendly identifying order number string that represents an Order.
     *
     * @return string
     */
    abstract public function getOrderNumber();

    /**
     * Gets the transaction ID for the payment.
     * Transaction IDs should be unique to the payment processor.
     *
     * @return string
     */
    abstract public function getTransactionId();

    /**
     * Gets the payment date given by the payment provider.
     *
     * @return Carbon\Carbon
     */
    abstract public function getPaymentDate();

    /**
     * Validates the transaction.
     * Returns true if the transaction is valid; false, otherwise.
     *
     * @return boolean
     */
    abstract public function validateTransaction();

    /**
     * Gets the type of payment notification.
     *
     * @return string
     */
    abstract public function getNotificationType();

    /**
     * Tells callers to ignore this notification
     */
    public function isSkipped()
    {
        return false;
    }

    /**
     * Processes the payment transaction
     *
     * @return void
     */
    public function apply($validate = true)
    {
        if ($validate) {
            if (!$this->validateTransaction()) {
                $this->dispatchValidationFailed();
                throw new PaymentProcessorException($this->validationErrors());
            }
        }

        DB::connection('mysql-store')->transaction(function () {
            $order = $this->getOrder();
            $order->paid($this->getTransactionId(), $this->getPaymentDate());
            event(new PaymentCompleted($order));
        });
    }

    /**
     * Cancels the payment transaction
     *
     * @return void
     */
    public function cancel($validate = true)
    {
        if ($validate) {
            if (!$this->validateTransaction()) {
                $this->dispatchValidationFailed();
                throw new PaymentProcessorException($this->validationErrors());
            }
        }

        DB::connection('mysql-store')->transaction(function () {
            $order = $this->getOrder();
            $order->cancel();
            event(new PaymentCancelled($order));
        });
    }

    /**
     * Sends a ValidationFailedEvent with the validation errors
     *
     * @return void
     */
    public function dispatchValidationFailed()
    {
        event(new ProcessorValidationFailed(
            $this,
            $this->validationErrors()
        ));
    }

    /**
     * implements ArrayAccess
     */
    public function offsetExists($key)
    {
        return array_has($this->json, $key);
    }

    public function offsetGet($key)
    {
        return data_get($this->json, $key);
    }
    public function offsetSet($key, $value)
    {
        throw new \Exception('not supported');
    }

    public function offsetUnset($key)
    {
        throw new \Exception('not supported');
    }

    protected function getOrder()
    {
        if (!isset($this->order)) {
            $this->order = Order::find($this->getOrderId());
        }

        return $this->order;
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'payments';
    }

    public function validationErrorsKeyBase()
    {
        return 'model_validation/';
    }
}
