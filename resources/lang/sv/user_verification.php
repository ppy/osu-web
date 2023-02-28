<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Ett e-postmeddelande har skickats till :mail med en verifieringskod. Ange koden.',
        'title' => 'Kontobekräftelse',
        'verifying' => 'Bekräftar...',
        'issuing' => 'Skickar ny kod...',

        'info' => [
            'check_spam' => "Se till att kolla skräpposten ifall du inte kan hitta e-postmeddelandet.",
            'recover' => "Om du inte kan komma åt din e-post eller har glömt vilken du använde, vänligen följ :link. ",
            'recover_link' => 'e-poståterställningsprocess här ',
            'reissue' => 'Du kan också :reissue_link eller :logout_link.',
            'reissue_link' => 'begär en ny kod',
            'logout_link' => 'logga ut',
        ],
    ],

    'errors' => [
        'expired' => 'Verifieringskoden har löpt ut, ett nytt bekräftelsemejl har skickats.',
        'incorrect_key' => 'Felaktig bekräftelsekod.',
        'retries_exceeded' => 'Felaktig bekräftelsekod. Försöksgränsen har uppnåtts, ett nytt bekräftelsemejl har skickats.',
        'reissued' => 'Verifieringskod återutfärdad, ett nytt bekräftelsemail har skickats.',
        'unknown' => 'Ett okänt problem uppstod, ett nytt bekräftelsemejl har skickats.',
    ],
];
