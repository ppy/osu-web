<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'nastavenia',
        'username' => 'používateľské meno',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'resetovať',
            'rules' => 'Prosím uistite sa, že váš avatar sedí s :link.<br/>To znamená, že musí byť <strong>primeraný pre každý vek</strong>. To je žiadna nudita, vulgarizmy alebo sugestívny obsah.',
            'rules_link' => 'pravidlá komunity',
        ],

        'email' => [
            'new' => 'nový email',
            'new_confirmation' => 'potvrdenie emailu',
            'title' => 'Email',
            'locked' => [
                '_' => 'Prosím kontaktujte :accounts, ak potrebujete aktualizovať svoj email.',
                'accounts' => 'tím podpory pre účty',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => '',
        ],

        'password' => [
            'current' => 'aktuálne heslo',
            'new' => 'nové heslo',
            'new_confirmation' => 'potvrdenie hesla',
            'title' => 'Heslo',
        ],

        'profile' => [
            'country' => 'krajina',
            'title' => 'Profil',

            'country_change' => [
                '_' => "Zdá sa, že krajina vášho účtu nezodpovedá krajine vášho bydliska. :update_link.",
                'update_link' => 'Aktualizovať na :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'súčasná poloha',
                'user_interests' => 'záujmy',
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

    'github_user' => [
        'info' => "Ak ste prispievateľom do úložisiek s otvoreným zdrojovým kódom osu!, prepojenie účtu GitHub tu priradí vaše záznamy z denníku zmien k vášmu osu! profilu. Účty GitHub bez histórie príspevkov do osu! nemožno prepojiť.",
        'link' => 'Prepoj GitHub účet',
        'title' => 'GitHub',
        'unlink' => 'Preruš prepojenie GitHub účtu',

        'error' => [
            'already_linked' => 'Tento GitHub účet je už prepojený na iného užívateľa.',
            'no_contribution' => 'GitHub účet bez histórie príspevkov do úložisiek osu! nemožno prepojiť.',
            'unverified_email' => 'Prosím skontrolujte svoj primárny email v GitHub, potom skúste znova prepojiť svoj účet.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'dostávať notifikácie pre nové problémy na kvalifikovaných beatmapách pre následujúce módy',
        'beatmapset_disqualify' => 'prijímať upozornenia, keď sú beatmapy diskvalifikované z týchto módov',
        'comment_reply' => 'prijímať upozornenia pre odpovede na vaše komentáre',
        'title' => 'Oznámenia',
        'topic_auto_subscribe' => 'automaticky zapnúť notifikácie pre nové témy fóra, ktoré vytvoríte',

        'options' => [
            '_' => 'možnosti doručenia',
            'beatmap_owner_change' => 'obtiažnosť hosťa',
            'beatmapset:modding' => 'módovanie beatmáp',
            'channel_message' => 'správy súkromného chatu',
            'channel_team' => '',
            'comment_new' => 'nové komentáre
',
            'forum_topic_reply' => 'odpoveď na tému',
            'mail' => 'pošta',
            'mapping' => 'tvorca beatmapy',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autorizované klienty',
        'own_clients' => 'vlastné klienty',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'skryť varovania pre explicitný obsah v beatmapách',
        'beatmapset_title_show_original' => 'zobraziť metadáta beatmapy v originálnom jazyku',
        'title' => 'Možnosti',

        'beatmapset_download' => [
            '_' => 'predvolený typ sťahovania beatmáp',
            'all' => 's videom, ak je dostupné',
            'direct' => 'otvoriť v osu!direct',
            'no_video' => 'bez videa',
        ],
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
        'hide_online_info' => '',
        'title' => 'Súkromie',
    ],

    'security' => [
        'current_session' => 'aktuálne',
        'end_session' => 'Koniec relácie',
        'end_session_confirmation' => 'Toto okamžite ukončí reláciu na vybranom zariadení. Ste si istí?',
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

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => '',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => '',
            'set' => '',
        ],
    ],

    'verification_completed' => [
        'text' => 'Túto kartu/okno už môžete zatvoriť',
        'title' => 'Overenie bolo dokončené',
    ],

    'verification_invalid' => [
        'title' => 'Link vypršal alebo je neplatný',
    ],
];
