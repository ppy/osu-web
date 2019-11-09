<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'edit' => [
        'title' => '<strong>Fiókbeállítások</strong>',
        'title_compact' => 'beállítások',
        'username' => 'felhasználónév',

        'avatar' => [
            'title' => 'Avatár',
            'rules' => '',
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
    ],

    'oauth' => [
        'authorized_clients' => 'felhatalmazott kliensek',
        'own_clients' => '',
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
        'email_subject' => 'e-mail cím csere megerősítése',
        'update' => 'mentés',
    ],

    'update_password' => [
        'email_subject' => 'jelszó csere megerősítése',
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
