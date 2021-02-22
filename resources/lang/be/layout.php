<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => '',
    ],

    'defaults' => [
        'page_description' => 'osu! - Рытм у адным *націсканні* ад вас! Гульня з Ouendan/EBA, Taiko і арыгінальнымі гульнявымі рэжымамі, а таксама з поўным вартасным рэдактарам бітмап.',
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
            '_' => 'бітмапы',
            'artists' => 'featured artists',
            'index' => 'спіс',
            'packs' => 'пакеты',
        ],
        'community' => [
            '_' => 'супольнасць',
            'chat' => 'чат',
            'contests' => 'конкурсы',
            'dev' => 'распрацоўка',
            'forum-forums-index' => 'форумы',
            'getLive' => 'жывыя трансляцыі',
            'tournaments' => 'турніры',
        ],
        'help' => [
            '_' => 'дапамога',
            'getAbuse' => '',
            'getFaq' => 'faq',
            'getRules' => 'правілы',
            'getSupport' => 'ды не ж, мне праўда патрэбна дапамога!',
            'getWiki' => 'вікі',
        ],
        'home' => [
            '_' => 'галоўная',
            'changelog-index' => 'спic змен',
            'getDownload' => 'спампаваць',
            'news-index' => 'навіны',
            'search' => 'пошук',
            'team' => 'каманда',
        ],
        'rankings' => [
            '_' => 'рэйтынг',
            'charts' => 'па графіках',
            'country' => 'па краінах',
            'index' => 'прадукцыйнасць',
            'kudosu' => 'кудосу',
            'multiplayer' => '',
            'score' => 'па ачках',
        ],
        'store' => [
            '_' => 'крама',
            'cart-show' => 'кошык',
            'getListing' => 'спіс',
            'orders-index' => 'сартаванне гісторыі',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Агульнае',
            'home' => 'Галоўная',
            'changelog-index' => 'Спic змен',
            'beatmaps' => 'Спіс бітмап',
            'download' => 'Спампаваць osu!',
        ],
        'help' => [
            '_' => 'Дапамога і супольнасць',
            'faq' => 'Частыя пытанні',
            'forum' => 'Супольнасць форумаў',
            'livestreams' => 'Жывыя трансляцыі',
            'report' => 'Паведаміць пра праблему',
            'wiki' => '',
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
        '400' => [
            'error' => '',
            'description' => '',
        ],
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
        '422' => [
            'error' => '',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
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
        'button' => '',

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
            'follows' => '',
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
