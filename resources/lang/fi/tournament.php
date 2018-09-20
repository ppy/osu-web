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
        'none_running' => 'Turnauksia ei juuri nyt ole käynnissä, tarkista myöhemmin uudestaan!',
        'registration_period' => 'Rekisteröinti: :start:sta :end:een',

        'header' => [
            'subtitle' => 'Luettelo aktiivisista, virallisesti tunnustetuista turnauksista',
            'title' => 'Yhteisöturnaukset',
        ],

        'item' => [
            'registered' => 'Rekistöröityneet pelaajat',
        ],

        'state' => [
            'current' => 'Aktiiviset turnaukset',
            'previous' => 'Aikaisemmat turnaukset',
        ],
    ],

    'show' => [
        'banner' => 'Tue Joukkuettasi',
        'entered' => 'Olet rekisteröitynyt tähän turnaukseen.<br><br>Tämä ei tarkoita että olet sijoitettu joukkueeseen.<br><br>Lisäohjeet lähetetään sähköpostilla myöhemmin turnauspäivän lähestyessä, joten varmista että käyttäjäsi sähköpostiosoite on oikea!',
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
            'ended' => 'Tämä turnaus on loppunut. Tulokset löytyvät infosivulta.',
            'registration_closed' => 'Rekisteröinti tähän turnaukseen on loppunut. Tarkista infosivu pysyäksesi ajan tasalla.',
            'running' => 'Tämä turnaus on juuri nyt käynnissä. Lue tietosivulta lisätietoja.',
        ],
    ],
    'tournament_period' => ':start - :end',
];
