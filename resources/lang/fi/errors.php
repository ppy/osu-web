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
        'http-401' => 'Kirjaudu sisään jatkaaksesi.',
        'http-403' => 'Pääsy evätty.',
        'http-404' => 'Ei löytynyt.',
        'http-429' => 'Liian monta kirjautumisyritystä, yritä uudelleen myöhemmin.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Virhe. Yritä päivittää sivu.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Virheellinen pelimoodi annettu.',
        'standard_converts_only' => 'Tuloksia valitulle pelimuodolle ei löydy tässä vaikeustasossa.',
    ],
    'checkout' => [
        'generic' => 'Ostoksesi valmistelussa tapahtui virhe.',
    ],
    'search' => [
        'default' => '',
        'operation_timeout_exception' => '',
    ],

    'logged_out' => 'Sinut on kirjattu ulos. Kirjaudu sisään ja yritä uudelleen.',
    'supporter_only' => 'Sinun täytyy olla Tukija käyttääksesi tätä ominaisuutta.',
    'no_restricted_access' => 'Et voi suorittaa tätä toimintoa tilisi ollessa rajoitetussa tilassa.',
    'unknown' => 'Tuntematon virhe.',
];
