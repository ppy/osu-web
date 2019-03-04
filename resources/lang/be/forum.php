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
    'pinned_topics' => 'Замацаваныя тэмы',
    'slogan' => "небяспечна гуляць аднаму.",
    'subforums' => 'Падфорум',
    'title' => 'osu! Форум',

    'covers' => [
        'create' => [
            '_' => 'Усталяваць фонавы відарыс',
            'button' => 'Запампаваць выяву',
            'info' => 'Памер фону павінен быць :dimensions. Вы таксама можаце перацягнуць вашу выяву сюды для запампоўкі.',
        ],

        'destroy' => [
            '_' => 'Выдаліць фонавую выяву',
            'confirm' => 'Вы ўпэўнены, што хочаце выдаліць гэтую фонавую выяву?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Новы адказ у тэме «:title»',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Няма тэм!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Пазначыць форум як прачытаны',
        'forums' => 'Пазначыць форумы як прачытаныя',
        'busy' => 'Пазначыць як прачытанае...',
    ],

    'poll' => [
        'edit_warning' => 'Рэдагаванне апытання выдаліць бягучыя вынікі!',

        'actions' => [
            'edit' => 'Рэдагаваць апытанне',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Выдаліць допіс?',
        'confirm_restore' => 'Аднавіць допіс?',
        'edited' => 'Апошняе рэдагаванне :user а :when, адрэдагавана :count раз.',
        'posted_at' => 'апублікаваны :when',

        'actions' => [
            'destroy' => 'Выдаліць допіс',
            'restore' => 'Аднавіць допіс',
            'edit' => 'Рэдагаваць допіс',
        ],

        'info' => [
            'post_count' => '',
        ],
    ],

    'search' => [
        'go_to_post' => 'Перайсці да допісу',
        'post_number_input' => 'увядзіце нумар допісу',
        'total_posts' => 'усяго :posts_count допісаў',
    ],

    'topic' => [
        'deleted' => 'выдаленая тэма',
        'go_to_latest' => 'праглядзець апошні допіс',
        'latest_post' => ':when ад :user',
        'latest_reply_by' => 'апошні адказ ад :user',
        'new_topic' => 'Новая тэма',
        'new_topic_login' => 'Увайдзіце, каб апублікаваць новую тэму',
        'post_reply' => 'Размясціць',
        'reply_box_placeholder' => 'Пішыце тут',
        'reply_title_prefix' => 'Адказ',
        'started_by' => 'ад :user',
        'started_by_verbose' => 'пачата :user',

        'create' => [
            'preview' => 'Перадпрагляд',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Запісаць',
            'submit' => 'Размясціць',

            'necropost' => [
                'default' => 'Гэтая тэма была неактыўна нейкі час. Размяшчайце ў ёй допісы, толькі пры неабходнасці.',

                'new_topic' => [
                    '_' => "Гэтая тэма была неактыўна нейкі час. Калі вы не маеце прычын для размяшчэння ў ёй допісаў, калі ласка :create.",
                    'create' => 'стварыць новую тэму',
                ],
            ],

            'placeholder' => [
                'body' => 'Пішыце змесціва допісу тут',
                'title' => 'Загаловак тэмы',
            ],
        ],

        'jump' => [
            'enter' => 'націсніце тут, каб перайсці да асаблівага допісу',
            'first' => 'перайсці да першага допісу',
            'last' => 'перайсці да апошняга допісу',
            'next' => 'прапусціць наступныя 10 допісаў',
            'previous' => 'вярнуцца на папярэднія 10 допісаў',
        ],

        'post_edit' => [
            'cancel' => 'Скасаваць',
            'post' => 'Захаваць',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Форум падпіскі',
            'title_compact' => 'форум падпіскі',
            'title_main' => 'Форум <strong>падпіскі</strong>',

            'box' => [
                'total' => 'Падпіскі на тэмы',
                'unread' => 'Новы адказы ў тэмах',
            ],

            'info' => [
                'total' => 'Вы падпісаны на :total тэм.',
                'unread' => 'У вас :unread непрачытаных адказаў у тэмах, на якіх вы падпісаны.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Адпісацца ад тэмы?',
                'title' => 'Адпісацца',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Тэмы',

        'actions' => [
            'login_reply' => 'Увайсці, каб адказаць',
            'reply' => 'Адказаць',
            'reply_with_quote' => 'Адказ з цытаваным допісам',
            'search' => 'Пошук',
        ],

        'create' => [
            'create_poll' => 'Стварэння апытання',

            'preview' => '',

            'create_poll_button' => [
                'add' => 'Стварыць апытанне',
                'remove' => 'Скасаваць стварэнне апытання',
            ],

            'poll' => [
                'length' => 'Абмежаваць апытанне па часу на',
                'length_days_suffix' => 'дзён',
                'length_info' => 'Пакінуць пустым, каб не абмяжоўваць апытанне часам',
                'max_options' => 'Параметры на карыстальніка',
                'max_options_info' => 'Гэта колькасць параметраў, якія карыстальнік можа выбраць падчас галасавання.',
                'options' => 'Параметры',
                'options_info' => 'Кожны параметр на новай лініі. Вы можаце ўвесці да 10 параметраў.',
                'title' => 'Пытанне',
                'vote_change' => 'Дазволіць паўторнае галасаванне.',
                'vote_change_info' => 'Калі ўключана, карыстальнікі могуць змяніць свае галасы.',
            ],
        ],

        'edit_title' => [
            'start' => 'Рэдагаваць назву',
        ],

        'index' => [
            'feature_votes' => '',
            'replies' => 'адказаў',
            'views' => 'праглядаў',
        ],

        'issue_tag_added' => [
            'to_0' => 'Выдаліць тэг «дадана»',
            'to_0_done' => 'Тэг «дадана» выдалены',
            'to_1' => 'Дадаць тэг «дадана»',
            'to_1_done' => 'Тэг «дадана» даданы',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Выдаліць тэг «прысвоена»',
            'to_0_done' => 'Тэг «прысвоена» выдалены',
            'to_1' => 'Дадаць тэг «прысвоена»',
            'to_1_done' => 'Тэг «прысвоена» даданы',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Выдаліць тэг «пацверджана»',
            'to_0_done' => 'Тэг «пацверджана» выдалены',
            'to_1' => 'Дадаць тэг «пацверджана»',
            'to_1_done' => 'Тэг «пацверджана» даданы',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Выдаліць тэг «дублікат»',
            'to_0_done' => 'Тэг «дублікат» выдалены',
            'to_1' => 'Дадаць тэг «дублікат»',
            'to_1_done' => 'Тэг «дублікат» даданы',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Выдаліць тэг «нядзейна»',
            'to_0_done' => 'Выдаліць тэг «нядзейна»',
            'to_1' => 'Дадаць тэг «нядзейна»',
            'to_1_done' => 'Дабаўлены тэг "нядзейна"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Выдаліць тэг «вырашана»',
            'to_0_done' => 'Тэг «вырашана» выдалены',
            'to_1' => 'Дадаць тэг «вырашана»',
            'to_1_done' => 'Тэг «вырашана» даданы',
        ],

        'lock' => [
            'is_locked' => 'Гэтая тэма заблакаваная і адказваць у ёй немагчыма',
            'to_0' => 'Адкрыць тэму',
            'to_0_done' => 'Тэма была адкрыта',
            'to_1' => 'Закрыць тэму',
            'to_1_done' => 'Тэма была закрыта',
        ],

        'moderate_move' => [
            'title' => 'Перамясціць у іншы форум',
        ],

        'moderate_pin' => [
            'to_0' => 'Адмацаваць тэму',
            'to_0_done' => 'Тэма была адмацавана',
            'to_1' => 'Замацаваць тэму',
            'to_1_done' => 'Тэма была замацавана',
            'to_2' => 'Замацаваць тэму і пазначыць як апавяшчэнне',
            'to_2_done' => 'Тэма была замацавана і пазначана як абвяшчэння',
        ],

        'show' => [
            'deleted-posts' => 'Выдалена допісаў',
            'total_posts' => 'Агульна допісаў',

            'feature_vote' => [
                'current' => 'Бягучы прыярытэт: +:count',
                'do' => 'Прасунуць гэты запыт',

                'info' => [
                    '_' => '',
                    'feature_request' => '',
                    'supporters' => '',
                ],

                'user' => [
                    'count' => ':count голас|:count галасы|:count галасоў',
                    'current' => 'У вас засталося :votes галасоў.',
                    'not_enough' => "Вы не маеце больш даступных галасоў",
                ],
            ],

            'poll' => [
                'vote' => 'Галасаваць',

                'detail' => [
                    'end_time' => 'Апытанне скончыцца :time',
                    'ended' => 'Апытанне скончана :time',
                    'total' => 'Усяго галасоў: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Няма ў закладках',
            'to_watching' => 'Закладка',
            'to_watching_mail' => 'Закладна ў апавяшчэннях',
            'tooltip_mail_disable' => 'Апавяшчэнні ўключаны. Націсніце, каб адключыць',
            'tooltip_mail_enable' => 'Апавяшчэнні адключаны. Націсніце, каб уключыць',
        ],
    ],
];
