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

return [
    'signature' => [
        'not_match' => 'Подписи не совпадают',
    ],
    'notification_type' => 'notification_type не действует :type',
    'order' => [
        'invalid' => 'Заказ недействителен',
        'items' => [
            'virtual_only' => '`:provider` платеж не действителен для физических предметов.',
        ],
        'status' => [
            'not_checkout' => 'Попытка принять оплату за заказ отклонена `:state`.',
            'not_paid' => 'Попытка возместить платеж за заказ отклонена`:state`.',
        ],
    ],
    'param' => [
        'invalid' => 'параметр `:param` неверный',
    ],
    'paypal' => [
        'not_echeck' => 'Ожидаемый платеж не является чеком. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Сумма платежа не соответствует: :actual != :expected',
            'currency' => 'Оплата производится не в USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Идентификатор транзакции полученного заказа неверен',
        'user_id_mismatch' => 'external_id содержит неправильный идентификатор пользователя',
    ],
];
