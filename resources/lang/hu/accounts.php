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
        'title' => '<strong>Fiókbeállítások</strong>',
        'title_compact' => 'beállítások',
        'username' => 'felhasználónév',

        'avatar' => [
            'title' => 'Avatár',
        ],

        'email' => [
            'current' => 'jelenlegi e-mail cím',
            'new' => 'új e-mail cím',
            'new_confirmation' => 'e-mail cím megerősítése',
            'title' => 'E-Mail',
        ],

        'password' => [
            'current' => 'jelenlegi jelszó',
            'new' => 'új jelszó',
            'new_confirmation' => 'jelszó megerősítése',
            'title' => 'Jelszó',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_from' => 'tartózkodási hely',
                'user_interests' => 'érdeklődés',
                'user_msnm' => 'skype',
                'user_occ' => 'foglalkozás',
                'user_twitter' => 'twitter',
                'user_website' => 'weboldal',
                'user_discord' => 'discord',
            ],
        ],

        'signature' => [
            'title' => 'Aláírás',
            'update' => 'mentés',
        ],
    ],

    'oauth' => [
        'title' => '',
        'authorized_clients' => '',
    ],

    'update_email' => [
        'email_subject' => 'e-mail cím csere megerősítése',
        'update' => 'mentés',
    ],

    'update_password' => [
        'email_subject' => 'jelszó csere megerősítése',
        'update' => 'mentés',
    ],

    'playstyles' => [
        'title' => 'Játékstílusok',
        'mouse' => 'egér',
        'keyboard' => 'billentyűzet',
        'tablet' => 'tablet',
        'touch' => 'érintőképernyő',
    ],

    'privacy' => [
        'title' => 'Adatvédelem',
        'friends_only' => 'privát üzenetek tiltása olyan személyektől, akik nincsenek a baráti listádon',
        'hide_online' => 'online állapot elrejtése',
    ],

    'notifications' => [
        'title' => 'Értesítések',
        'topic_auto_subscribe' => '',
    ],

    'security' => [
        'current_session' => 'jelenlegi',
        'end_session' => 'Munkamenet befejezése',
        'end_session_confirmation' => 'Ez azonnal befejezi a munkamenetet az eszközön. Biztos vagy benne?',
        'last_active' => 'Utoljára aktív:',
        'title' => 'Biztonság',
        'web_sessions' => 'webes munkamenetek',
    ],
];
