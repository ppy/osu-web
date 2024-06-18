<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

use App\Exceptions\ChangeUsernameException;
use App\Exceptions\Store\FulfillmentException;
use App\Models\Event;

class UsernameChangeFulfillment extends OrderFulfiller
{
    const TAGGED_NAME = 'username-change';

    private $orderItems;

    public function run()
    {
        $this->assertValidRun();

        $user = $this->order->user;

        try {
            $history = $user->changeUsername($this->getNewUserName(), $this->getChangeType());
        } catch (ChangeUsernameException $ex) {
            $this->validationErrors()->merge($ex->getErrors());
            throw new FulfillmentException($this->order, $this->validationErrors(), $ex);
        }

        Event::generate('usernameChange', [
            'user' => $user,
            'history' => $history,
        ]);

        \Datadog::increment(
            "{$GLOBALS['cfg']['datadog-helper']['prefix_web']}.store.fulfillments.run",
            1,
            ['type' => static::TAGGED_NAME]
        );
    }

    public function revoke()
    {
        $this->assertValidRevoke();

        $user = $this->order->user;
        $user->revertUsername();

        \Datadog::increment(
            "{$GLOBALS['cfg']['datadog-helper']['prefix_web']}.store.fulfillments.revoke",
            1,
            ['type' => static::TAGGED_NAME]
        );
    }

    private function assertValidRun(): void
    {
        $this->validationErrors()->reset();

        $user = $this->order->user;
        $items = $this->getOrderItems();

        if ($items->count() !== 1) {
            $this->validationErrors()->add('count', 'only_one');
        }

        $item = $items->first();

        if ($item['cost'] < $user->usernameChangeCost()) {
            $this->validationErrors()->add(
                'cost',
                '.insufficient_paid',
                ['expected' => $user->usernameChangeCost(), 'actual' => $item['cost']]
            );
        }

        if ($this->validationErrors()->isAny()) {
            throw new FulfillmentException($this->order, $this->validationErrors());
        }
    }

    private function assertValidRevoke(): void
    {
        $this->validationErrors()->reset();

        $user = $this->order->user;

        if ($user['username'] !== $this->getNewUsername()) {
            $this->validationErrors()->add(
                'username',
                '.reverting_username_mismatch',
                [
                    'current' => $user['username'],
                    'username' => $this->getNewUsername(),
                ]
            );
        }

        if ($this->validationErrors()->isAny()) {
            throw new FulfillmentException($this->order, $this->validationErrors());
        }
    }

    private function getChangeType()
    {
        $item = $this->getOrderItems()->first();

        return $item['cost'] > 0 ? 'paid' : 'support';
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

    //================
    // Validatable
    //================
    public function validationErrorsTranslationPrefix(): string
    {
        return 'fulfillments.username_change';
    }

    public function validationErrorsKeyBase(): string
    {
        return 'model_validation/';
    }
}
