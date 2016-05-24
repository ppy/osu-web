<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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

return [
    'admin' => [
        'warehouse' => 'Warehouse',
    ],

    'checkout' => [
        'pay' => 'Checkout with Paypal',
        'delayed_shipping' => 'We are currently overwhelmed with orders! You are welcome to place your order, but please expect an **additional 1-2 week delay** while we catch up with existing orders.',
    ],

    'order' => [
        'item' => [
            'quantity' => 'Quantity',
        ],
    ],

    'product' => [
        'name' => 'Name',

        'stock' => [
            'out' => 'Currently out of stock :(. Check back soon.',
            'out_with_alternative' => 'This type is currently out of stock :(. Try other type or check back soon.',
        ],

        'add-to-cart' => 'Add to Cart',
        'notify' => 'Notify me when available!',

        'notification-success' => 'you will be notified when we have new stock. click <a href=":url" data-remote="true" data-method="put">here</a> to cancel',
        'notification-in-stock' => 'This product is already in stock!',
        'notification-already-requested' => 'You have already requested a notification for this product!',
    ],
];
