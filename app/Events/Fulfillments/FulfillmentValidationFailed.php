<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events\Fulfillments;

use App\Libraries\ValidationErrors;

class FulfillmentValidationFailed extends ValidationFailedEvent implements HasOrder
{
    private $order;

    public function __construct($sender, ValidationErrors $errors)
    {
        parent::__construct($sender, $errors);
        $this->order = $sender->getOrder();
    }

    public function getOrder()
    {
        return $this->order;
    }
}
