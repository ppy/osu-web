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
        'title_compact' => 'nastavenia',
        'username' => 'používateľské meno',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Prosím uistite sa že váš avatar sedí s :link.<br/>Toto znamená že musí byť <strong>primeraný pre každý vek</strong>. to znamená žiadna nudita, vulgarizmy alebo sugestívny obsah.',
            'rules_link' => 'pravidlá komunity',
        ],

        'email' => [
            'current' => 'aktuálny email',
            'new' => 'nový email',
            'new_confirmation' => 'potvrdenie emailu',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'aktuálne heslo',
            'new' => 'nové heslo',
            'new_confirmation' => 'potvrdenie hesla',
            'title' => 'Heslo',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'súčasná poloha',
                'user_interests' => 'záujmy',
                'user_msnm' => '',
                'user_occ' => 'povolanie',
                'user_twitter' => '',
                'user_website' => 'webstránka',
            ],
        ],

        'signature' => [
            'title' => 'Podpis',
            'update' => 'aktualizovať',
        ],
    ],

    'notifications' => [
        'title' => 'Oznámenia',
        'topic_auto_subscribe' => 'automaticky zapnúť notifikácie pre nové fórove témy ktoré vytvoríte',
        'beatmapset_discussion_qualified_problem' => 'dostávať notifikácie pre nové problémy na kvalifikovaných beatmapách pre následujúce módy',

        'mail' => [
            '_' => 'dostávať mailové oznámenia o',
            'beatmapset:modding' => 'módovanie beatmáp',
            'forum_topic_reply' => 'odpovede na tému',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autorizované klienty',
        'own_clients' => 'vlastné klienty',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'klávesnica',
        'mouse' => 'myš',
        'tablet' => 'tablet',
        'title' => 'Štýly hrania',
        'touch' => 'dotyk',
    ],

    'privacy' => [
        'friends_only' => 'blokovať súkromné správy od osôb mimo vášho zoznamu priateľov',
        'hide_online' => 'skryť online status',
        'title' => 'Súkromie',
    ],

    'security' => [
        'current_session' => 'aktuálne',
        'end_session' => 'Koniec relácie',
        'end_session_confirmation' => 'Toto okamžite vypne reláciu na vybranom zariadení. Ste si istí?',
        'last_active' => 'Naposledy aktívny:',
        'title' => 'Zabezpečenie',
        'web_sessions' => 'webové relácie',
    ],

    'update_email' => [
        'update' => 'aktualizovať',
    ],

    'update_password' => [
        'update' => 'aktualizovať',
    ],

    'verification_completed' => [
        'text' => 'Už môžete túto kartu/okno zatvoriť',
        'title' => 'Overenie bolo dokončené',
    ],

    'verification_invalid' => [
        'title' => 'Link už vypršal alebo je neplatný',
    ],
];
