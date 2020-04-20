<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'defaults' => [
        'page_description' => 'osu! - Ритъмът е само на *клик* от вас! Със специални режими на игра като Ouendan/EBA и Taiko, както и напълно фунциониращ редактор на бийтмапове.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => '',
            'beatmapset_covers' => '',
            'contest' => '',
            'contests' => '',
            'root' => '',
            'store_orders' => '',
        ],

        'artists' => [
            'index' => '',
        ],

        'changelog' => [
            'index' => '',
        ],

        'help' => [
            'index' => '',
            'sitemap' => '',
        ],

        'store' => [
            'cart' => '',
            'orders' => '',
            'products' => '',
        ],

        'tournaments' => [
            'index' => '',
        ],

        'users' => [
            'modding' => '',
            'show' => '',
        ],
    ],

    'gallery' => [
        'close' => '',
        'fullscreen' => '',
        'zoom' => '',
        'previous' => '',
        'next' => '',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'бийтмапове',
            'artists' => 'препоръчани изпълнители',
            'index' => 'списък',
            'packs' => 'пакети',
        ],
        'community' => [
            '_' => 'колектив',
            'chat' => 'чат',
            'contests' => 'конкурси',
            'dev' => 'разработка',
            'forum-forums-index' => 'форуми',
            'getLive' => 'на живо',
            'tournaments' => 'турнири',
        ],
        'help' => [
            '_' => 'помощ',
            'getFaq' => 'чзв',
            'getRules' => 'правилник',
            'getSupport' => 'не, наистина, имам нужда от помощ!',
            'getWiki' => 'wiki',
        ],
        'home' => [
            '_' => 'начало',
            'changelog-index' => 'списък на промените',
            'getDownload' => 'изтегли',
            'news-index' => 'новини',
            'search' => 'търсене',
            'team' => 'отбор',
        ],
        'rankings' => [
            '_' => 'класации',
            'charts' => 'препоръчани',
            'country' => 'държава',
            'index' => 'изпълнение',
            'kudosu' => 'kudosu',
            'score' => 'резултат',
        ],
        'store' => [
            '_' => 'магазин',
            'cart-show' => 'количка',
            'getListing' => 'списък',
            'orders-index' => 'история на поръчките',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Общо',
            'home' => 'Начало',
            'changelog-index' => 'Списък на промените',
            'beatmaps' => 'Списък с бийтмапове',
            'download' => 'Изтеглете osu!',
        ],
        'help' => [
            '_' => 'Помощ и Колектив',
            'faq' => 'Често Задавани Въпроси',
            'forum' => 'Обществени форуми',
            'livestreams' => 'Живи Потоци',
            'report' => 'Подайте сигнал за проблем',
            'wiki' => '',
        ],
        'legal' => [
            '_' => 'Легалности и статус',
            'copyright' => 'Авторски права (DMCA)',
            'privacy' => 'Поверителност',
            'server_status' => 'Състояние на сървърите',
            'source_code' => 'Програмен код',
            'terms' => 'Условия за ползване',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => '',
            'description' => '',
        ],
        '404' => [
            'error' => 'Страницата липсва',
            'description' => "Извиняваме се, но страницата която търсите не е тук!",
        ],
        '403' => [
            'error' => "Вие не трябва да сте тук.",
            'description' => 'Можете да опитате да се върнете назад.',
        ],
        '401' => [
            'error' => "Вие не трябва да сте тук.",
            'description' => 'Може да опитате да се върнете назад. Или да влезете в профила си.',
        ],
        '405' => [
            'error' => 'Страницата липсва',
            'description' => "Извиняваме се, но страницата която търсите не е тук!",
        ],
        '422' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'Ох не, нещо се счупи! Т - Т',
            'description' => "Ние сме автоматично осведомени за всяка неизправност.",
        ],
        'fatal' => [
            'error' => 'Ох не, нещо се счупи! (доста зле) Т - Т',
            'description' => "Ние сме автоматично осведомени за всяка неизправност.",
        ],
        '503' => [
            'error' => 'Спрян за профилактика!',
            'description' => "Профилактиката обикновено трае от 5 секунди до 10 минути. В случай че стане повече от 10 минути, проверете :link за повече информация.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "За всеки случай, това е код, които може да дадете на поддръжка при неизправност!",
    ],

    'popup_login' => [
        'login' => [
            'forgot' => "Забравих си данните",
            'password' => 'парола',
            'title' => 'Влезте, за да продължите',
            'username' => '',

            'error' => [
                'email' => "Потребителското име или имейл адресът не съществуват",
                'password' => 'Грешна парола',
            ],
        ],

        'register' => [
            'download' => '',
            'info' => 'Трябва ди акаунт, господине. Защо все още нямате един?',
            'title' => "Нямате акаунт?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Настройки',
            'friends' => 'Приятели',
            'logout' => 'Изход',
            'profile' => 'Моят профил',
        ],
    ],

    'popup_search' => [
        'initial' => 'Пишете тук за търсене!',
        'retry' => 'Търсенето неуспешно. Щракнете, за да опитате отново.',
    ],
];
