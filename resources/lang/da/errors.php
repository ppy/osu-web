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
        'http-401' => 'Log venligst ind for at fortsætte.',
        'http-403' => 'Adgang nægtet.',
        'http-404' => 'Ikke fundet.',
        'http-429' => 'For mange forsøg. Prøv igen senere.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Der opstod en fejl. Prøv at genindlæse siden.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Ugyldig mode specificeret.',
        'standard_converts_only' => 'Ingen scores er tilgængelige for den anmodede mode på denne sværhedsgrad.',
    ],
    'checkout' => [
        'generic' => 'Der opstod en fejl under forberedelsen af ​​dit køb.',
    ],
    'search' => [
        'default' => 'Kunne ikke få resultater, prøv igen senere.',
        'operation_timeout_exception' => 'Søgemaskinen er i øjeblikket travlere end ellers, prøv igen senere.',
    ],

    'logged_out' => 'Du er blevet logget ud. Log venligst ind og prøv igen.',
    'supporter_only' => 'Du skal være osu!supporter for at kunne anvende denne funktion.',
    'no_restricted_access' => 'Du kan ikke udføre denne handling mens din konto er begrænset.',
    'unknown' => 'En ukendt fejl er opstået.',
];
