<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_scope' => [
        'all_scope_no_client_credentials' => '* ügyfél-hitelesítő adatok használata esetén nem megengedett',
        'all_scope_no_mix' => '* más hatályokkal együtt nem érvényes',
        'client_missing_owner' => 'Az ügyfélnél hiányzik a tulajdonos.',
        'client_unauthorized' => 'Az ügyfél nem rendelkezik jogosultsággal.',
        'delegate_bot_only' => 'Az ügyfél-hitelesítő adatokkal történő delegálás kizárólag a botok számára elérhető.',
        'client_credentials_only' => 'Ez a hatály kizárólag a client_credentials típusú tokenekre vonatkozik.',
        'delegate_invalid_combination' => 'A felhatalmazás nem támogatott ebben a hatálykombinációban.',
        'delegate_required' => 'A delegátum hatókörének megadása kötelező.',
        'empty' => 'A hatókör nélküli tokenek érvénytelenek.',
        'bot_only' => 'Ez a hozzáférési kör kizárólag botok vagy a saját klienseid számára érhető el.',
    ],
];
