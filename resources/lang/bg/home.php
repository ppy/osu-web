<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Изтегли сега',
        'online' => '<strong>:players</strong> сега са онлайн в общо <strong>:games</strong> игри',
        'peak' => 'Най-много за последните 24 часа: :count онлайн',
        'players' => '<strong>:count</strong> регистрирани играчи',
        'title' => 'добре дошли',
        'see_more_news' => 'виж повече новини',

        'slogan' => [
            'main' => 'най-добрата безплатна ритъм игра',
            'sub' => 'ритъмът е само на клик от вас',
        ],
    ],

    'search' => [
        'advanced_link' => 'Разширено търсене',
        'button' => 'Търсене',
        'empty_result' => 'Нищо не бе открито!',
        'keyword_required' => 'Необходима е ключова дума за търсене',
        'placeholder' => 'Пишете тук за търсене…',
        'title' => 'Търсене',

        'beatmapset' => [
            'login_required' => 'Моля, влез в профила си, за търсене на бийтмап',
            'more' => 'още :count бийтмап резултата от търсенето',
            'more_simple' => 'Виж повече резултати за бийтмапове',
            'title' => 'Бийтмапове',
        ],

        'forum_post' => [
            'all' => 'Всички форуми',
            'link' => 'Търси във форум',
            'login_required' => 'Моля, влез в профила си, за търсене във форум',
            'more_simple' => 'Виж повече резултати от форум',
            'title' => 'Форум',

            'label' => [
                'forum' => 'търси във форум',
                'forum_children' => 'включи и подфоруми',
                'topic_id' => 'тема #',
                'username' => 'автор',
            ],
        ],

        'mode' => [
            'all' => 'всички',
            'beatmapset' => 'бийтмапове',
            'forum_post' => 'форум',
            'user' => 'играч',
            'wiki_page' => 'osu!wiki',
        ],

        'user' => [
            'login_required' => 'Моля, влез в профила си, за търсене на потребител',
            'more' => 'още :count резултата за играчи от търсенето',
            'more_simple' => 'Виж повече резултати за играчи',
            'more_hidden' => 'Търсенето на играчи е ограничено до :max играчи. Опитайте да доусъвършенствате заявката за търсене.',
            'title' => 'Играчи',
        ],

        'wiki_page' => [
            'link' => 'Търси в wiki',
            'more_simple' => 'Виж повече резултати от wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "нека ви помогнем<br>
да започнете!",
        'action' => 'Изтегли osu!',

        'help' => [
            '_' => 'при проблем със стартиране на играта или регистриране на профил, посетете :help_forum_link или :support_button.',
            'help_forum_link' => 'форум за помощ',
            'support_button' => 'се свържете с поддръжка',
        ],

        'os' => [
            'windows' => 'за Windows',
            'macos' => 'за macOS',
            'linux' => 'за Linux',
        ],
        'mirror' => 'алтернативна връзка',
        'macos-fallback' => 'macOS потребители',
        'steps' => [
            'register' => [
                'title' => 'създай акаунт',
                'description' => 'следвай указанията при стартиране на играта, за вход или създаване на нов профил',
            ],
            'download' => [
                'title' => 'изтегли играта',
                'description' => 'кликни върху бутона горе за изтегляне на инсталиращата програма, след това я стартирай!',
            ],
            'beatmaps' => [
                'title' => 'изтегли бийтмапове',
                'description' => [
                    '_' => ':browse огромната библиотека с бийтмапове, създадени от нашите играчи, и играйте!',
                    'browse' => 'разгледай',
                ],
            ],
        ],
        'video-guide' => 'видео ръководство',
    ],

    'user' => [
        'title' => 'главно табло',
        'news' => [
            'title' => 'Новини',
            'error' => 'Грешка при зареждане на новините, пробвайте с презареждане на страницата?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Приятели онлайн',
                'games' => 'Общо игри',
                'online' => 'Потребители онлайн',
            ],
        ],
        'beatmaps' => [
            'new' => 'Наскоро класирани бийтмапове',
            'popular' => 'Популярни бийтмапове',
            'by_user' => 'от :user',
        ],
        'buttons' => [
            'download' => 'Изтегли osu!',
            'support' => 'Подкрепи osu!',
            'store' => 'osu!магазин',
        ],
    ],
];
