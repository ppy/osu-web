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
    'landing' => [
        'download' => 'Изтеглете сега',
        'online' => '<strong>:players</strong> са вмомента онлайн в общо <strong>:games</strong> игри',
        'peak' => 'Връхна точка, :count потребители онлайн',
        'players' => '<strong>:count</strong> регистрирани играчи',

        'slogan' => [
            'main' => 'най-добрата безплатна ритъм игра',
            'sub' => 'ритъмът е само на един клик от вас',
        ],
    ],

    'search' => [
        'advanced_link' => 'Разширено търсене',
        'button' => 'Търсене',
        'empty_result' => 'Нищо не бе открито!',
        'missing_query' => 'Ключовата дума в търсачката трябва да има поне :n символа',
        'placeholder' => 'Пишете тук за търсене…',
        'title' => 'Търсене',

        'beatmapset' => [
            'more' => 'още :count бийтмап резултата от търсенето',
            'more_simple' => 'Виж повече бийтмап резултати от търсенето',
            'title' => 'Бийтмапове',
        ],

        'forum_post' => [
            'all' => 'Всички форуми',
            'link' => 'Търсене в форума',
            'more_simple' => 'Виж повече форум резултати от търсенето',
            'title' => 'Форум',

            'label' => [
                'forum' => 'търсене във форуми',
                'forum_children' => 'прибави и подфорумите',
                'topic_id' => 'тема #',
                'username' => 'автор',
            ],
        ],

        'mode' => [
            'all' => 'всички',
            'beatmapset' => 'бийтмапове',
            'forum_post' => 'форум',
            'user' => 'играч',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => 'още :count резултата на играчи от търсенето',
            'more_simple' => 'Виж повече резултати на играчи от търсенето',
            'more_hidden' => 'Търсенето на играчи е ограничено до :max играчи. Опитайте да доусъвършенствате заявката за търсене.',
            'title' => 'Играчи',
        ],

        'wiki_page' => [
            'link' => 'Търсене в wiki',
            'more_simple' => 'Виж повече wiki резултати от търсенето',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "нека ти помогнем<br>
с основите да започнеш!",
        'action' => 'Изтеглете osu!',
        'os' => [
            'windows' => 'за Windows',
            'macos' => 'за macOS',
            'linux' => 'за Linux',
        ],
        'mirror' => 'алтернативен линк',
        'macos-fallback' => 'macOS потребители',
        'steps' => [
            'register' => [
                'title' => 'създайте акаунт',
                'description' => 'следвайте указанията, при стартиране на играта, за да влезете в акаунта си или да направите нов акаунт',
            ],
            'download' => [
                'title' => 'изтеглете играта',
                'description' => 'щракнете върху бутона горе, за да изтеглите инсталационната програма, след което я стартирате!',
            ],
            'beatmaps' => [
                'title' => 'изтеглете бийтмапове',
                'description' => [
                    '_' => ':browse голямата библиотека от потребителско създадените бийтмапове и започнете да играете!',
                    'browse' => 'разгледайте',
                ],
            ],
        ],
        'video-guide' => 'видео ръководство',
    ],

    'user' => [
        'title' => 'главно табло',
        'news' => [
            'title' => 'Новини',
            'error' => 'Грешка при зареждането на новините, пробвайте с презареждане на страницата?...',
        ],
        'header' => [
            'welcome' => 'Привет, <strong>:username</strong>!',
            'messages' => 'Вие имате :count ново съобщение | Вие имате :count нови съобщения',
            'stats' => [
                'friends' => 'Приятели онлайн',
                'games' => 'Общо игри',
                'online' => 'Потребители онлайн',
            ],
        ],
        'beatmaps' => [
            'new' => 'Нови класирани бийтмапове',
            'popular' => 'Популярни бийтмапове',
            'by' => 'от',
            'plays' => ':count пъти изигран',
        ],
        'buttons' => [
            'download' => 'Изтеглете osu!',
            'support' => 'Подкрепете osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Уау!',
        'subtitle' => 'Изглежда си прекарвате прекрасно :D',
        'body' => [
            'part-1' => 'Знаете ли, че в osu! няма реклами и разчита на играчите си да покрепят играта за по-нататъчното й разрастване и поддръжка?',
            'part-2' => 'Знаете ли също че с подкрепата на osu! вие ще получите куп полезни преимущества, като възможността да теглите директно от играта, което става автоматично докато сте в мултиплейър сесия или докато наблюдавате друг играч?',
        ],
        'find-out-more' => 'Щракнете тук, за да разберете повече!',
        'download-starting' => "О и не се притеснявайте - инсталационният файл вече се тегли ;)",
    ],
];
