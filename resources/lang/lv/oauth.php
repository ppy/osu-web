<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Atcelt',

    'authorise' => [
        'app_owner' => ':owner aplikācija',
        'request' => 'pieprasa atļauju tava konta piekļuvei.',
        'scopes_title' => 'Šī aplikācija varēs:',
        'title' => 'Autorizācijas Pieprasījums',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Vai tu esi drošs ka vēlies atsaukt klienta atļaujas?',
        'scopes_title' => 'Šī aplikācija var:',
        'owned_by' => 'Īpašnieks :user',
        'none' => 'Nav Klientu',

        'revoked' => [
            'false' => 'Atņemt Piekļuvi',
            'true' => 'Piekļuve Atcelta',
        ],
    ],

    'client' => [
        'id' => 'Klienta ID',
        'name' => 'Aplikācijas Nosaukums',
        'redirect' => 'Aplikācijas Atzvanu URLs',
        'reset' => 'Atiestatīt klienta noslēpumu',
        'reset_failed' => 'Neizdevāt atiestatīt klienta noslēpumu',
        'secret' => 'Klienta Noslēpums',

        'secret_visible' => [
            'false' => 'Parādīt klienta noslēpumu',
            'true' => 'Paslēpt klienta noslēpumu',
        ],
    ],

    'new_client' => [
        'header' => 'Reģistrēt jaunu OAuth aplikāciju',
        'register' => 'Reģistrēt aplikāciju',
        'terms_of_use' => [
            '_' => 'Izmantojot šo API, tu piekrīti :link.',
            'link' => 'Lietošanas Noteikumi',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Vai tu esi drošs ka vēlies izdzēst šo klientu?',
        'confirm_reset' => 'Vai tu esi drošs ka vēlies restartēt klienta noslēpumu? Tas atcels visus eksistējošos žetonus.',
        'new' => 'Jauna OAuth Aplikācija',
        'none' => 'Nav klientu ',

        'revoked' => [
            'false' => 'Izdzēst',
            'true' => 'Izdzēsts',
        ],
    ],
];
