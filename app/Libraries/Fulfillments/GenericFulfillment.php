<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

use App\Events\Fulfillments\OrderFulfillerEvent;

/**
 * Placeholder class for handling non-custom class order item fulfillment.
 */
class GenericFulfillment extends OrderFulfiller
{
    const TAGGED_NAME = 'generic';

    public function __construct($order)
    {
        parent::__construct($order);
    }

    public function run()
    {
        // almost noop
        event("store.fulfillments.run.{$this->taggedName()}", new OrderFulfillerEvent($this->order));
    }

    public function revoke()
    {
        // almost noop
        event("store.fulfillments.revoke.{$this->taggedName()}", new OrderFulfillerEvent($this->order));
    }

    public function validationErrorsTranslationPrefix()
    {
        return '';
    }
}
