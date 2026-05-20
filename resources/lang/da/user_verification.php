<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'En email er blevet sendt til :mail med en bekræftelseskode. Skriv koden her.',
        'title' => 'Kontobekræftelse',
        'verifying' => 'Bekræfter...',
        'issuing' => 'Laver ny kode...',

        'info' => [
            'check_spam' => "Husk at tjekke din spammappe, hvis ikke du kan finde emailen.",
            'recover' => "Hvis ikke du har adgang til din email-adresse eller har glemt hvilken email-adresse, du bruger, følg venligst :link.",
            'recover_link' => 'email-adresse genoprettelsesprocessen her',
            'reissue' => 'Du kan også :reissue_link eller :logout_link.',
            'reissue_link' => 'anmode om en ny kode',
            'logout_link' => 'logge ud',
        ],
    ],

    'box_totp' => [
        'heading' => 'Indtast venligst koden fra din godkendelses-app.',

        'info' => [
            'logout' => [
                '_' => 'Du kan også :link.',
                'link' => 'log ud',
            ],
            'mail_fallback' => [
                '_' => 'Hvis du ikke har adgang til din app, :link.',
                'link' => 'du kan verificere med e-mail i stedet',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'Bekræftelseskoden er udløbet, og en ny email med bekræftelseskode er blevet sendt.',
        'incorrect_key' => 'Ugyldig bekræftelseskode.',
        'retries_exceeded' => 'Ugyldig bekræftelseskode, og du har brugt for mange forsøg. En ny email med bekræftelseskode er blevet sendt.',
        'reissued' => 'En email med en ny bekræftelseskode er blevet sendt.',
        'totp_used_key' => 'Bekræftelseskode er allerede brugt. Vent venligst og brug en ny.',
        'totp_gone' => 'Godkendelsestoken er blevet fjernet, skifter til e-mail bekræftelse. Bekræftelsesmail er blevet sendt.',
        'unknown' => 'Der opstod et ukendt problem. En ny email med bekræftelseskode er blevet sendt.',
    ],
];
