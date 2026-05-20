<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* er ikke tilladet med Klient Oplysninger',
        'all_scope_no_mix' => '* er ikke tilladet med andre anvendelsesområder',
        'client_missing_owner' => 'Klienten mangler ejer.',
        'client_unauthorized' => 'Klienten er ikke autoriseret.',
        'delegate_bot_only' => 'Uddelegering med Klient Oplysninger er kun tilgængelig for robotter.',
        'client_credentials_only' => 'Dette anvendelsesområde er kun gyldigt for client_credentials tokens.',
        'delegate_invalid_combination' => 'Delegationen støttes ikke for denne kombination af anvendelsesområder.',
        'delegate_required' => 'anvendelsesområde for delegation er påkrævet.',
        'empty' => 'Tokens uden anvendelsesområder er ikke gyldige.',
        'bot_only' => 'Dette anvendelsesområde er kun tilgængeligt for robotter eller dine egne kunder.',
    ],
];
