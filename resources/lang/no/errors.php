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
        'http-401' => 'Vennligst logg inn for å fortsette.',
        'http-403' => 'Ingen tillatelse.',
        'http-404' => 'Fantes ikke.',
        'http-429' => 'For mange forsøk. Prøv igjen senere.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'En feil oppstod. Prøv å oppdatere siden.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Ugyldig spillmodus angitt.',
        'standard_converts_only' => 'Ingen spillforsøk på dette beatmappet er tilgjengelig for den forespurte spillmodusen på denne vanskelighetsgraden.',
    ],
    'checkout' => [
        'generic' => 'En feil oppstod under klargjøring av kjøpet ditt.',
    ],
    'search' => [
        'default' => 'Kunne ikke hente noen treff. Prøv igjen senere.',
        'operation_timeout_exception' => 'Søkefunksjonen ser ikke ut til å fungere akkurat nå. Prøv igjen senere.',
    ],

    'logged_out' => 'Du har blitt logget ut. Vennligst logg inn og prøv på nytt.',
    'supporter_only' => 'Du må være en osu!supporter for å bruke denne funksjonen.',
    'no_restricted_access' => 'Du kan ikke utføre denne handlingen mens kontoen din er i begrenset tilstand.',
    'unknown' => 'En ukjent feil har oppstått.',
];
