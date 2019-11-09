<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'defaults' => [
        'page_description' => 'osu! - Ритм всего лишь в *клике* от тебя! С Ouendan/EBA, Taiko и оригинальными режимами игры, а также многофункциональным редактором карт.',
    ],

    'header' => [
        'community' => [
            '_' => 'Сообщество',

            'forum' => 'Форум',
        ],
    ],

    'gallery' => [
        'close' => 'Закрыть (Esc)',
        'fullscreen' => 'Полноэкранный режим',
        'zoom' => 'Увеличить / уменьшить',
        'previous' => 'Предыдущий (стрелка влево)',
        'next' => 'Следующий (стрелка вправо)',
    ],

    'menu' => [
        'home' => [
            '_' => 'общее',
            'account-edit' => 'настройки',
            'account-verifyLink' => 'Проверка завершена',
            'friends-index' => 'друзья',
            'changelog-index' => 'список изменений',
            'changelog-build' => 'сборка',
            'getDownload' => 'скачать игру',
            'getIcons' => 'иконки',
            'groups-show' => 'группы',
            'index' => 'главная',
            'legal-show' => 'информация',
            'messages-index' => 'сообщения',
            'news-index' => 'новости',
            'news-show' => 'новости',
            'password-reset-index' => 'сброс пароля',
            'search' => 'поиск',
            'supportTheGame' => 'поддержать игру',
            'team' => 'команда',
        ],
        'profile' => [
            '_' => 'профиль',
            'friends' => 'друзья',
            'settings' => 'настройки',
        ],
        'help' => [
            '_' => 'помощь',
            'getFaq' => 'чаво',
            'getRules' => 'правила',
            'getSupport' => 'мне правда нужна помощь!',
            'getWiki' => 'вики',
            'wiki-show' => 'вики',
        ],
        'beatmaps' => [
            '_' => 'карты',
            'artists' => 'osu!featured artists',
            'beatmap_discussion_posts-index' => 'публикации в обсуждений карты',
            'beatmap_discussions-index' => 'обсуждения карты',
            'beatmapset-watches-index' => 'подписки на карты',
            'beatmapset_discussion_votes-index' => 'голоса в обсуждений карты',
            'beatmapset_events-index' => 'события карты',
            'index' => 'библиотека',
            'packs' => 'сборки',
            'show' => 'инфо',
        ],
        'beatmapsets' => [
            '_' => 'карты',
            'discussion' => 'обсуждения',
        ],
        'rankings' => [
            '_' => 'рейтинг',
            'index' => 'производительности',
            'performance' => 'performance',
            'charts' => 'по чартам',
            'score' => 'по очкам',
            'country' => 'по странам',
            'kudosu' => 'кудосу',
        ],
        'community' => [
            '_' => 'сообщество',
            'chat' => 'сообщения',
            'chat-index' => 'сообщения',
            'dev' => 'разработка',
            'getForum' => 'форумы',
            'getLive' => 'прямые трансляции',
            'comments-index' => 'комментарии',
            'comments-show' => 'комментарий',
            'contests' => 'конкурсы',
            'profile' => 'профиль',
            'tournaments' => 'турниры',
            'tournaments-index' => 'турниры',
            'tournaments-show' => 'информация о турнире',
            'forum-topic-watches-index' => 'подписки на темы',
            'forum-topics-create' => 'форумы',
            'forum-topics-show' => 'форумы',
            'forum-forums-index' => 'форумы',
            'forum-forums-show' => 'форумы',
        ],
        'multiplayer' => [
            '_' => 'мультиплеер',
            'show' => 'матч',
        ],
        'error' => [
            '_' => 'ошибка',
            '404' => 'потеряно',
            '403' => 'запрещено',
            '401' => 'вы не авторизованы',
            '405' => 'потеряно',
            '500' => 'что-то сломалось',
            '503' => 'тех. работы',
        ],
        'user' => [
            '_' => 'пользователь',
            'getLogin' => 'логин',
            'disabled' => 'недоступно',

            'register' => 'зарегистрироваться',
            'reset' => 'восстановить',
            'new' => 'новый',

            'help' => 'Помощь',
            'logout' => 'Выход',
            'messages' => 'Сообщения',
            'modding-history-discussions' => 'обсуждение',
            'modding-history-events' => 'история событий',
            'modding-history-index' => 'активность карты пользователя',
            'modding-history-posts' => 'история публикаций',
            'modding-history-votesGiven' => 'голоса',
            'modding-history-votesReceived' => 'полученные голоса',
            'oauth_login' => 'вход для oauth',
            'oauth_request' => 'авторизация oauth',
            'settings' => 'Настройки',
        ],
        'store' => [
            '_' => 'магазин',
            'checkout-show' => 'проверка',
            'getListing' => 'товары',
            'cart-show' => 'корзина',

            'getCheckout' => 'проверка',
            'getInvoice' => 'чек',
            'orders-index' => 'история заказов',
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
            'beatmapsets-covers' => 'обложки карт',
            'logs-index' => 'логи',
            'root' => 'главная',

            'beatmapsets' => [
                '_' => 'карты',
                'show' => 'детали',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Общее',
            'home' => 'Главная',
            'changelog-index' => 'Список изменений',
            'beatmaps' => 'Библиотека карт',
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
        'legal' => [
            '_' => 'Права и статус',
            'copyright' => 'Авторские права (DMCA)',
            'privacy' => 'Конфиденциальность',
            'server_status' => 'Статус серверов',
            'source_code' => 'Исходный код',
            'terms' => 'Условия использования',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Страница не найдена',
            'description' => "Извините, но запрашиваемая Вами страница не найдена.",
        ],
        '403' => [
            'error' => "Вы не должны быть здесь.",
            'description' => 'Вы можете попробовать вернуться назад, наверно.',
        ],
        '401' => [
            'error' => "Вы не должны быть здесь.",
            'description' => 'Вы можете попробовать вернуться назад, наверно. Или может войти.',
        ],
        '405' => [
            'error' => 'Страница не найдена',
            'description' => "Извините, но запрашиваемая Вами страница не найдена.",
        ],
        '500' => [
            'error' => 'О нет! Что-то сломалось! ;_;',
            'description' => "Нам уже известно о проблеме и мы работаем над ее исправлением.",
        ],
        'fatal' => [
            'error' => 'О нет! Что-то сломалось (ужасно)! ;_;',
            'description' => "Нам уже известно о проблеме и мы работаем над ее исправлением.",
        ],
        '503' => [
            'error' => 'Закрыты на обслуживание!',
            'description' => "Техническое обслуживание обычно занимает от 5 секунд до 10 минут. Если оно затягивается, смотри :link для получения дополнительной информации.",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "На всякий случай, вот код, который вы можете сообщить поддержке!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'почта или никнейм',
            'forgot' => "я не помню, помогите",
            'password' => 'пароль',
            'title' => 'Войдите для продолжения',

            'error' => [
                'email' => "Почта или никнейм не существуют",
                'password' => 'Неверный пароль',
            ],
        ],

        'register' => [
            'download' => 'Скачать',
            'info' => 'Вам нужен аккаунт, сэр. Почему у вас его всё ещё нет?',
            'title' => "Нет аккаунта?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Настройки',
            'friends' => 'Друзья',
            'logout' => 'Выйти',
            'profile' => 'Мой профиль',
        ],
    ],

    'popup_search' => [
        'initial' => 'Начинайте вводить!',
        'retry' => 'Ошибка поиска. Нажмите для повтора.',
    ],
];
