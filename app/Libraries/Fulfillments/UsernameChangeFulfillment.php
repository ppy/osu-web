<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

use App\Events\Fulfillments\UsernameChanged;
use App\Events\Fulfillments\UsernameReverted;
use App\Exceptions\ChangeUsernameException;
use App\Models\Event;

class UsernameChangeFulfillment extends OrderFulfiller
{
    const TAGGED_NAME = 'username-change';

    private $orderItems;

    public function run()
    {
        $this->throwOnFail($this->validateRun());

        $user = $this->order->user;
        try {
            $history = $user->changeUsername($this->getNewUserName(), $this->getChangeType());
        } catch (ChangeUsernameException $ex) {
            $this->validationErrors()->merge($ex->getErrors());
            $this->throwOnFail();
        }

        Event::generate('usernameChange', [
            'user' => $user,
            'history' => $history,
        ]);

        event("store.fulfillments.run.{$this->taggedName()}", new UsernameChanged($user, $this->order));
    }

    public function revoke()
    {
        $this->throwOnFail($this->validateRevoke());

        $user = $this->order->user;
        $user->revertUsername();
        event("store.fulfillments.revert.{$this->taggedName()}", new UsernameReverted($user, $this->order));
    }

    private function validateRun()
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

        return $this->validationErrors()->isEmpty();
    }

    private function validateRevoke()
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

        return $this->validationErrors()->isEmpty();
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
    public function validationErrorsTranslationPrefix()
    {
        return 'fulfillments.username_change';
    }

    public function validationErrorsKeyBase()
    {
        return 'model_validation/';
    }
}
