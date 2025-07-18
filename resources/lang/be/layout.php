<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Прайграйце наступны трэк аўтаматычна',
    ],

    'defaults' => [
        'page_description' => 'osu! - Рытм у адным *націсканні* ад вас! Гульня з Ouendan/EBA, Taiko і арыгінальнымі гульнявымі рэжымамі, а таксама з поўным вартасным рэдактарам бітмап.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'калекцыя бітмапаў',
            'beatmapset_covers' => 'вокладкі калекцый бітмапаў',
            'contest' => 'конкурс',
            'contests' => 'конкурсы',
            'root' => 'кансоль',
        ],

        'artists' => [
            'index' => 'спіс',
        ],

        'beatmapsets' => [
            'show' => 'інфармацыя',
            'discussions' => 'абмеркаванне',
        ],

        'changelog' => [
            'index' => 'спіс',
        ],

        'help' => [
            'index' => 'індэкс',
            'sitemap' => 'Карта сайта',
        ],

        'store' => [
            'cart' => 'кошык',
            'orders' => 'гісторыя замоў',
            'products' => 'прадукты',
        ],

        'tournaments' => [
            'index' => 'спіс',
        ],

        'users' => [
            'modding' => 'модынг',
            'playlists' => 'плэйлісты',
            'realtime' => 'мультыплэер',
            'show' => 'інфармацыя',
        ],
    ],

    'gallery' => [
        'close' => 'Зачыніць (Esc)',
        'fullscreen' => 'Пераключыць поўнаэкранны рэжым',
        'zoom' => 'Павялічыць / паменшыць',
        'previous' => 'Папярэдні (стрэлка налева)',
        'next' => 'Наступны (стрэлка направа)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'бітмапы',
        ],
        'community' => [
            '_' => 'супольнасць',
            'dev' => 'распрацоўка',
        ],
        'help' => [
            '_' => 'дапамога',
            'getAbuse' => 'паведаміць пра парушэнне',
            'getFaq' => 'faq',
            'getRules' => 'правілы',
            'getSupport' => 'ды не ж, мне праўда патрэбна дапамога!',
        ],
        'home' => [
            '_' => 'галоўная',
            'team' => 'каманда',
        ],
        'rankings' => [
            '_' => 'рэйтынг',
        ],
        'store' => [
            '_' => 'крама',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Агульнае',
            'home' => 'Галоўная',
            'changelog-index' => 'Гісторыя змен',
            'beatmaps' => 'Спіс бітмап',
            'download' => 'Спампаваць osu!',
        ],
        'help' => [
            '_' => 'Дапамога і супольнасць',
            'faq' => 'Частыя пытанні',
            'forum' => 'Супольнасць форумаў',
            'livestreams' => 'Жывыя трансляцыі',
            'report' => 'Паведаміць пра праблему',
            'wiki' => 'Вікі',
        ],
        'legal' => [
            '_' => 'Правы і статус',
            'copyright' => 'Аўтарскія правы (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Прыватнасць',
            'rules' => '',
            'server_status' => 'Стан сервераў',
            'source_code' => 'Зыходны код',
            'terms' => 'Умовы выкарыстання',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Няправільны параметр запыту',
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
            'error' => 'Няправільны параметр запыту',
            'description' => '',
        ],
        '429' => [
            'error' => 'Перавышаны ліміт запытаў',
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
        'button' => 'увайсці / зарэгістравацца',

        'login' => [
            'forgot' => "Не помню свае даныя",
            'password' => 'пароль',
            'title' => 'Увайдзіце, каб працягнуць',
            'username' => 'імя карыстальніка',

            'error' => [
                'email' => "Імя карыстальніка або эл. пошта не існуе",
                'password' => 'Няправільны пароль',
            ],
        ],

        'register' => [
            'download' => 'Спампаваць',
            'info' => 'Скачай osu!, каб зарэгістраваць акаўнт!',
            'title' => "Не маеш акаўнту?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Налады',
            'follows' => 'Падпіскі',
            'friends' => 'Сябры',
            'legacy_score_only_toggle' => 'Рэжым Lazer',
            'legacy_score_only_toggle_tooltip' => 'Рэжым адлюстравання, які паказвае рэкорды, пастаўленыя ў кліенце lazer з новым алгарытмам падліку ачкоў',
            'logout' => 'Выйсці',
            'profile' => 'Мой профіль',
            'scoring_mode_toggle' => 'Класічны выгляд ачкоў',
            'scoring_mode_toggle_tooltip' => 'Набліжана вяртае гульнявыя ачкі да класічнага неабмежаванаму алгарытме падліку',
            'team' => 'Мая каманда',
        ],
    ],

    'popup_search' => [
        'initial' => 'Пішыце, каб знайсці!',
        'retry' => 'Не атрымалася знайсці. Націсніце, каб паспрабаваць яшчэ раз.',
    ],
];
