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
        'title_compact' => 'asetukset',
        'username' => 'käyttäjätunnus',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Pidä huoli, että avatari ei riko :link.<br/>Tämä tarkoittaa sitä, että kuvan on <strong>sovittava kaikenikäisille</strong>, eli ei alastomuutta tai muita hävyttömyyksiä.',
            'rules_link' => 'yhteisön sääntöjä',
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
                'user_discord' => '',
                'user_from' => 'nykyinen sijainti',
                'user_interests' => 'kiinnostukset',
                'user_msnm' => '',
                'user_occ' => 'ammatti',
                'user_twitter' => '',
                'user_website' => 'verkkosivu',
            ],
        ],

        'signature' => [
            'title' => 'Allekirjoitus',
            'update' => 'päivitä',
        ],
    ],

    'notifications' => [
        'title' => 'Ilmoitukset',
        'topic_auto_subscribe' => '',
        'beatmapset_discussion_qualified_problem' => '',

        'mail' => [
            '_' => '',
            'beatmapset:modding' => '',
            'forum_topic_reply' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '',
        'own_clients' => '',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'näppäimistö',
        'mouse' => 'hiiri',
        'tablet' => 'piirtopöytä',
        'title' => 'Pelityylit',
        'touch' => 'kosketus',
    ],

    'privacy' => [
        'friends_only' => 'estä yksityisviestit henkilöiltä jotka eivät ole kaverilistallasi',
        'hide_online' => 'piilota online-tilasi',
        'title' => 'Yksityisyys',
    ],

    'security' => [
        'current_session' => 'nykyinen',
        'end_session' => 'Sulje istunto',
        'end_session_confirmation' => 'Suljetaanko istuntosi kyseisellä laitteella?',
        'last_active' => 'Viimeksi aktiivisena',
        'title' => 'Turvallisuus',
        'web_sessions' => 'aktiiviset istunnot',
    ],

    'update_email' => [
        'update' => 'päivitä',
    ],

    'update_password' => [
        'update' => 'päivitä',
    ],

    'verification_completed' => [
        'text' => 'Tämän välilehden/ikkunan voi nyt sulkea',
        'title' => '',
    ],

    'verification_invalid' => [
        'title' => '',
    ],
];
