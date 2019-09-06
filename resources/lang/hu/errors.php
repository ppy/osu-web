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
        'http-401' => 'Kérlek jelentkezz be a folytatáshoz.',
        'http-403' => 'Hozzáférés megtagadva.',
        'http-404' => 'Nem található.',
        'http-429' => 'Túl sok próbálkozás. Próbáld újra később.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Hiba történt. Próbáld frissiteni az oldalt.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Érvénytelen mód lett megadva.',
        'standard_converts_only' => 'Nincs elérhető eredmény a kért módra ezen a beatmap nehézségen.',
    ],
    'checkout' => [
        'generic' => 'Hiba történt a fizetés előkészítése közben.',
    ],
    'search' => [
        'default' => '',
        'operation_timeout_exception' => '',
    ],

    'logged_out' => 'Ki lettél léptetve. Kérlek lépj be és próbáld újra.',
    'supporter_only' => 'Támogatónak kell lenned a funkció használatához.',
    'no_restricted_access' => 'Felfüggesztett állapot erre nem vagy alkalmas.',
    'unknown' => 'Ismeretlen hiba történt.',
];
