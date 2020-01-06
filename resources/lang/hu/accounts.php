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
        'title_compact' => 'beállítások',
        'username' => 'felhasználónév',

        'avatar' => [
            'title' => 'Avatár',
            'rules' => 'Kérjük, ellenőrizze, hogy az avatár illeszkedik-e ehhez :link.<br/>Ez azt jelenti, hogy <strong>minden korosztály számára alkalmasnak kell lennie</strong>. Vagyis nincs meztelenség, mások számára elfogadhatatlan vagy szuggesztív tartalom.',
            'rules_link' => 'a közösségi szabályok',
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
                'user_discord' => 'discord',
                'user_from' => 'tartózkodási hely',
                'user_interests' => 'érdeklődés',
                'user_msnm' => 'skype',
                'user_occ' => 'foglalkozás',
                'user_twitter' => 'twitter',
                'user_website' => 'weboldal',
            ],
        ],

        'signature' => [
            'title' => 'Aláírás',
            'update' => 'mentés',
        ],
    ],

    'notifications' => [
        'title' => 'Értesítések',
        'topic_auto_subscribe' => 'az általad létrehozott új fórum témák értesítéseinek automatikus bekapcsolása',
        'beatmapset_discussion_qualified_problem' => '',

        'mail' => [
            '_' => '',
            'beatmapset:modding' => '',
            'forum_topic_reply' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'felhatalmazott kliensek',
        'own_clients' => 'külső alkalmazások',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'billentyűzet',
        'mouse' => 'egér',
        'tablet' => 'tablet',
        'title' => 'Játékstílusok',
        'touch' => 'érintőképernyő',
    ],

    'privacy' => [
        'friends_only' => 'privát üzenetek tiltása olyan személyektől, akik nincsenek a baráti listádon',
        'hide_online' => 'online állapot elrejtése',
        'title' => 'Adatvédelem',
    ],

    'security' => [
        'current_session' => 'jelenlegi',
        'end_session' => 'Munkamenet befejezése',
        'end_session_confirmation' => 'Ez azonnal befejezi a munkamenetet az eszközön. Biztos vagy benne?',
        'last_active' => 'Utoljára aktív:',
        'title' => 'Biztonság',
        'web_sessions' => 'webes munkamenetek',
    ],

    'update_email' => [
        'update' => 'mentés',
    ],

    'update_password' => [
        'update' => 'mentés',
    ],

    'verification_completed' => [
        'text' => 'Mostmár bezárhatod ezt az oldalt',
        'title' => 'Az ellenőrzés befejeződött',
    ],

    'verification_invalid' => [
        'title' => 'Érvénytelen vagy lejárt ellenőrző link',
    ],
];
