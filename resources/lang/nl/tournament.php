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
            'subtitle' => 'Een lijst van actieve, officieel erkende tournooien',
            'title' => '',
        ],
        'none_running' => 'Momenteel zijn er geen toernooien bezig, Kijk later nog eens!',
        'registration_period' => 'Registratie: :start tot :end',
    ],

    'show' => [
        'banner' => 'Ondersteun jouw team',
        'entered' => 'Je bent ingeschreven voor dit toernooi.<br><br>Houd in gedachte dat dit niet betekent dat je voor een team bent toebedeeld.<br><br>Verdere instructies zullen via e-mail worden verzonden dichter bij de toernooidatum, dus zorg er voor dat het e-mailadres dat gelinkt is aan je osu! account geldig is!',
        'info_page' => 'Informatie pagina',
        'login_to_register' => '',
        'not_yet_entered' => 'U bent niet geregistreerd voor dit toernooi.',
        'rank_too_low' => 'Sorry, je voldoet niet aan de rangvereisten voor dit toernooi!',
        'registration_ends' => 'Registratie gesloten op :date',

        'button' => [
            'cancel' => 'Annuleer registratie',
            'register' => 'Schrijf me in!',
        ],

        'state' => [
            'before_registration' => 'Registratie voor dit toernooi is nog niet begonnen.',
            'ended' => '',
            'registration_closed' => '',
            'running' => '',
        ],
    ],
    'tournament_period' => ':start tot :end',
];
