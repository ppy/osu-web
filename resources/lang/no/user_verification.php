<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'En e-post har blitt sendt til :mail med en bekreftelseskode. Skriv inn koden.',
        'title' => 'Kontobekreftelse',
        'verifying' => 'Verifiserer...',
        'issuing' => 'Sender ny kode...',

        'info' => [
            'check_spam' => "Husk å sjekke spam-mappen din hvis du ikke finner e-posten.",
            'recover' => "Hvis du ikke får tilgang til e-post kontoen din eller har glemt hva du brukte, vennligst følg denne :link.",
            'recover_link' => 'e-post gjenopprettingsprosess her',
            'reissue' => 'Du kan også :reissue_link eller :logout_link.',
            'reissue_link' => 'be om en annen kode',
            'logout_link' => 'logg ut',
        ],
    ],

    'errors' => [
        'expired' => 'Bekreftelseskoden har utløpt, ny bekreftelsesmail sendt.',
        'incorrect_key' => 'Ugyldig bekreftelseskode.',
        'retries_exceeded' => 'Ugyldig bekreftelseskode. Antall tillatte forsøk overskredet, ny bekreftelsesmail sendt.',
        'reissued' => 'Bekreftelseskoden har blitt gjenutgitt, ny bekreftelsesmail sendt.',
        'unknown' => 'Et ukjent problem har forekommet, ny bekreftelsesmail sendt.',
    ],
];
