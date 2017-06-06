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

return [
    'admin' => [
        'warehouse' => 'Склад',
    ],

    'checkout' => [
        'pay' => 'Оплатить с PayPal',
        'delayed_shipping' => 'В настоящее время у нас очень большая очередь! Вы можете разместить свой заказ, но пожалуйста, помните, что это может занять **дополнительно 1-2 недели** пока мы справимся с текущими заказами.',
    ],

    'order' => [
        'item' => [
            'quantity' => 'Количество',
        ],
    ],

    'product' => [
        'name' => 'Название',

        'stock' => [
            'out' => 'В настоящее время нет в наличии :(. Загляните к нам позже.',
            'out_with_alternative' => 'Данный тип в настоящее время отсутствует на складе :(. Попробуйте другой тип или загляните к нам позже.',
        ],

        'add_to_cart' => 'Добавить в корзину',
        'notify' => 'Напомнить мне о поступлении!',

        'notification_success' => 'Вы будете оповещены когда товар будет в наличии. Нажмите :link для отмены',
        'notification_remove_text' => 'сюда',

        'notification_in_stock' => 'Данный товар уже в наличии!',
    ],
];
