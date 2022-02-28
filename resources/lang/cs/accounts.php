<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'nastavení',
        'username' => 'uživatelské jméno',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Prosím ujistěte se, že Váš avatar dodržuje :link.<br/>To znamená, že musí být <strong>vhodný pro všechny věkové kategorie</strong>. Tj. žádný nahota či nenávistný obsah.',
            'rules_link' => 'pravidla komunity',
        ],

        'email' => [
            'current' => 'aktuální e-mail',
            'new' => 'nový e-mail',
            'new_confirmation' => 'ověření e-mailu',
            'title' => 'E-mail',
        ],

        'password' => [
            'current' => 'současné heslo',
            'new' => 'nové heslo',
            'new_confirmation' => 'potvrzení hesla',
            'title' => 'Heslo',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'současná poloha',
                'user_interests' => 'zájmy',
                'user_occ' => 'zaměstnání',
                'user_twitter' => '',
                'user_website' => 'webové stránky',
            ],
        ],

        'signature' => [
            'title' => 'Podpis',
            'update' => 'aktualizovat',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'dostávat oznámení na nové problémy u kvalifikovaných map u následujících módů',
        'beatmapset_disqualify' => 'dostávat notifikace kdy mapy následujících módů jsou diskvalifikované',
        'comment_reply' => 'dostávat notifikace na odpovědi na vaše komentáře',
        'title' => 'Oznámení',
        'topic_auto_subscribe' => 'automaticky povolit oznámení o nových tématech fóra, které vytvoříte',

        'options' => [
            '_' => 'možnosti doručení',
            'beatmap_owner_change' => 'obtížnost hosta',
            'beatmapset:modding' => 'módování beatmap',
            'channel_message' => 'soukromé zprávy',
            'comment_new' => 'nové komentáře',
            'forum_topic_reply' => 'odpověď v tématu',
            'mail' => 'e-mail',
            'mapping' => 'tvůrce beatmapy',
            'push' => 'push',
            'user_achievement_unlock' => 'odemčení nové medaile',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autorizovaní klienti',
        'own_clients' => 'vlastní klienti',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'skrýt varování před explicitním obsahem v beatmapách',
        'beatmapset_title_show_original' => 'zobrazovat metadata beatmap v původním jazyce',
        'title' => 'Možnosti',

        'beatmapset_download' => [
            '_' => 'výchozí typ stahování map',
            'all' => 's videem, je-li k dispozici',
            'direct' => 'otevřít v osu!direct',
            'no_video' => 'bez videa',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'klávesnice',
        'mouse' => 'myš',
        'tablet' => 'tablet',
        'title' => 'Styly hraní',
        'touch' => 'dotyk',
    ],

    'privacy' => [
        'friends_only' => 'blokovat soukromé zprávy od lidí, kteří nejsou v tvém seznamu přátel',
        'hide_online' => 'skrýt váš online status',
        'title' => 'Soukromí',
    ],

    'security' => [
        'current_session' => 'současná',
        'end_session' => 'Ukončit relaci',
        'end_session_confirmation' => 'Toto okamžitě ukončí vaši relaci na tom zařízení. Jste si jistý?',
        'last_active' => 'Naposledy aktivní:',
        'title' => 'Zabezpečení',
        'web_sessions' => 'webové relace',
    ],

    'update_email' => [
        'update' => 'aktualizovat',
    ],

    'update_password' => [
        'update' => 'aktualizovat',
    ],

    'verification_completed' => [
        'text' => 'Nyní můžete zavřít toto okno',
        'title' => 'Ověření bylo dokončeno',
    ],

    'verification_invalid' => [
        'title' => 'Neplatný odkaz ověření',
    ],
];
