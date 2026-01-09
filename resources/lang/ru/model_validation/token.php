<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => 'Использовать * с Client Credentials запрещено',
        'all_scope_no_mix' => '* недопустим с другими scopes',
        'client_missing_owner' => 'У клиента отсутствует владелец.',
        'client_unauthorized' => 'Клиент не авторизован.',
        'delegate_bot_only' => 'Делегирование с Client Credentials доступно только чат-ботам.',
        'client_credentials_only' => 'Эта область (scope) допустима только для токенов client_credentials.',
        'delegate_invalid_combination' => 'Делегирование не поддерживается для данной комбинации scope.',
        'delegate_required' => 'область (scope) делегирования обязательна.',
        'empty' => 'Токены без scope недействительны.',
        'bot_only' => 'Данный scope доступен только чат-ботам или вашим собственным клиентам.',
    ],
];
