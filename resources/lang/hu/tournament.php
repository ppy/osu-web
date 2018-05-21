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
        'header' => [
            'subtitle' => 'Az aktív, hivatalosan elismert tornák listája',
            'title' => 'Közösségi versenyek',
        ],
        'none_running' => 'Jelenleg egyetlen verseny sincs, nézz vissza később!',
        'registration_period' => 'Regisztráció: :start a :end -ig',

        'state' => [
            'current' => '',
            'previous' => '',
        ],
    ],

    'show' => [
        'banner' => 'Támogasd A Csapatod',
        'entered' => 'Regisztrálva vagy erre a versenyre.<br><br>Ez nem azt jelenti, hogy egy csapatba elhelyeztünk.<br><br>További tennivalókat emailben küldjük a verseny dátumához közelítve, szóval kérlek biztosítalsd, hogy az osu! Fiókodhoz tartozó email valós!',
        'info_page' => 'Információs oldal',
        'login_to_register' => 'Kérlek :login a regisztrációs adatok megtekintéséhez!',
        'not_yet_entered' => 'Nem vagy regisztrálva erre a versenyre.',
        'rank_too_low' => 'Bocsi, de te nem éred el a rank követelményeket ehhez a versenyhez!',
        'registration_ends' => 'A regisztrációk :date-án/én zárulnak',

        'button' => [
            'cancel' => 'Regisztráció megszakitása',
            'register' => 'Regisztrálj engem!',
        ],

        'state' => [
            'before_registration' => 'A versenyre való regisztráció még nem nyílt meg.',
            'ended' => 'Ez a verseny véget ért. Nézd meg az információs oldalt az eredményekért.',
            'registration_closed' => 'Erre a versenyre való regisztráció zárolva lett. Nézd meg az információs oldalt a legfrissebb frissitésekért.',
            'running' => 'Ez a verseny jelenleg zajlik. Részletekért nézd meg az információs oldalt.',
        ],
    ],
    'tournament_period' => ':start a :end',
];
