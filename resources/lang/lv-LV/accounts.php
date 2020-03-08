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
        'title_compact' => 'iestatījumi',
        'username' => 'lietotājvārds',

        'avatar' => [
            'title' => 'Profila attēls',
            'rules' => 'Lūgums nodrošināt savu profila attēlu, vadoties pēc :link.<br/>Tas nozīmē, ka attēlam jābūt <strong> atbilstošam jebkuram vecumam</strong>, kas nedrīkstētu iekļaut kailumus, necenzētu valodu vai saturu ieteikšanu.',
            'rules_link' => 'kopienas noteikumi',
        ],

        'email' => [
            'current' => 'pašreizējais e-pasts',
            'new' => 'jauns e-pasts',
            'new_confirmation' => 'e-pasta apstiprinājums',
            'title' => 'E-pasta adrese',
        ],

        'password' => [
            'current' => 'pašreizējā parole',
            'new' => 'jaunā parole',
            'new_confirmation' => 'paroles apstiprinājums',
            'title' => 'Parole',
        ],

        'profile' => [
            'title' => 'Profils',

            'user' => [
                'user_discord' => '',
                'user_from' => 'pašreizējā atrašanās vieta',
                'user_interests' => 'intereses',
                'user_msnm' => '',
                'user_occ' => 'nodarbošanās',
                'user_twitter' => '',
                'user_website' => 'tīmekļa vietne',
            ],
        ],

        'signature' => [
            'title' => 'Paraksts',
            'update' => 'atjaunināt',
        ],
    ],

    'notifications' => [
        'title' => 'Paziņojumi',
        'topic_auto_subscribe' => 'automātiski ieslēgt paziņojumus foruma tematiem, kurus esiet izveidojis',
        'beatmapset_discussion_qualified_problem' => 'saņemt paziņojumus par jaunu problēmu kvalificētām bītmapēm ar šādiem režīmiem',

        'mail' => [
            '_' => '',
            'beatmapset:modding' => '',
            'forum_topic_reply' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autorizētie klienti',
        'own_clients' => 'piederošie klienti',
        'title' => 'OAutoriz',
    ],

    'playstyles' => [
        'keyboard' => 'tastatūra',
        'mouse' => 'pele',
        'tablet' => 'grafiskā planšete',
        'title' => 'Spēlēšanās stili',
        'touch' => 'skārienjūtīgais ekrāns',
    ],

    'privacy' => [
        'friends_only' => 'bloķēt privātās ziņas no cilvēkiem, kuri nav jūsu draugu sarakstā',
        'hide_online' => 'slēpt jūsu tiešsaistes klātbūtni',
        'title' => 'Konfidencialitāte',
    ],

    'security' => [
        'current_session' => 'Pašreizējais',
        'end_session' => 'Beigt sesiju',
        'end_session_confirmation' => 'Šis beigs jūsu sesiju uz šo ierīci. Vai esat pārliecināts?',
        'last_active' => 'Pēdējais aktīvs:',
        'title' => 'Drošība',
        'web_sessions' => 'tīmekļa sesijas',
    ],

    'update_email' => [
        'update' => 'atjaunināt',
    ],

    'update_password' => [
        'update' => 'atjaunināt',
    ],

    'verification_completed' => [
        'text' => 'Tagad jūs variet aizvērt šo cilni/logu',
        'title' => 'Pārbaude pabeigta',
    ],

    'verification_invalid' => [
        'title' => 'Nederīga vai novecojusi pārbaudes saite',
    ],
];
