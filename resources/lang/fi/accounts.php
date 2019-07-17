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
    'edit' => [
        'title' => '<strong>Tili</strong>asetukset',
        'title_compact' => 'asetukset',
        'username' => 'käyttäjätunnus',

        'avatar' => [
            'title' => 'Avatar',
        ],

        'email' => [
            'current' => 'nykyinen sähköpostiosoite',
            'new' => 'uusi sähköpostiosoite',
            'new_confirmation' => 'sähköpostivahvistus',
            'title' => 'Sähköposti',
        ],

        'password' => [
            'current' => 'nykyinen salasana',
            'new' => 'uusi salasana',
            'new_confirmation' => 'salasanan vahvistus',
            'title' => 'Salasana',
        ],

        'profile' => [
            'title' => 'Profiili',

            'user' => [
                'user_from' => 'nykyinen sijainti',
                'user_interests' => 'kiinnostukset',
                'user_msnm' => '',
                'user_occ' => 'ammatti',
                'user_twitter' => '',
                'user_website' => 'verkkosivu',
                'user_discord' => '',
            ],
        ],

        'signature' => [
            'title' => 'Allekirjoitus',
            'update' => 'päivitä',
        ],
    ],

    'oauth' => [
        'title' => '',
        'authorized_clients' => '',
    ],

    'update_email' => [
        'email_subject' => 'osu!-sähköpostin muutoksen vahvistaminen',
        'update' => 'päivitä',
    ],

    'update_password' => [
        'email_subject' => 'osu!-salasanan muutoksen vahvistaminen',
        'update' => 'päivitä',
    ],

    'playstyles' => [
        'title' => 'Pelityylit',
        'mouse' => 'hiiri',
        'keyboard' => 'näppäimistö',
        'tablet' => 'piirtopöytä',
        'touch' => 'kosketus',
    ],

    'privacy' => [
        'title' => 'Yksityisyys',
        'friends_only' => 'estä yksityisviestit henkilöiltä jotka eivät ole kaverilistallasi',
        'hide_online' => 'piilota online-tilasi',
    ],

    'notifications' => [
        'title' => 'Ilmoitukset',
        'topic_auto_subscribe' => '',
    ],

    'security' => [
        'current_session' => 'nykyinen',
        'end_session' => 'Sulje istunto',
        'end_session_confirmation' => 'Suljetaanko istuntosi kyseisellä laitteella?',
        'last_active' => 'Viimeksi aktiivisena',
        'title' => 'Turvallisuus',
        'web_sessions' => 'aktiiviset istunnot',
    ],
];
