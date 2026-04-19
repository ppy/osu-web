<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'create' => [
        'finish' => 'Slutför',
        'key' => 'Skanna QR-koden med autentiseringsappen och ange verifieringsnyckeln',
        'key_copy' => 'Eller klicka på denna länk för att kopiera nyckeln till autentiseringsappen',
        'key_link' => 'Använd denna länk om du använder mobiltelefon',
        'password' => 'För att konfigurera verifiering av autentiseringsappen, vänligen ange ditt nuvarande lösenord',
        'start' => 'Fortsätt',
    ],

    'destroy' => [
        'missing' => 'Du har inte konfigurerat verifiering av autentiseringsappar.',
        'ok' => 'Verifiering av autentiseringsapp har tagits bort.',
    ],

    'edit' => [
        'password' => 'Ange ditt nuvarande lösenord för att ta bort verifiering av autentiseringsappen.',
        'start' => 'Ta bort ',
    ],

    'store' => [
        'existing' => 'Du har redan konfigurerat verifiering av autentiseringsappen.',
        'ok' => 'Verifiering av autentiseringsapp har konfigurerats',
        'restart' => 'Ett fel uppstod. Starta om processen.',
    ],
];
