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
            'getChangelog' => 'история изменений',
            'getDownload' => 'скачать',
            'getIcons' => 'иконки',
            'getNews' => 'новости',
            'index' => 'osu!',
            'supportTheGame' => 'поддержка игры',
        ],
        'help' => [
            '_' => 'помощь',
            'getFaq' => 'чаво',
            'getSupport' => 'поддержка',
            'getWiki' => 'вики',
            'wiki-show' => 'вики',
        ],
        'beatmaps' => [
            '_' => 'карты',
            'show' => 'информация',
            'index' => 'список',
            'artists' => 'избранные исполнители',
            // 'getPacks' => 'packs',
            // 'getCharts' => 'charts',
        ],
        'beatmapsets' => [
            '_' => 'карты',
            'discussion' => 'моддинг',
        ],
        'ranking' => [
            '_' => 'ранкинг',
            'getOverall' => 'общий',
            'getCountry' => 'регионы',
            'getCharts' => 'графики',
            'getMapper' => 'мапперы',
            'index' => 'общий',
        ],
        'community' => [
            '_' => 'сообщество',
            'dev' => 'osu!dev',
            'getForum' => 'форум',
            'getChat' => 'чат',
            'getSupport' => 'поддержка',
            'getLive' => 'стримы по osu!',
            'contests' => 'соревнования',
            'profile' => 'профиль',
            'tournaments' => 'турниры',
            'tournaments-index' => 'турниры',
            'tournaments-show' => 'информация о турнире',
            'forum-topic-watches-index' => 'подписки',
            'forum-topics-create' => 'форум',
            'forum-topics-show' => 'форум',
            'forum-forums-index' => 'форум',
            'forum-forums-show' => 'форум',
        ],
        'multiplayer' => [
            '_' => 'мультиплеер',
            'show' => 'матчи',
        ],
        'error' => [
            '_' => 'ошибка',
            '404' => 'потеряно',
            '403' => 'запрещено',
            '401' => 'не разрешено',
            '405' => 'потеряно',
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
            'logout' => 'Выход',
            'help' => 'Помощь',
        ],
        'store' => [
            '_' => 'магазин',
            'getListing' => 'товары',
            'getCart' => 'корзина',

            'getCheckout' => 'проверка',
            'getInvoice' => 'квитанция',
            'getProduct' => 'товар',

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
            'changelog' => 'Список изменении',
            'beatmaps' => 'Список карт',
            'download' => 'Скачать osu!',
            'wiki' => 'Вики',
        ],
        'help' => [
            '_' => 'Помощь и сообщество',
            'faq' => 'Часто задаваемые вопросы',
            'forum' => 'Форум',
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
            'tos' => 'Условия использования',
            'copyright' => 'Авторские права (DMCA)',
            'serverStatus' => 'Статус серверов',
            'osuStatus' => '@osustatus',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Страница не найдена',
            'description' => "Извините, но запрашиваемая страница не найдена!",
            'link' => false,
        ],
        '403' => [
            'error' => "Вы не должны быть здесь.",
            'description' => 'Вы можете вернуться назад.',
            'link' => false,
        ],
        '401' => [
            'error' => "Вы не должны быть здесь.",
            'description' => 'Вы можете вернуться назад. Или, может авторизироваться.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Страница отсутствует',
            'description' => "Извините, но запрашиваемая страница не найдена!",
            'link' => false,
        ],
        '500' => [
            'error' => 'О нет! Что-то сломалось! ;_;',
            'description' => "Мы уже автоматически оповещены о проблеме.",
            'link' => false,
        ],
        'fatal' => [
            'error' => 'О нет! Что-то сломалось (ужасно)! ;_;',
            'description' => "Мы уже автоматически оповещены о проблеме.",
            'link' => false,
        ],
        '503' => [
            'error' => 'Закрыты на обслуживание!',
            'description' => "Техническое обслуживание обычно занимает от 5 секунд до 10 минут. Если оно затягивается дольше, смотрите :link для получения дополнительной информации.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "На всякий случай, вот код, который вы можете дать поддержке!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'email или никнейм',
            'forgot' => "Я забыл свои данные",
            'password' => 'пароль',
            'title' => 'Войдите, чтобы продолжить',

            'error' => [
                'email' => "Никнейм или email адрес не существует",
                'password' => 'Неверный пароль',
            ],
        ],

        'register' => [
            'info' => "Вам нужен аккаунт, сэр. Почему бы не завести один?",
            'title' => "Ещё не зарегистрированы?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Настройки',
            'logout' => 'Выход',
            'profile' => 'Мой профиль',
        ],
    ],
];
