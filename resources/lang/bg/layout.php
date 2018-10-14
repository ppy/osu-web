<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'defaults' => [
        'page_description' => 'osu! - Ритъмът е само на *клик* от вас! Със специални режими на игра като Ouendan/EBA и Taiko, както и напълно фунциониращ редактор на бийтмапове.',
    ],

    'menu' => [
        'home' => [
            '_' => 'начало',
            'account-edit' => 'настройки',
            'friends-index' => 'приятели',
            'changelog-index' => 'списък на промените',
            'changelog-build' => 'версия',
            'getDownload' => 'изтегли',
            'getIcons' => 'икони',
            'groups-show' => 'групи',
            'index' => 'главно табло',
            'legal-show' => 'информация',
            'news-index' => 'новини',
            'news-show' => 'новини',
            'password-reset-index' => 'задаване на нова парола',
            'search' => 'търсене',
            'supportTheGame' => 'подкрепи играта',
            'team' => 'отбор',
        ],
        'help' => [
            '_' => 'помощ',
            'getFaq' => 'чзв',
            'getRules' => 'правилник',
            'getSupport' => 'не, наистина, имам нужда от помощ!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'бийтмапове',
            'artists' => 'препоръчани изпълнители',
            'beatmap_discussion_posts-index' => 'публикации за обсъждане на бийтмапове',
            'beatmap_discussions-index' => 'бийтмап дискусии',
            'beatmapset-watches-index' => 'modding списък за наблюдение',
            'beatmapset_discussion_votes-index' => 'гласове от бийтмап дискусии',
            'beatmapset_events-index' => 'бийтмап сет събития',
            'index' => 'списък',
            'packs' => 'пакети',
            'show' => 'информация',
        ],
        'beatmapsets' => [
            '_' => 'бийтмапове',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'класации',
            'index' => 'изпълнение',
            'performance' => 'performance',
            'charts' => 'в светлината на прожектора',
            'score' => 'резултат',
            'country' => 'държава',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'колектив',
            'dev' => 'разработка',
            'getForum' => 'форуми',
            'getChat' => 'чат',
            'getLive' => 'на живо',
            'contests' => 'конкурси',
            'profile' => 'профил',
            'tournaments' => 'турнири',
            'tournaments-index' => 'турнири',
            'tournaments-show' => 'информация за турнири',
            'forum-topic-watches-index' => 'абонаменти',
            'forum-topics-create' => 'форуми',
            'forum-topics-show' => 'форуми',
            'forum-forums-index' => 'форуми',
            'forum-forums-show' => 'форуми',
        ],
        'multiplayer' => [
            '_' => 'мултиплейър',
            'show' => 'мач',
        ],
        'error' => [
            '_' => 'грешка',
            '404' => 'липсващ',
            '403' => 'забранен',
            '401' => 'неоторизиран',
            '405' => 'липсващ',
            '500' => 'нещо се счупи',
            '503' => 'профилактика',
        ],
        'user' => [
            '_' => 'потребител',
            'getLogin' => 'вход',
            'disabled' => 'деактивиран',

            'register' => 'регистрация',
            'reset' => 'възстанови',
            'new' => 'ново',

            'messages' => 'Съобщения',
            'settings' => 'Настройки',
            'logout' => 'Изход',
            'help' => 'Помощ',
            'modding-history-discussions' => 'потребителски modding дискусии',
            'modding-history-events' => 'потребителски modding събития',
            'modding-history-index' => 'потребителска modding история',
            'modding-history-posts' => 'потребителски modding публикации',
            'modding-history-votesGiven' => 'потребителски modding гласове дадени',
            'modding-history-votesReceived' => 'потребителски modding гласове получени',
        ],
        'store' => [
            '_' => 'магазин',
            'checkout-show' => 'разплащане',
            'getListing' => 'списък',
            'cart-show' => 'количка',

            'getCheckout' => 'разплащане',
            'getInvoice' => 'фактура',
            'products-show' => 'продукт',

            'new' => 'ново',
            'home' => 'начало',
            'index' => 'начало',
            'thanks' => 'благодаря',
        ],
        'admin-forum' => [
            '_' => '',
            'forum-covers-index' => '',
        ],
        'admin-store' => [
            '_' => '',
            'orders-index' => '',
            'orders-show' => '',
        ],
        'admin' => [
            '_' => '',
            'beatmapsets-covers' => '',
            'logs-index' => '',
            'root' => '',

            'beatmapsets' => [
                '_' => '',
                'show' => '',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Общо',
            'home' => 'Начало',
            'changelog-index' => 'Списък на промените',
            'beatmaps' => 'Списък с бийтмапове',
            'download' => 'Изтеглете osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Помощ и Колектив',
            'faq' => 'Често Задавани Въпроси',
            'forum' => 'Обществени форуми',
            'livestreams' => 'Живи Потоци',
            'report' => 'Подайте сигнал за проблем',
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
            'email' => 'имейл адрес',
            'forgot' => "Забравих си данните",
            'password' => 'парола',
            'title' => 'Влезте, за да продължите',

            'error' => [
                'email' => "Потребителското име или имейл адресът не съществуват",
                'password' => 'Грешна парола',
            ],
        ],

        'register' => [
            'info' => "Трябва ди акаунт, господине. Защо все още нямате един?",
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
