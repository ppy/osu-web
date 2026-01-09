<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* Не дозволено з обліковими даними клієнта',
        'all_scope_no_mix' => '* не підходить з іншими областями',
        'client_missing_owner' => 'У клієнта відсутній власник.',
        'client_unauthorized' => 'Клієнт не авторизований.',
        'delegate_bot_only' => 'Делегація з облікових даних клієнта доступна лише для чат-ботів.',
        'client_credentials_only' => 'Ця область (scope) допустима лише для client_credentials токенів.',
        'delegate_invalid_combination' => 'Делегація не підтримується для цієї комбінації областей.',
        'delegate_required' => 'Потрібно делегувати область видимості.',
        'empty' => 'Токени без областей є недійсними.',
        'bot_only' => 'Ця сфера доступна тільки для ботів чату або ваших власних клієнтів.',
    ],
];
