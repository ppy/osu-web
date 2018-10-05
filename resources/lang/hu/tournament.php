<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'index' => [
        'none_running' => 'Jelenleg nincs futó bajnokság, nézz vissza később!',
        'registration_period' => 'Regisztráció: :start a :end -ig',

        'header' => [
            'subtitle' => 'Az aktív, hivatalosan elismert tornák listája',
            'title' => 'Közösségi versenyek',
        ],

        'item' => [
            'registered' => 'Regisztrált játékosok',
        ],

        'state' => [
            'current' => 'Aktív versenyek',
            'previous' => 'Korábbi versenyek',
        ],
    ],

    'show' => [
        'banner' => 'Támogasd A Csapatod',
        'entered' => 'Regisztrálva vagy erre a versenyre.<br><br>Ne feledd, hogy ez nem azt jelenti, hogy csapatba kerültél.<br><br>A további tennivalókat e-mailben fogjuk küldeni a verseny dátumához közelítve, szóval kérlek ellenőrizd, hogy az osu! fiókodhoz tartozó email érvényes!',
        'info_page' => 'Információs oldal',
        'login_to_register' => 'Kérlek :login a regisztrációs adatok megtekintéséhez!',
        'not_yet_entered' => 'Nem vagy regisztrálva erre a versenyre.',
        'rank_too_low' => 'Sajnáljuk, de te nem éred el a rang követelményeket ehhez a versenyhez!',
        'registration_ends' => 'A regisztráció ekkor zárul :date',

        'button' => [
            'cancel' => 'Regisztráció visszavonása',
            'register' => 'Regisztrálj engem!',
        ],

        'state' => [
            'before_registration' => 'A versenyre való regisztrálás még nem nyílt meg.',
            'ended' => 'Ez a verseny véget ért. Nézd meg az információs oldalt az eredményekért.',
            'registration_closed' => 'A versenyre való regisztrálás lezárult. Nézd meg az információs oldalt a legújabb hírekért.',
            'running' => 'Ez a verseny jelenleg zajlik. Részletekért nézd meg az információs oldalt.',
        ],
    ],
    'tournament_period' => ':start a :end',
];
