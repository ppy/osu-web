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

namespace App\Models\Store;

use App\Models\Country;
use App\Models\SupporterTag;
use App\Models\User;

trait OrderCartTrait
{
    /**
     * Updates the Order with form parameters.
     *
     * Updates the Order with with an item extracted from submitted form parameters.
     * The function returns an array containing whether the operation was successful,
     * and a message.
     *
     * @param array $itemForm form parameters.
     * @param bool $addToExisting whether the quantity should be added or replaced.
     * @return array [success, message]
     **/
    public function updateItem(array $itemForm, $addToExisting = false)
    {
        $params = [
            'id' => array_get($itemForm, 'id'),
            'quantity' => array_get($itemForm, 'quantity'),
            'product' => Product::enabled()->find(array_get($itemForm, 'product_id')),
            'cost' => intval(array_get($itemForm, 'cost')),
            'extraInfo' => array_get($itemForm, 'extra_info'),
            'extraData' => array_get($itemForm, 'extra_data'),
        ];

        if ($params['product'] === null) {
            return [false, 'no product'];
        }

        $result = [true, ''];

        if ($params['quantity'] <= 0) {
            $this->removeOrderItem($params);
        } else {
            if ($params['product']->allow_multiple) {
                $item = $this->newOrderItem($params);
            } else {
                $item = $this->updateOrderItem($params, $addToExisting);
            }

            $result = $this->validateBeforeSave($params['product'], $item);
            if ($result[0]) {
                $this->save();
                $this->items()->save($item);
            }
        }

        return $result;
    }

    private function removeOrderItem(array $params)
    {
        $itemId = $params['id'];
        $item = $this->items()->find($itemId);

        if ($item) {
            $item->delete();
        }

        if ($this->items()->count() === 0) {
            $this->delete();
        }
    }

    private function newOrderItem(array $params)
    {
        if ($params['cost'] < 0) {
            $params['cost'] = 0;
        }

        $product = $params['product'];

        // FIXME: custom class stuff should probably not go in Order...
        switch ($product->custom_class) {
            case 'supporter-tag':
                $targetId = $params['extraData']['target_id'];
                $user = User::default()->where('user_id', $targetId)->firstOrFail();
                $params['extraData']['username'] = $user->username;

                $params['extraData']['duration'] = SupporterTag::getDuration($params['cost']);
                break;
            case 'username-change':
                // ignore received cost
                $params['cost'] = $this->user->usernameChangeCost();
                break;
            case 'cwc-supporter':
            case 'mwc4-supporter':
            case 'mwc7-supporter':
            case 'owc-supporter':
            case 'twc-supporter':
                // much dodgy. wow.
                $matches = [];
                preg_match('/.+\((?<country>.+)\)$/', $product->name, $matches);
                $params['extraData']['cc'] = Country::where('name', $matches['country'])->first()->acronym;
                $params['cost'] = $product->cost ?? 0;
                break;
            default:
                $params['cost'] = $product->cost ?? 0;
        }

        $item = new OrderItem();
        $item->quantity = $params['quantity'];
        $item->extra_info = $params['extraInfo'];
        $item->extra_data = $params['extraData'];
        $item->cost = $params['cost'];
        $item->product()->associate($product);

        return $item;
    }

    private function updateOrderItem(array $params, $addToExisting = false)
    {
        $product = $params['product'];
        $item = $this->items()->where('product_id', $product->product_id)->get()->first();
        if ($item === null) {
            return $this->newOrderItem($params);
        }

        if ($addToExisting) {
            $item->quantity += $params['quantity'];
        } else {
            $item->quantity = $params['quantity'];
        }

        return $item;
    }
}
