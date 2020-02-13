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
        'title_compact' => 'setări',
        'username' => 'nume de utilizator',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Te rog asigură-te că avatar-ul tău respectă :link<br/>Asta înseamnă că trebuie să fie <strong>adecvat pentru toate vârstele</strong>. Care să nu conțină nuditate, profanare sau conținut sugestiv.',
            'rules_link' => 'regulile comunității',
        ],

        'email' => [
            'current' => 'e-mail curent',
            'new' => 'e-mail nou',
            'new_confirmation' => 'confirmare e-mail',
            'title' => 'E-mail',
        ],

        'password' => [
            'current' => 'parola curentă',
            'new' => 'parolă nouă',
            'new_confirmation' => 'confirmare parolă',
            'title' => 'Parolă',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'locație curentă',
                'user_interests' => 'interese',
                'user_msnm' => '',
                'user_occ' => 'ocupație',
                'user_twitter' => '',
                'user_website' => 'site web',
            ],
        ],

        'signature' => [
            'title' => 'Semnătură',
            'update' => 'actualizează',
        ],
    ],

    'notifications' => [
        'title' => 'Notificări',
        'topic_auto_subscribe' => 'activați notificările automat pe noi topici de pe forum pe care le poți creea',
        'beatmapset_discussion_qualified_problem' => 'primește notificări pentru noi probleme pe hărți calificate de modelele următoare',

        'mail' => [
            '_' => 'primește notificări mail pentru',
            'beatmapset:modding' => 'modatul de beatmap',
            'forum_topic_reply' => 'răspunsul topic',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clienți autorizați',
        'own_clients' => 'deține Client',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'tastatură',
        'mouse' => 'mouse',
        'tablet' => 'tabletă',
        'title' => 'Stiluri de joc',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'Blochează mesajele private de la oameni care nu sunt pe lista ta de prieteni',
        'hide_online' => 'ascunde-ți prezența online',
        'title' => 'Confidențialitate',
    ],

    'security' => [
        'current_session' => 'curent',
        'end_session' => 'Încheie sesiunea',
        'end_session_confirmation' => 'Acest lucru iți va încheia imediat sesiunea pe acel dispozitiv. Ești sigur?',
        'last_active' => 'Ultima conectare:',
        'title' => 'Securitate',
        'web_sessions' => 'sesiuni web',
    ],

    'update_email' => [
        'update' => 'actualizează',
    ],

    'update_password' => [
        'update' => 'actualizează',
    ],

    'verification_completed' => [
        'text' => 'Poți închide această fereastră acum',
        'title' => 'Verificarea a fost finalizată',
    ],

    'verification_invalid' => [
        'title' => 'Link de verificare invalid sau expirat',
    ],
];
