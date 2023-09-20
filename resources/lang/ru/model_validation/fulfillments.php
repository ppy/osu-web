<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'username_change' => [
        'only_one' => 'ник в рамках одного заказа можно поменять только один раз.',
        'insufficient_paid' => 'Суммы платежа недостаточно для оплаты смены ника (:expected > :actual)',
        'reverting_username_mismatch' => 'Текущий ник (:current) не совпадает с ником, который нужно откатить (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Суммы платежа недостаточно для приобретения тега osu!supporter (:actual вместо :expected)',
    ],
];
