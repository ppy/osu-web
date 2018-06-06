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
            'subtitle' => 'Luettelo aktiivisista, virallisesti tunnustetuista turnauksista',
            'title' => 'Yhteisöturnaukset',
        ],
        'none_running' => 'Ei turnauksia käynnissä juuri nyt, tarkista myöhemmin uudelleen!',
        'registration_period' => 'Rekisteröinti: :start:sta :end:een',

        'state' => [
            'current' => 'Aktiiviset turnaukset',
            'previous' => 'Aikaisemmat turnaukset',
        ],
    ],

    'show' => [
        'banner' => 'Tue Joukkuettasi',
        'entered' => 'Olet rekisteröitynyt tähän turnaukseen.<br><br>Huomaa, että tämä ei tarkoita, että olet asetettuna joukkueeseen.<br><br>Saat enemmän ohjeita sähköpostitse lähempänä turnauksen alkamista, joten varmista, että osu!-tilisi sähköpostitili pitää paikkansa!',
        'info_page' => 'Tietosivu',
        'login_to_register' => 'Ole ystävällinen ja :login nähdäksesi yksityiskohtia rekisteröitymiselle!',
        'not_yet_entered' => 'Et ole rekisteröitynyt tähän turnaukseen.',
        'rank_too_low' => 'Anteeksi, mutta et täytä tämän turnauksen sijoitusvaatimuksia!',
        'registration_ends' => 'Rekisteröityminen sulkeutuu :date',

        'button' => [
            'cancel' => 'Peru Rekisteröityminen',
            'register' => 'Lisää minut mukaan!',
        ],

        'state' => [
            'before_registration' => 'Tähän turnaukseen rekisteröityminen ei ole vielä alkanut.',
            'ended' => 'Tämä turnaus on loppunut. Tarkista tietosivu tuloksien näkemiseksi.',
            'registration_closed' => 'Tämän turnauksen rekisteröitymisaika on loppunut. Viimeaikaisten päivitysten tarkistamiseksi, tarkista tietosivu.',
            'running' => 'Tämä turnaus on juuri nyt käynnissä. Lue tietosivulta lisätietoja.',
        ],
    ],
    'tournament_period' => ':start - :end',
];
