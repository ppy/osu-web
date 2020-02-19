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
    'defaults' => [
        'page_description' => 'osu! - ритм гра лише в *клікові* від вас. Разом з Ouendan/EBA, Taiko та оригінальними ігровими режимами, а також повноцінним редактором рівнів.',
    ],

    'header' => [
        'admin' => [
            '_' => 'адмін',
            'beatmapset' => 'набор карт',
            'beatmapset_covers' => 'обкладинки наборів карт',
            'contest' => 'конкурс',
            'contests' => 'конкурси',
            'root' => 'панель управління',
            'store_orders' => 'адмін магазину',
        ],

        'artists' => [
            '_' => '',
            'index' => 'список',
        ],

        'beatmapsets' => [
            '_' => 'карта',
            'discussions' => 'обговорення',
            'index' => 'список',
            'show' => 'інформація',
            'packs' => 'набори',
        ],

        'changelog' => [
            '_' => 'список змін',
            'index' => 'список',
        ],

        'community' => [
            '_' => 'спільнота',
            'comments' => 'коментарі',
            'contests' => '',
            'forum' => 'форум',
            'livestream' => 'прямі трансляції',
        ],

        'error' => [
            '_' => 'помилка',
        ],

        'help' => [
            '_' => 'вікі',
            'index' => 'зміст',
        ],

        'home' => [
            '_' => 'головна',
            'password_reset' => 'скинути пароль',
        ],

        'matches' => [
            '_' => '',
        ],

        'notice' => [
            '_' => '',
        ],

        'notifications' => [
            '_' => '',
            'index' => '',
        ],

        'rankings' => [
            '_' => '',
        ],

        'store' => [
            '_' => '',
            'cart' => '',
            'order' => '',
            'orders' => '',
            'product' => '',
            'products' => '',
        ],

        'tournaments' => [
            '_' => '',
            'index' => '',
        ],

        'users' => [
            '_' => '',
            'forum_posts' => '',
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
        'home' => [
            '_' => 'головна',
            'account-edit' => 'налаштування',
            'account-verifyLink' => '',
            'beatmapset-watches-index' => '',
            'changelog-build' => 'збірка',
            'changelog-index' => 'список змін',
            'client_verifications-create' => '',
            'forum-topic-watches-index' => '',
            'friends-index' => 'друзі',
            'getDownload' => 'завантажити',
            'getIcons' => 'значки',
            'groups-show' => 'групи',
            'index' => 'стільниця',
            'legal-show' => 'інформація',
            'messages-index' => 'повідомлення',
            'news-index' => 'новини',
            'news-show' => 'новини',
            'password-reset-index' => 'скидання пароля',
            'search' => 'пошук',
            'supportTheGame' => 'підтримати гру',
            'team' => 'команда',
            'testflight' => '',
        ],
        'profile' => [
            '_' => '',
            'friends' => '',
            'settings' => '',
        ],
        'help' => [
            '_' => 'допомога',
            'getFaq' => 'чапи',
            'getRules' => 'правила',
            'getSupport' => 'мені, насправді, потрібна допомога!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'біткарти',
            'artists' => 'вибрані виконавці',
            'beatmap_discussion_posts-index' => 'публікації в обговореннях карти',
            'beatmap_discussions-index' => 'обговорення біткарти',
            'beatmapset_discussion_votes-index' => 'голосів в обговоренні карти',
            'beatmapset_events-index' => 'події карти',
            'index' => 'бібліотека',
            'packs' => 'набори',
            'show' => 'дані',
        ],
        'beatmapsets' => [
            '_' => 'біткарти',
            'discussion' => 'обговорення',
        ],
        'rankings' => [
            '_' => 'рейтинги',
            'index' => 'по продуктивності',
            'performance' => 'продуктивність',
            'charts' => 'по графіках',
            'score' => 'рахунок',
            'country' => 'країна',
            'kudosu' => 'кудосу',
        ],
        'community' => [
            '_' => 'спільнота',
            'chat' => 'чат',
            'chat-index' => 'чат',
            'dev' => 'розробка',
            'getForum' => 'форуми',
            'getLive' => 'наживо',
            'comments-index' => 'коментарі',
            'comments-show' => 'коментар',
            'contests' => 'конкурси',
            'profile' => 'профайл',
            'tournaments' => 'турніри',
            'tournaments-index' => 'турніри',
            'tournaments-show' => 'дані по турніру',
            'forum-topics-create' => 'форуми',
            'forum-topics-show' => 'форуми',
            'forum-forums-index' => 'форуми',
            'forum-forums-show' => 'форуми',
        ],
        'multiplayer' => [
            '_' => 'багатокор. гра',
            'show' => 'матч',
        ],
        'error' => [
            '_' => 'помилка',
            '404' => 'відсутні',
            '403' => 'заборонено',
            '401' => 'error 401 Unauthorized',
            '405' => '405 Method Not Allowed',
            '500' => 'щось зламалося',
            '503' => 'обслуговування',
        ],
        'user' => [
            '_' => 'користувач',
            'getLogin' => 'логін',
            'disabled' => 'вимкнено',

            'register' => 'реєстрація',
            'reset' => 'відновити',
            'new' => 'новий',

            'help' => 'Допомога',
            'logout' => 'Вийти',
            'messages' => 'Повідомлення',
            'modding-history-discussions' => 'обговорення',
            'modding-history-events' => 'історія подій',
            'modding-history-index' => 'переглянути історію змін',
            'modding-history-posts' => 'історія публікацій',
            'modding-history-votesGiven' => 'дані голоси',
            'modding-history-votesReceived' => 'отримані голоси',
            'notifications-index' => '',
            'oauth_login' => 'увійдіть для oauth',
            'oauth_request' => 'Oauth автентифікація',
            'settings' => 'Налаштування',
        ],
        'store' => [
            '_' => 'крамниця',
            'checkout-show' => 'перевірка',
            'getListing' => 'товари',
            'cart-show' => 'кошик',

            'getCheckout' => 'завершення покупки',
            'getInvoice' => 'рахунок',
            'orders-index' => 'історія замовлень',
            'products-show' => 'товар',

            'new' => 'новий',
            'home' => 'головна',
            'index' => 'головна',
            'thanks' => 'дякуємо',
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
            '_' => 'Загальні',
            'home' => 'Головна',
            'changelog-index' => 'Список змін',
            'beatmaps' => 'Бібліотека карт',
            'download' => 'Завантажити osu!',
            'wiki' => 'Вікі',
        ],
        'help' => [
            '_' => 'Допомога і спільнота',
            'faq' => 'Найчастіші питання',
            'forum' => 'Форуми спільноти',
            'livestreams' => 'Прямі трансляції',
            'report' => 'Повідомити про проблему',
        ],
        'legal' => [
            '_' => 'Права і статус',
            'copyright' => 'Авторські права (DMCA)',
            'privacy' => 'Політика конфіденційності',
            'server_status' => 'Статус серверів',
            'source_code' => 'Початковий програмний код',
            'terms' => 'Умови використання',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Сторінка відсутня',
            'description' => "Вибачте, але запитана сторінка відсутня!",
        ],
        '403' => [
            'error' => "Ви не повинні тут бути.",
            'description' => 'Ви можете спробувати повернутися назад, напевно.',
        ],
        '401' => [
            'error' => "Ви не повинні тут бути.",
            'description' => 'Ви можете спробувати повернутися назад, напевно. Або може увійти.',
        ],
        '405' => [
            'error' => 'Сторінка відсутня',
            'description' => "Вибачте, але запитана сторінка відсутня!",
        ],
        '500' => [
            'error' => 'Ох, горе! Щось зламалося! ;_;',
            'description' => "Про помилку буде сповіщено.",
        ],
        'fatal' => [
            'error' => 'Ох, горе! Щось жахливо зламалося! ;_;',
            'description' => "Про помилку буде сповіщено.",
        ],
        '503' => [
            'error' => 'Закрито на технічне обслуговування!',
            'description' => "Технічне обслуговування зазвичай займає від 5 секунд до 10 хвилин. Якщо воно затягується, перейдіть :link для отримання додаткової інформації.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Про всяк випадок, ось код, який ви можете повідомити службі підтримки!",
    ],

    'popup_login' => [
        'login' => [
            'forgot' => "Я все забув",
            'password' => 'пароль',
            'title' => 'Увійдіть, щоб продовжити',
            'username' => '',

            'error' => [
                'email' => "Ім'я користувача або електронна адреса невірна",
                'password' => 'Хибний пароль',
            ],
        ],

        'register' => [
            'download' => '',
            'info' => 'Пане, Вам потрібний аккаунт. Чому Ви досі його не маєте?',
            'title' => "Немаєте аккаунту?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Налаштування',
            'friends' => 'Друзі',
            'logout' => 'Вийти',
            'profile' => 'Мій профайл',
        ],
    ],

    'popup_search' => [
        'initial' => 'Введіть текст для пошуку!',
        'retry' => 'Невдалий пошук. Натисніть щоб повторити.',
    ],
];
