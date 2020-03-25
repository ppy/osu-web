<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
