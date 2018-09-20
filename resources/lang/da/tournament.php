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
        'none_running' => 'Der er ingen turneringer, som kører i øjeblikket. Kig forbi senere!',
        'registration_period' => 'Tilmelding: :start til :end',

        'header' => [
            'subtitle' => 'En liste over alle aktive officielle turneringer',
            'title' => 'Fællesskabsturnerninger',
        ],

        'item' => [
            'registered' => 'Registrerede spillere',
        ],

        'state' => [
            'current' => 'Aktive Turneringer',
            'previous' => 'Tidligere Turneringer',
        ],
    ],

    'show' => [
        'banner' => '',
        'entered' => 'Du er nu tilmeldt turneringen.<br><br>Vær opmærksom på, at dette ikke betyder, at du skal være tilmeldt et hold..<br><br>Mere info vil blive sendt til dig på din email-adresse, så vær venligst sikker på, at din kontos email-adresse er gyldig!',
        'info_page' => 'Informationsside',
        'login_to_register' => 'Vær venlig at :login for at se tilmeldingsinformation!',
        'not_yet_entered' => 'Du er ikke tilmeldt denne turnering.',
        'rank_too_low' => 'Beklager, du opfylder ikke rang kravene til denne turnering!',
        'registration_ends' => 'Tilmelding lukker på :date',

        'button' => [
            'cancel' => 'Annullér tilmelding',
            'register' => 'Tilmeld mig!',
        ],

        'state' => [
            'before_registration' => 'Registrering til denne turnering er ikke åbnet endnu.',
            'ended' => 'Denne turnering er konkluderet. Tjek informationssiden for resultater.',
            'registration_closed' => 'Registrering til denne turnering er lukket. Tjek informationssiden for seneste opdateringer.',
            'running' => '',
        ],
    ],
    'tournament_period' => ':start til :end',
];
