<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'page_description' => 'osu! - Ритм всего лишь в *клике* от тебя! С Ouendan/EBA, Taiko и оригинальным типом игры, включая многофункциональный редактор карт.',
    ],

    'menu' => [
        'home' => [
            '_' => 'главная',
            'account-edit' => 'настройки',
            'friends-index' => 'друзья',
            'getChangelog' => 'список изменений',
            'getDownload' => 'скачать',
            'getIcons' => 'иконки',
            'legal-show' => 'информация',
            'news-index' => 'новости',
            'news-show' => 'новости',
            'password-reset-index' => 'восстановить пароль',
            'search' => 'поиск',
            'supportTheGame' => 'поддержать игру',
        ],
        'help' => [
            '_' => 'помощь',
            'getFaq' => 'чаво',
            'getSupport' => 'поддержка', //obsolete
            'getWiki' => 'вики',
            'wiki-show' => 'вики',
        ],
        'beatmaps' => [
            '_' => 'карты',
            'show' => 'информация',
            'index' => 'список',
            'artists' => 'избранные исполнители',
            'packs' => 'паки',
            // 'getCharts' => 'charts',
        ],
        'beatmapsets' => [
            '_' => 'карты',
            'discussion' => 'обсуждения',
        ],
        'rankings' => [
            '_' => 'рейтинг',
            'index' => 'производительности',
            'performance' => 'производительности',
            'charts' => 'по месяцам',
            'score' => 'по очкам',
            'country' => 'по странам',
            'kudosu' => 'кудосу',
        ],
        'community' => [
            '_' => 'сообщество',
            'dev' => 'osu!dev',
            'getForum' => 'форумы', // Base text changed to plural, please check.
            'getChat' => 'чат',
            'getLive' => 'трансляции по osu!',
            'contests' => 'конкурсы',
            'profile' => 'профиль',
            'tournaments' => 'турниры',
            'tournaments-index' => 'турниры',
            'tournaments-show' => 'информация о турнире',
            'forum-topic-watches-index' => 'подписки',
            'forum-topics-create' => 'форум', // Base text changed to plural, please check.
            'forum-topics-show' => 'форум', // Base text changed to plural, please check.
            'forum-forums-index' => 'форум', // Base text changed to plural, please check.
            'forum-forums-show' => 'форум', // Base text changed to plural, please check.
        ],
        'multiplayer' => [
            '_' => 'мультиплеер',
            'show' => 'матчи',
        ],
        'error' => [
            '_' => 'ошибка',
            '404' => 'не найдено',
            '403' => 'запрещено',
            '401' => 'требуется подтверждение',
            '405' => 'не найдено',
            '500' => 'что-то сломалось',
            '503' => 'обслуживание',
        ],
        'user' => [
            '_' => 'пользователь',
            'getLogin' => 'логин',
            'disabled' => 'недоступно',

            'register' => 'зарегистрироваться',
            'reset' => 'восстановить',
            'new' => 'новый',

            'messages' => 'Сообщения',
            'settings' => 'Настройки',
            'logout' => 'Выход', // Base text changed from "Log Out" to "Sign Out", please check.
            'help' => 'Помощь',
        ],
        'store' => [
            '_' => 'магазин',
            'getListing' => 'товары',
            'cart-show' => 'корзина',

            'getCheckout' => 'проверка',
            'getInvoice' => 'чек',
            'products-show' => 'товар',

            'new' => 'новый',
            'home' => 'главная',
            'index' => 'главная',
            'thanks' => 'благодарности',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'обложка форума',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'заказы',
            'orders-show' => 'заказ',
        ],
        'admin' => [
            '_' => 'админ',
            'root' => 'главная',
            'logs-index' => 'логи',
            'beatmapsets' => [
                '_' => 'карты',
                'covers' => 'обложки',
                'show' => 'детали',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Общее',
            'home' => 'Главная',
            'changelog' => 'Список изменений',
            'beatmaps' => 'Список карт',
            'download' => 'Скачать osu!',
            'wiki' => 'Вики',
        ],
        'help' => [
            '_' => 'Помощь и сообщество',
            'faq' => 'Часто задаваемые вопросы',
            'forum' => 'Форумы',
            'livestreams' => 'Прямые трансляции',
            'report' => 'Сообщить о проблеме',
        ],
        'support' => [
            '_' => 'Поддержите osu!',
            'tags' => 'Саппорт',
            'merchandise' => 'Магазин osu!',
        ],
        'legal' => [
            '_' => 'Права и статус',
            'copyright' => 'Авторские права (DMCA)',
            'osu_status' => '@osustatus',
            'server_status' => 'Статус серверов',
            'terms' => 'Условия использования',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Страница не найдена',
            'description' => 'Извини, но страница не найдена!',
            'link' => false,
        ],
        '403' => [
            'error' => 'Ты не должен быть здесь.',
            'description' => 'Доступ к этой странице ограничен, вернись назад.',
            'link' => false,
        ],
        '401' => [
            'error' => 'Ты не должен быть здесь.',
            'description' => 'Доступ к этой странице ограничен. Вернись назад или авторизуйся.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Страница отсутствует',
            'description' => 'Извини, но запрашиваемая страница не найдена!',
            'link' => false,
        ],
        '500' => [
            'error' => 'О нет! Что-то сломалось! ;_;',
            'description' => 'Мы уже автоматически оповещены о проблеме.',
            'link' => false,
        ],
        'fatal' => [
            'error' => 'О нет! Что-то сломалось (ужасно)! ;_;',
            'description' => 'Мы уже автоматически оповещены о проблеме.',
            'link' => false,
        ],
        '503' => [
            'error' => 'Закрыты на обслуживание!',
            'description' => 'Техническое обслуживание обычно занимает от 5 секунд до 10 минут. Если оно затягивается, смотри :link для получения дополнительной информации.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'На всякий случай, вот код, который ты можешь дать поддержке!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'email или никнейм',
            'forgot' => 'Я забыл свои данные',
            'password' => 'пароль',
            'title' => 'Войди, чтобы продолжить',

            'error' => [
                'email' => 'Никнейм или email адрес не существует',
                'password' => 'Неверный пароль',
            ],
        ],

        'register' => [
            'info' => 'Тебе нужен аккаунт. Почему бы не завести один?',
            'title' => 'Ещё не зарегистрирован?',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Настройки',
            'friends' => 'Друзья',
            'logout' => 'Выйти', // Base text changed from "Log Out" to "Sign Out", please check.
            'profile' => 'Мой профиль',
        ],
    ],

    'popup_search' => [
        'initial' => 'Начинай вводить ключевые слова.',
        'retry' => 'Поиск не удался. Нажми для повтора.',
    ],
];
