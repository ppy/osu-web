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
    'index' => [
        'none_running' => 'Det er ingen turneringer som pågår for øyeblikket, vennligst sjekk tilbake senere!',
        'registration_period' => 'Registrering: :start til :end',

        'header' => [
            'title' => 'Fellesskapsturnering',
        ],

        'item' => [
            'registered' => 'Registrerte spillere',
        ],

        'state' => [
            'current' => 'Aktive Turneringer',
            'previous' => 'Tidligere Turneringer',
        ],
    ],

    'show' => [
        'banner' => 'Støtt laget ditt',
        'entered' => 'Du er registret for denne turneringen.<br><br>Merk at dette betyr <b>ikke</b> at du har blitt tildelt et lag.<br><br>Videre instruksjoner vil bli sendt til deg via e-post når vi nærmer oss starten på turneringen, så vennligst kontroller at osu! e-mailen din er gyldig!',
        'info_page' => 'Informasjonsside',
        'login_to_register' => 'Vennligst :login for å se registreringsdetaljene!',
        'not_yet_entered' => 'Du er ikke registret for denne turneringen.',
        'rank_too_low' => 'Beklager, men du møter ikke rangeringskravene for denne turneringen!',
        'registration_ends' => 'Registreringer lukkes på den :date',

        'button' => [
            'cancel' => 'Avbryt Registrering',
            'register' => 'Registrer meg!',
        ],

        'period' => [
            'end' => '',
            'start' => '',
        ],

        'state' => [
            'before_registration' => 'Registrering for denne turneringen har enda ikke åpnet.',
            'ended' => 'Denne turneringen har konkludert. Sjekk informasjonssiden for resultater.',
            'registration_closed' => 'Registreringen for denne turneringen er lukket. Sjekk informasjonssiden for de siste oppdateringene.',
            'running' => 'Denne turneringen pågår. Sjekk informasjonssiden for flere detaljer.',
        ],
    ],
    'tournament_period' => ':start til :end',
];
