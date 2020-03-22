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
        'page_description' => 'osu! - Рытм у адным *націсканні* ад вас! Гульня з Ouendan/EBA, Taiko і арыгінальнымі гульнявымі рэжымамі, а таксама з поўным вартасным рэдактарам бітмап.',
    ],

    'header' => [
        'admin' => [
            '_' => '',
            'beatmapset' => '',
            'beatmapset_covers' => '',
            'contest' => '',
            'contests' => '',
            'root' => '',
            'store_orders' => '',
        ],

        'artists' => [
            '_' => '',
            'index' => '',
        ],

        'beatmapsets' => [
            '_' => '',
            'discussions' => '',
            'index' => '',
            'show' => '',
            'packs' => '',
        ],

        'changelog' => [
            '_' => '',
            'index' => '',
        ],

        'community' => [
            '_' => '',
            'comments' => '',
            'contests' => '',
            'forum' => '',
            'livestream' => '',
        ],

        'error' => [
            '_' => '',
        ],

        'help' => [
            '_' => '',
            'index' => '',
        ],

        'home' => [
            '_' => '',
            'password_reset' => '',
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
            '_' => 'галоўная',
            'account-edit' => 'налады',
            'account-verifyLink' => 'Пацверджанне завершана',
            'beatmapset-watches-index' => '',
            'changelog-build' => 'зборка',
            'changelog-index' => 'спic змен',
            'client_verifications-create' => '',
            'forum-topic-watches-index' => '',
            'friends-index' => 'сябры',
            'getDownload' => 'спампаваць',
            'getIcons' => 'іконкі',
            'groups-show' => 'суполкі',
            'index' => 'панэль',
            'legal-show' => 'інфармацыя',
            'messages-index' => 'паведамленні',
            'news-index' => 'навіны',
            'news-show' => 'навіны',
            'password-reset-index' => 'скід паролю',
            'search' => 'пошук',
            'supportTheGame' => 'падтрымаць гульню',
            'team' => 'каманда',
            'testflight' => '',
        ],
        'profile' => [
            '_' => '',
            'friends' => '',
            'settings' => '',
        ],
        'help' => [
            '_' => 'дапамога',
            'getFaq' => 'faq',
            'getRules' => 'правілы',
            'getSupport' => 'ды не ж, мне праўда патрэбна дапамога!',
            'getWiki' => 'вікі',
            'wiki-show' => 'вікі',
        ],
        'beatmaps' => [
            '_' => 'бітмапы',
            'artists' => 'featured artists',
            'beatmap_discussion_posts-index' => 'допісы ў абмеркаваннях бітмап',
            'beatmap_discussions-index' => 'абмеркаванні бітмап',
            'beatmapset_discussion_votes-index' => 'галасы ў абмеркаванні бітмап',
            'beatmapset_events-index' => 'падзеі бітмапы',
            'index' => 'спіс',
            'packs' => 'пакеты',
            'show' => 'звесткі',
        ],
        'beatmapsets' => [
            '_' => 'бітмапы',
            'discussion' => 'абмеркаванне',
        ],
        'rankings' => [
            '_' => 'рэйтынг',
            'index' => 'прадукцыйнасць',
            'performance' => 'прадукцыйнасць',
            'charts' => 'па графіках',
            'score' => 'па ачках',
            'country' => 'па краінах',
            'kudosu' => 'кудосу',
        ],
        'community' => [
            '_' => 'супольнасць',
            'chat' => 'чат',
            'chat-index' => 'чат',
            'dev' => 'распрацоўка',
            'getForum' => 'форумы',
            'getLive' => 'жывыя трансляцыі',
            'comments-index' => 'каментарыі',
            'comments-show' => 'касентарый',
            'contests' => 'конкурсы',
            'profile' => 'профіль',
            'tournaments' => 'турніры',
            'tournaments-index' => 'турніры',
            'tournaments-show' => 'звесткі пра турнір',
            'forum-topics-create' => 'форумы',
            'forum-topics-show' => 'форумы',
            'forum-forums-index' => 'форумы',
            'forum-forums-show' => 'форумы',
        ],
        'multiplayer' => [
            '_' => 'мультыплэер',
            'show' => 'матч',
        ],
        'error' => [
            '_' => 'памылка',
            '404' => 'згублена',
            '403' => 'забаронена',
            '401' => 'вы не ўвайшлі ва ўліковы запіс',
            '405' => 'згублена',
            '500' => 'нешта зламалася',
            '503' => 'абслугоўванне',
        ],
        'user' => [
            '_' => 'карыстальнік',
            'getLogin' => 'увайсці',
            'disabled' => 'адключана',

            'register' => 'зарэгістравацца',
            'reset' => 'аднавіць',
            'new' => 'новы',

            'help' => 'Дапамога',
            'logout' => 'Выйсці',
            'messages' => 'Паведамленні',
            'modding-history-discussions' => 'абмеркаванні',
            'modding-history-events' => 'гісторыя падзей',
            'modding-history-index' => 'актыўнасць бітмапы карыстальніка',
            'modding-history-posts' => 'гісторыя допісаў',
            'modding-history-votesGiven' => 'галасы',
            'modding-history-votesReceived' => 'атрымліныя галасы',
            'notifications-index' => '',
            'oauth_login' => 'уваход для oauth',
            'oauth_request' => 'аўтарызацыя oauth',
            'settings' => 'Налады',
        ],
        'store' => [
            '_' => 'крама',
            'checkout-show' => 'завяршэнне пакупкі',
            'getListing' => 'спіс',
            'cart-show' => 'кошык',

            'getCheckout' => 'завяршэнне пакупкі',
            'getInvoice' => 'рахунак',
            'orders-index' => 'сартаванне гісторыі',
            'products-show' => 'прадукт',

            'new' => 'новы',
            'home' => 'галоўная',
            'index' => 'галоўная',
            'thanks' => 'дзякуем',
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
            '_' => 'Агульнае',
            'home' => 'Галоўная',
            'changelog-index' => 'Спic змен',
            'beatmaps' => 'Спіс бітмап',
            'download' => 'Спампаваць osu!',
            'wiki' => 'Вікі',
        ],
        'help' => [
            '_' => 'Дапамога і супольнасць',
            'faq' => 'Частыя пытанні',
            'forum' => 'Супольнасць форумаў',
            'livestreams' => 'Жывыя трансляцыі',
            'report' => 'Паведаміць пра праблему',
        ],
        'legal' => [
            '_' => 'Правы і статус',
            'copyright' => 'Аўтарскія правы (DMCA)',
            'privacy' => 'Прыватнасць',
            'server_status' => 'Стан сервераў',
            'source_code' => 'Зыходны код',
            'terms' => 'Умовы выкарыстання',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Старонка не знойдзена',
            'description' => "Прабачце, але старонкі, якую вы запыталі няма тут!",
        ],
        '403' => [
            'error' => "Вы не мусіце быць тут.",
            'description' => 'Хаця вы можаце паспрабаваць вярнуцца назад.',
        ],
        '401' => [
            'error' => "Вам не варта знаходзіцца тут.",
            'description' => 'Хаця вы можаце паспрабавацьвярнуцца назад. Ці можа ўвайсці.',
        ],
        '405' => [
            'error' => 'Старонка не знойдзена',
            'description' => "Прабачце, але старонкі, якую вы запыталі няма тут!",
        ],
        '500' => [
            'error' => 'Як жа так! Нешта зламалася! ;_;',
            'description' => "Мы аўтаматычна апавяшчаемся аб усіх памылках.",
        ],
        'fatal' => [
            'error' => 'Як жа так! Нешта зламалася (які жах)! ;_;',
            'description' => "Мы аўтаматычна апавяшчаемся аб усіх памылках.",
        ],
        '503' => [
            'error' => 'Закрыты на абслугоўванне!',
            'description' => "Абслугоўванне звычайна займае ад 5 секунд да 10 хвілін. Калі яно зацягваецца, звярніцеся да :link для атрымання дадатковай інфармацыі.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "На ўсялякі выпадак, вось код, які вы можаце паведаміць падтрымке!",
    ],

    'popup_login' => [
        'login' => [
            'forgot' => "Не помню свае даныя",
            'password' => 'пароль',
            'title' => 'Увайдзіце, каб працягнуць',
            'username' => '',

            'error' => [
                'email' => "Імя карыстальніка або эл. пошта не існуе",
                'password' => 'Няправільны пароль',
            ],
        ],

        'register' => [
            'download' => '',
            'info' => 'Спадар, вам патрэбны ўліковы запіс. Чаму вы ўсё яшчэ не маеце яго?',
            'title' => "Не маеце ўліковага запісу?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Налады',
            'friends' => 'Сябры',
            'logout' => 'Выйсці',
            'profile' => 'Мой профіль',
        ],
    ],

    'popup_search' => [
        'initial' => 'Пішыце, каб знайсці!',
        'retry' => 'Не атрымалася знайсці. Націсніце, каб паспрабаваць яшчэ раз.',
    ],
];
