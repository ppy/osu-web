<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'codes' => [
        'http-401' => 'Log in om verder te gaan.',
        'http-403' => 'Toegang geweigerd.',
        'http-404' => 'Niet gevonden.',
        'http-429' => 'Te veel pogingen. Probeer later opnieuw.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Iets ging fout. Probeer de pagina te vernieuwen.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Invalide mode opgegeven.',
        'standard_converts_only' => 'Er zijn geen scores beschikbaar voor de gevraagde mode voor deze beatmap difficulty.',
    ],
    'checkout' => [
        'generic' => 'Er is een fout opgetreden tijdens het voorbereiden voor het afrekenen.',
    ],
    'search' => [
        'default' => 'Kan geen resultaten krijgen, probeer het later opnieuw.',
        'operation_timeout_exception' => 'Zoeken is momenteel drukker dan gebruikelijk, probeer het later opnieuw.',
    ],

    'logged_out' => 'Je bent uitgelogd. Log in en probeer opnieuw.',
    'supporter_only' => 'Je moet een supporter zijn om dit te gebruiken.',
    'no_restricted_access' => 'Je mag dit niet doen terwijl je account de restricted status heeft.',
    'unknown' => 'Een onbekende fout trad op.',
];
