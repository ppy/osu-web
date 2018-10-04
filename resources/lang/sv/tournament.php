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
        'none_running' => 'Det finns inga pågående turneringar just nu, var vänlig kolla igen senare!',
        'registration_period' => 'Registrering: :start till :end',

        'header' => [
            'subtitle' => 'En lista av aktiva, officiella turneringar',
            'title' => 'Gemenskapsturneringar',
        ],

        'item' => [
            'registered' => 'Registrerade spelare',
        ],

        'state' => [
            'current' => 'Aktiva Turneringar',
            'previous' => 'Tidigare Turneringar',
        ],
    ],

    'show' => [
        'banner' => 'Stöd ditt lag',
        'entered' => 'Du är registrerad för denna turnering.<br><br>Notera att detta betyder inte att du har blivit tilldelad ett lag.<br><br>Ytterligare instruktioner kommer att skickas till dig via e-post när datumet för turneringen närmar sig, så var vänlig att kontrollera att din e-postadress för ditt osu!-konto är korrekt!',
        'info_page' => 'Information',
        'login_to_register' => 'Var vänlig :login för att visa registreringsdetaljer!',
        'not_yet_entered' => 'Du är inte registrerad för denna turnering.',
        'rank_too_low' => 'Tyvärr, men du möter inte kraven på rank för denna turnering!',
        'registration_ends' => 'Registrering stänger :date',

        'button' => [
            'cancel' => 'Avbryt Registrering',
            'register' => 'Skriv upp mig!',
        ],

        'state' => [
            'before_registration' => 'Registrering för denna turnering har inte öppnats ännu.',
            'ended' => 'Denna turnering har avslutats. Kontrollera informationssidan för resultaten.',
            'registration_closed' => 'Registrering för denna turnering har stängts. Kontrollera informationssidan för de senaste uppdateringarna.',
            'running' => 'Denna turnering pågår för närvarande. Kontrollera informationssidan för mer information.',
        ],
    ],
    'tournament_period' => ':start till :end',
];
