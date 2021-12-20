<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'beatmapset_discussion_qualified_problem' => 'vastaanota ilmoituksia uudesta ongelmasta seuraavien tilojen hyväksytyissä beatmapeissa',
        'beatmapset_disqualify' => 'vastaanota ilmoituksia kun beatmappeja hylätään seuraavista tiloista',
        'comment_reply' => 'vastaanota ilmoituksia vastauksista kommentteihisi',
        'title' => 'Ilmoitukset',
        'topic_auto_subscribe' => 'automaattisesti salli ilmoitukset uusille foorumiaiheille jotka luot',

        'options' => [
            '_' => 'toimitusvaihtoehdot',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'beatmapin modaus',
            'channel_message' => 'yksityisviestit',
            'comment_new' => 'uudet kommentit',
            'forum_topic_reply' => 'aihevastaus',
            'mail' => 'posti',
            'mapping' => '',
            'push' => 'push',
            'user_achievement_unlock' => 'käyttäjämitali avattu',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'valtuutetut clientit',
        'own_clients' => 'omat clientit',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => '',
        'beatmapset_title_show_original' => 'näytä beatmap-metadata alkuperäisellä kielellä',
        'title' => 'Asetukset',

        'beatmapset_download' => [
            '_' => 'oletus beatmap-lataus tyyppi',
            'all' => 'videon kanssa jos saatavilla',
            'direct' => 'avaa osu!directissä',
            'no_video' => 'ilman videota',
        ],
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
        'title' => 'Vahvistaminen on valmis',
    ],

    'verification_invalid' => [
        'title' => 'Kelvoton tai vanhentunut vahvistuslinkki
',
    ],
];
