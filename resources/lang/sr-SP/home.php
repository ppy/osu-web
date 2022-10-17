<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Преузмите сада',
        'online' => '<strong>:players</strong> тренутно у <strong>:games</strong> игара',
        'peak' => 'Врх, :count онлајн играча',
        'players' => '<strong>:count</strong> регистрованих играча',
        'title' => 'добродошли',
        'see_more_news' => 'погледајте још догађаја',

        'slogan' => [
            'main' => 'најбоља free-to-win ритмичка игрица',
            'sub' => 'ритам је увек удаљен за 1 клик',
        ],
    ],

    'search' => [
        'advanced_link' => 'Напредна претрага',
        'button' => 'Претрага',
        'empty_result' => 'Нема резултата!',
        'keyword_required' => 'Потребна је кључна реч за претрагу',
        'placeholder' => 'куцајте за претрагу',
        'title' => 'претрага',

        'beatmapset' => [
            'login_required' => 'Пријавите се да тражите мапе',
            'more' => ':count додатних резултата за мапе',
            'more_simple' => 'Видите још резултата за мапе',
            'title' => 'Мапе',
        ],

        'forum_post' => [
            'all' => 'Сви форуми',
            'link' => 'Тражите на форуму',
            'login_required' => 'Пријавите се да тражите на форуму',
            'more_simple' => 'Видите још резултата за форум',
            'title' => 'Форум',

            'label' => [
                'forum' => 'тражите на форуму',
                'forum_children' => 'укључујући субфоруме',
                'topic_id' => 'тема #',
                'username' => 'аутор',
            ],
        ],

        'mode' => [
            'all' => 'све',
            'beatmapset' => 'мапа',
            'forum_post' => 'форум',
            'user' => 'играч',
            'wiki_page' => 'вики',
        ],

        'user' => [
            'login_required' => 'Пријавите се да тражите играче',
            'more' => ':count додатних резултата за играче',
            'more_simple' => 'Видите још резултата за мапе',
            'more_hidden' => 'Тражење играча је ограничено на :max. Пробајте да побољшате Вашу претрагу.',
            'title' => 'Играчи',
        ],

        'wiki_page' => [
            'link' => 'Претражите вики',
            'more_simple' => 'Видите још резултата за вики',
            'title' => 'Вики',
        ],
    ],

    'download' => [
        'tagline' => "Почнимо!",
        'action' => 'Преузмите osu!',

        'help' => [
            '_' => 'ако имате проблем са отварањем игрице или регистрације налога, :help_forum_link или :support_button.',
            'help_forum_link' => 'проверите форум за помоћ',
            'support_button' => 'контактирајте подршку',
        ],

        'os' => [
            'windows' => 'за Windows',
            'macos' => 'за macOS',
            'linux' => 'за Linux',
        ],
        'mirror' => 'алтернативни линк',
        'macos-fallback' => 'macOS корисници',
        'steps' => [
            'register' => [
                'title' => 'направите налог',
                'description' => 'пратите упутства када отворите игрицу да би сте се пријавили или направили нови налог',
            ],
            'download' => [
                'title' => 'инсталирајте игрицу',
                'description' => 'кликните дугме изнад да преузмете инсталацију, и онда га покрените!',
            ],
            'beatmaps' => [
                'title' => 'преузмите мапе',
                'description' => [
                    '_' => ':browse велику библиотеку мапа направљених од стране корисника и крените да играте!',
                    'browse' => 'претражи',
                ],
            ],
        ],
        'video-guide' => 'видео водич',
    ],

    'user' => [
        'title' => 'командна табла',
        'news' => [
            'title' => 'Новости',
            'error' => 'Грешка у учитавању вести, пробајте да освежите страницу?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Онлајн Пријатељи',
                'games' => 'Игре',
                'online' => 'Онлајн Корисника',
            ],
        ],
        'beatmaps' => [
            'new' => 'Нове рангиране мапе',
            'popular' => 'Популарне мапе',
            'by_user' => 'од корисника :user
',
        ],
        'buttons' => [
            'download' => 'Преузмите osu!',
            'support' => 'Подржите osu!',
            'store' => 'osu!продавница',
        ],
    ],
];
