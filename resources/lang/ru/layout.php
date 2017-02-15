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
        'page_description' => 'osu! - Ритм всего лишь в *клике* от тебя! Игра с Ouendan/EBA, Taiko и оригинальными режимами игры, со встроенным многофункциональным редактором уровней.',
    ],

    'menu' => [
        'home' => [
            '_' => 'главная',
            'account-edit' => 'настройки',
            'getChangelog' => 'список изменений',
            'getDownload' => 'скачать игру',
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
            'index' => 'обзор',
            'artists' => 'любимые исполнители',
            // 'getPacks' => 'сборки',
            // 'getCharts' => 'графики',
        ],
        'beatmapsets' => [
            '_' => 'карты',
            'discussion' => 'моддинг',
        ],
        'ranking' => [
            '_' => 'рейтинги',
            'getOverall' => 'игроков',
            'getCountry' => 'стран',
            'getCharts' => 'графики',
            'getMapper' => 'мапперов',
            'index' => 'игроков',
        ],
        'community' => [
            '_' => 'сообщество',
            'dev' => 'osu!dev',
            'getForum' => 'форум',
            'getChat' => 'чат',
            'getSupport' => 'поддержка',
            'getLive' => 'трансляции',
            'contests' => 'конкурсы',
            'profile' => 'профиль',
            'tournaments' => 'турниры',
            'tournaments-index' => 'турниры',
            'tournaments-show' => 'информация турниров',
            'forum-topic-watches-index' => 'подписки',
            'forum-topics-create' => 'форум',
            'forum-topics-show' => 'форум',
            'forum-forums-index' => 'форум',
            'forum-forums-show' => 'форум',
        ],
        'multiplayer' => [
            '_' => 'мультиплеер',
            'show' => 'матч',
        ],
        'error' => [
            '_' => 'ошибка',
            '404' => 'не найдено',
            '403' => 'запрещено',
            '401' => 'необходимо подтверждение',
            '405' => 'не найдено',
            '500' => 'неизвестная ошибка',
            '503' => 'технические работы',
        ],
        'user' => [
            '_' => 'пользователь',
            'getLogin' => 'вход',
            'disabled' => 'отключено',

            'register' => 'регистрация',
            'reset' => 'восстановление',
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

            'getCheckout' => 'оформление заказа',
            'getInvoice' => 'выставленный счёт',
            'getProduct' => 'товар',

            'new' => 'новый',
            'home' => 'главная',
            'index' => 'главная',
            'thanks' => 'благодарности',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'обложки форума',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'заказы',
            'orders-show' => 'заказ',
        ],
        'admin' => [
            '_' => 'admin',
            'root' => 'главная',
            'logs-index' => 'логи',
            'beatmapsets' => [
                '_' => 'карты',
                'covers' => 'обложки',
                'show' => 'подробно',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Общее',
            'home' => 'Главная',
            'changelog' => 'Список изменений',
            'beatmaps' => 'Карты',
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
            '_' => 'Поддержка osu!',
            'tags' => 'Тег саппортера',
            'merchandise' => 'osu!store',
        ],
        'legal' => [
            '_' => 'Соглашения и состояние osu!',
            'tos' => 'Условия использования',
            'copyright' => 'Авторские права (DMCA)',
            'serverStatus' => 'Состояние серверов',
            'osuStatus' => '@osustatus',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Страница не найдена',
            'description' => "Извините, но запрашиваемая Вами страница не существует!",
            'link' => false,
        ],
        '403' => [
            'error' => "Вас не должно быть тут.",
            'description' => 'Вы можете попробовать вернуться назад.',
            'link' => false,
        ],
        '401' => [
            'error' => "Вас не должно быть тут.",
            'description' => 'Вы можете попробовать вернуться назад, или авторизироваться.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Страница не найдена',
            'description' => "Извините, но запрашиваемая Вами страница не существует!",
            'link' => false,
        ],
        '500' => [
            'error' => 'О нет! Что-то сломалось! ;_;',
            'description' => "Мы уже оповещены, попробуйте попытку позже.",
            'link' => false,
        ],
        'fatal' => [
            'error' => 'О нет! Что-то сломалось (сильно)! ;_;',
            'description' => "Мы уже оповещены, попробуйте попытку позже.",
            'link' => false,
        ],
        '503' => [
            'error' => 'Закрыты на время тех. работ!',
            'description' => "Технические работы, как правило, занимают от 5 секунд до 10 минут. Если работы затянулись намного дольше, перейдите по :link ссылке для подробностей.",
            'link' => [
                'text' => 'этой',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],

        // used by sentry if it returns an error
        'reference' => "На всякий случай, ниже код, по которому Вы бы могли помочь нам разобраться!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'электронная почта',
            'forgot' => "Я забыл свои данные",
            'password' => 'пароль',
            'title' => 'Войдите, чтобы продолжить',

            'error' => [
                'email' => "Логин или почта не существуют",
                'password' => 'Неверный пароль',
            ],
        ],

        'register' => [
            'info' => "Вам необходим аккаунт, сэр? Почему бы Вам не создать один?",
            'title' => "Нет аккаунта?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Настройки',
            'logout' => 'Выйти',
            'profile' => 'Мой профиль',
        ],
    ],
];
