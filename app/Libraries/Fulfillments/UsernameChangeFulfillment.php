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
