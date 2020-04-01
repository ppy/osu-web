<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'username_change' => [
        'only_one' => 'разрешена только одна смена ника за оплату каждого заказа.',
        'insufficient_paid' => 'Стоимость смены ника превышает оплаченную сумму (:expected > :actual)',
        'reverting_username_mismatch' => 'Текущий ник (:current) не похож на предыдущий (:username) для восстановления',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Сумма платежа недостаточна для приобретения osu!supporter (:actual вместо :expected)',
    ],
];
