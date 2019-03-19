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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Падабаецца osu!?<br/>
                                Патрымайце распрацоўку osu! :D',
            'small_description' => '',
            'support_button' => 'Я хачу падтрымаць osu!',
        ],

        'dev_quote' => 'osu! — цалкам бясплатная гульня, але яе падтрымка — зусім не бясплатная.
        Не кажучы пра кошт арэнды сервераў і высокую якасць паласы прапускання па ўсяму свету, час, затрачаны на сістэму і супольнасць,
        выдаванне падарункаў за конкурсы, адказамі на пытанні ў тэх. падтрымцы і простая падтрымка настрою гульцоў, osu! патрабуе пэўную суму грошай!
        А, яшчэ не забываецеся на той факт, што ўсё гэта мы робім без рэкламы і прасоўвання бескарысных панэляў інструментаў і таму падобнага!
            <br/><br/>Насамрэч, osu! кардынуецца мной, больш вядомым як «peppy».
            Мне давялося звольніцца са сваёй асноўнай працы, каб падтрымліваць osu!,
            і, часам, намагацца са ўсіх сіл, каб прытрымлівацца жаданых стандартаў.
            Хацелася б асабліва падзякаваць усім, хто падтрымлівае osu! па гэты дзень,
            а таксама ўсім, хто будзе падтрымліваць гэту цудоўную гульню і яе супольнасць у будучыні :).',

        'supporter_status' => [
            'contribution' => 'Дзякуем за вашу падтрымку спасибо! Усяго вы ахвяравалі :dollars за :tags пакупак!',
            'gifted' => 'З іх, вы падаравалі :giftedTags тэгаў (агулам падорана :giftedDollars), як шчодра!',
            'not_yet' => "Вы яшчэ не маеце тэг osu!supporter :(",
            'title' => 'Бягучы стан osu!supporter',
            'valid_until' => 'Ваш бягучы тэг osu!supporter дзейнічае да :date!',
            'was_valid_until' => 'Ваш тэг osu!supporter дзейнічаў да :date.',
        ],

        'why_support' => [
            'title' => 'Чаму мне варта падтрымліваць osu!?',
            'blocks' => [
                'dev' => 'Распрацоўваецца і падтрымліваецца ў асноўным адных хлопцам з Аўстраліі',
                'time' => 'Займае настолькі шмат часу, што ўжо нельга назваць «улюбёным заняткам».',
                'ads' => 'Цялкам без рэкламы.<br/><br/>
                        У адрозненне ад 99.95% сайтаў, мы не маем даходу ад паказу рэкламы прама вам у твар.',
                'goodies' => 'Вы атрымалі дадатковыя пажыткі!',
            ],
        ],

        'perks' => [
            'title' => 'Оў, і што ж я атрымаю?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'хуткі і просты доступ да пошуку і спампоўкі бітмап, непакідая гульні.',
            ],

            'auto_downloads' => [
                'title' => 'Аўтаспампоўка',
                'description' => 'Аўтаматычная спампоўка бітмап падчас шматкарыстальніцкай гульні, назірання за іншымі гульцамі або націскання спасылак у чаце!',
            ],

            'upload_more' => [
                'title' => 'Загрузіць больш',
                'description' => 'Дадатковыя слоты для бітмап, якія чакаюць ранкінга (да 10).',
            ],

            'early_access' => [
                'title' => 'Ранні доступ',
                'description' => 'Доступ да ранніх выпускаў гульні, дзе вы можаце пратэсціраваць новыя функцыі перш, чым яны з\'явяцца публічна!',
            ],

            'customisation' => [
                'title' => 'Індывідуальнасць',
                'description' => 'Дапасуйце свой профіль, дадаўшы цалкам дапасавальную старонку карыстальніка.',
            ],

            'beatmap_filters' => [
                'title' => 'Фільтр бітмап',
                'description' => 'Фільтр бітмап шукае па мапах, на якіх гулялі або не гулялі. А таксама па атрыманых у іх рэйтынгах.',
            ],

            'yellow_fellow' => [
                'title' => 'Залатая мянушка',
                'description' => 'Будзьце пазнавальнымі ў гульні з новай ярка жоўтай мянушкай у чаце.',
            ],

            'speedy_downloads' => [
                'title' => 'Хуткія спампоўкі',
                'description' => 'Менш абмежаванняў для спампоўкі бітмап, асабліва праз osu!direct.',
            ],

            'change_username' => [
                'title' => 'Змяніць імя карыстальніка',
                'description' => 'Магчымасць змяніць імя карыстальніка без дадатковай аплаты. (толькі адзін раз)',
            ],

            'skinnables' => [
                'title' => 'Дапасаванне',
                'description' => 'Дадатковае дастасаванне ў гульні, кшталту зменнага фону меню.',
            ],

            'feature_votes' => [
                'title' => 'Галасаванне за новыя функцыі',
                'description' => 'Галасаванне за новыя функцыі. (2 голаса ў месяц)',
            ],

            'sort_options' => [
                'title' => 'Параметры сартавання',
                'description' => 'Магчымасць прагляду рэйтынгу бітмапы паміж краінамі / сябрамі / модамі ў гульні.',
            ],

            'feel_special' => [
                'title' => 'Асаблівыя пачуцці',
                'description' => 'Пяшчотнае пачуццё ад таго, што дапамаглі osu!',
            ],

            'more_to_come' => [
                'title' => 'І многае іншае',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Цудоўна! :D',
            'support' => 'падтрымаць osu!',
            'gift' => 'або падараваць падтрымку іншаму гульцу',
            'instructions' => 'націсніце па кнопкі з сэрцам, каб перайсці да osu!store',
        ],
    ],
];
