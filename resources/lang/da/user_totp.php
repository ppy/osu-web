<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'create' => [
        'finish' => 'Afslut',
        'key' => 'Scan QR-koden med godkendelses-app\'en og indtast bekræftelsesnøglen',
        'key_copy' => 'Eller klik på dette link for at kopiere nøglen til godkendelses-app\'en',
        'key_link' => 'Brug dette link, hvis du bruger mobiltelefon',
        'password' => 'For at konfigurere godkendelses-app\'en skal du angive din nuværende adgangskode',
        'start' => 'Fortsæt',
    ],

    'destroy' => [
        'missing' => 'Du har ikke godkendelses-app\'en konfigureret.',
        'ok' => 'Verificering af godkendelses-app fjernet.',
    ],

    'edit' => [
        'password' => 'Indtast venligst din nuværende adgangskode for at fjerne godkendelses-app\'ens verificering.',
        'start' => 'Fjern',
    ],

    'store' => [
        'existing' => 'Du kan allerede konfigureret godkendelses-app\'en.',
        'ok' => 'Verificering af godkendelses-app er blevet konfigureret',
        'restart' => 'Fejl opstod. Genstart venligst processen.',
    ],
];
