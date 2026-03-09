<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* är inte tillåtet med klientuppgifter',
        'all_scope_no_mix' => '* är inte giltigt med andra tillämpningsområden',
        'client_missing_owner' => 'Klienten saknar ägare.',
        'client_unauthorized' => 'Klienten är inte auktoriserad.',
        'delegate_bot_only' => 'Delegering med klientuppgifter är endast tillgänglig för chattrobotar.',
        'client_credentials_only' => 'Detta område är endast giltigt för client_credentials poletter.',
        'delegate_invalid_combination' => 'Delegationen stöds inte för denna kombination av omfång.',
        'delegate_required' => 'delegatens omfattning krävs.',
        'empty' => 'Poletter utan räckvidd är inte giltiga.',
        'bot_only' => 'Detta område är endast tillgängligt för chattrobotar eller dina egna kunder.',
    ],
];
