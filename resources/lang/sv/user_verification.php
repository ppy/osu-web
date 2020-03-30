<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Ett email har skickats till :mail med en verifieringskod. Skriv in koden.',
        'title' => 'Kontobekräftelse',
        'verifying' => 'Verifierar...',
        'issuing' => 'Skickar ny kod...',

        'info' => [
            'check_spam' => "Dubbelkolla skräpposten ifall du inte kan hitta emailet.",
            'recover' => "Om du inte har tillgång till din email eller har glömt vad du använde, var vänlig följ :link.",
            'recover_link' => 'email återställning processen här',
            'reissue' => 'Du kan också :reissue_link eller :logout_link.',
            'reissue_link' => 'begär en ny kod',
            'logout_link' => 'logga ut',
        ],
    ],

    'errors' => [
        'expired' => 'Verifieringskoden har utgått, ett nytt bekräftelsemail har skickats.',
        'incorrect_key' => 'Felaktig verifieringskod.',
        'retries_exceeded' => 'Felaktig verifieringskod. Försöksgräns uppnådd, ett nytt bekräftelsemail har skickats.',
        'reissued' => 'Verifieringskod återutfärdad, ett nytt bekräftelsemail har skickats.',
        'unknown' => 'Ett okänt problem uppstod, ett nytt bekräftelsemail har skickats.',
    ],
];
