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
    'deleted' => '[выдалены карыстальнік]',

    'beatmapset_activities' => [
        'title' => "Гісторыя рэдагавання бітмап карыстальніка :user",
        'title_compact' => 'Мадаванне',

        'discussions' => [
            'title_recent' => 'Нядаўна пачатыя абмеркаванні',
        ],

        'events' => [
            'title_recent' => 'Апошнія падзеі',
        ],

        'posts' => [
            'title_recent' => 'Нядаўнія допісы',
        ],

        'votes_received' => [
            'title_most' => 'Самыя папулярныя ад (за 3 месяцы)',
        ],

        'votes_made' => [
            'title_most' => 'Самыя папулярныя (за 3 месяцы)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Вы заблакавалі гэтага карыстальніка.',
        'blocked_count' => 'заблакаваныя карыстальнікі (:count)',
        'hide_profile' => 'схаваць профіль',
        'not_blocked' => 'Гэты карыстальнік не заблакаваны.',
        'show_profile' => 'паказаць профіль',
        'too_many' => 'Дасягнуты ліміт блакавання.',
        'button' => [
            'block' => 'заблакаваць',
            'unblock' => 'адблакаваць',
        ],
    ],

    'card' => [
        'loading' => 'Загрузка...',
        'send_message' => 'адправіць паведамленне',
    ],

    'login' => [
        '_' => 'Увайсці',
        'locked_ip' => 'ваш IP-адрас заблакаваны. Пачакайце некалькі хвілін.',
        'username' => 'Імя карыстальніка',
        'password' => 'Пароль',
        'button' => 'Увайсці',
        'button_posting' => 'Уваход...',
        'remember' => 'Запомніць гэта камп\'ютар',
        'title' => 'Каб працягнуць, увайдзіце',
        'failed' => 'Няправільны ўваход',
        'register' => "Вы яшчэ не маеце ўліковага запісу osu!? Стварыце новы",
        'forgot' => 'Забылі свой пароль?',
        'beta' => [
            'main' => 'Доступ да бэта-версіі абмежаваны.',
            'small' => '(osu!supporters хутка атрымаць доступ)',
        ],

        'here' => 'тут', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'допісаў :username',
    ],

    'signup' => [
        '_' => 'Рэгістрацыя',
    ],
    'anonymous' => [
        'login_link' => 'націсніце, каб увайсці',
        'login_text' => 'увайсці',
        'username' => 'Госць',
        'error' => 'Каб зрабіць гэта, вам трэба ўвайсці.',
    ],
    'logout_confirm' => 'Вы ўпэўнены, што хочаце выйсці? :(',
    'report' => [
        'button_text' => 'справаздача',
        'comments' => 'Дадатковыя каментарыі',
        'placeholder' => 'Калі ласка, паведаміце любую інфармацыю, якую лічаце карыснай.',
        'reason' => 'Прычына',
        'thanks' => 'Дзякуем за ваш даклад!',
        'title' => 'Паскардзіцца на :username?',

        'actions' => [
            'send' => 'Адправіць скаргу',
            'cancel' => 'Скасаваць',
        ],

        'options' => [
            'cheating' => 'Несумленная гульня / Чыты',
            'insults' => 'Абраза мяне / іншых',
            'spam' => 'Спам',
            'unwanted_content' => 'Неадпаведна звязанае змесціва',
            'nonsense' => 'Лухта',
            'other' => 'Іншы (пішыце ніжэй)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Ваш уліковы запіс быў абмежаваны!',
        'message' => 'Падчас абмежавання, вы не можаце ўзаемадзейнічаць з іншымі гульцамі, а вашы вынікі будуць бачны толькі вам. Звычайна гэта вынік аўтаматычнага працэсу, які зазвычай знікае праз суткі. Калі вы хочаце скасаваць сваё абмежаванне, калі ласка <a href="mailto:accounts@ppy.sh">звяжыцеся з намі</a>.',
    ],
    'show' => [
        'age' => ':age год',
        'change_avatar' => 'змяніць аватар!',
        'first_members' => 'Тут з самага пачатку',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Далучыўся :date',
        'lastvisit' => 'Быў у сетцы :date',
        'missingtext' => 'Магчыма, вы памыліліся! (або карыстальнік заблакаваны)',
        'origin_country' => 'Адкуль: :country',
        'page_description' => 'osu! - Усё, што вы хацелі ведаць пра :username!',
        'previous_usernames' => 'таксама вядомы як',
        'plays_with' => 'Гуляе з :devices',
        'title' => "Профіль :username",

        'edit' => [
            'cover' => [
                'button' => 'Змяніць фон профілю',
                'defaults_info' => 'Больш параметраў фону будуць доступны ў будучыні',
                'upload' => [
                    'broken_file' => 'Не атрымалася апрацаваць выяву. Паспрабуйце яшчэ раз.',
                    'button' => 'Запампаваць выяву',
                    'dropzone' => 'Перацягніце сюды, каб запампаваць',
                    'dropzone_info' => 'Вы таксама можаце перацягнуць сюды, каб запампаваць',
                    'restriction_info' => "Запампоўка даступна толькі для <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'Памер фону павінен быць 2800x620',
                    'too_large' => 'Запампаваны файл надта вялікі.',
                    'unsupported_format' => 'Фармат не падтрымліваецца.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'прадвызначаны рэжым гульні',
                'set' => 'усталяваць :mode як прадвызначаны рэжым гульні',
            ],
        ],

        'extra' => [
            'followers' => ':count падпісчык|:count падпісчыкі|:count падпісчыкаў',
            'unranked' => 'Няма нядаўніх гульняў',

            'achievements' => [
                'achieved-on' => 'Атрымана :date',
                'locked' => 'Заблакавана',
                'title' => 'Дасягненні',
            ],
            'beatmaps' => [
                'by_artist' => 'ад :artist',
                'none' => 'Няма... пакуль што.',
                'title' => 'Бітмапы',

                'favourite' => [
                    'title' => 'Абраныя бітмапы',
                ],
                'graveyard' => [
                    'title' => 'Закінутыя бітмапы',
                ],
                'loved' => [
                    'title' => 'Любімыя бітмапы',
                ],
                'ranked_and_approved' => [
                    'title' => 'Рэйтынгавыя і ўсхваліныя бітмапы',
                ],
                'unranked' => [
                    'title' => 'Чаканыя бітмапы',
                ],
            ],
            'historical' => [
                'empty' => 'Няма прадукцыйных спісаў. :(',
                'title' => 'Храналогія',

                'monthly_playcounts' => [
                    'title' => 'Гульнявая гісторыя',
                    'count_label' => 'Гульняў',
                ],
                'most_played' => [
                    'count' => 'згуляна раз',
                    'title' => 'Найбольш згуляныя бітмапы',
                ],
                'recent_plays' => [
                    'accuracy' => 'дакладнасць: :percentage',
                    'title' => 'Нядаўнія гальні (24гадз)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Гісторыя праглядаў паўтораў',
                    'count_label' => 'Паўтораў прагледжана',
                ],
            ],
            'kudosu' => [
                'available' => 'Кудосу даступна',
                'available_info' => "Кудосу могуць быць выкарыстаны для абмену паміж іншымі ўладальнікамі бітмап, якія могуць дапамагчы вам прыцягнуць да вашай бітмапы больш увагі. Гэта колькасць кудосу, якую вы не выкарыстоўвалі.",
                'recent_entries' => 'Нядаўняя гісторыя кудосу',
                'title' => 'Кудосу!',
                'total' => 'Агулам зароблена кудосу',
                'total_info' => 'Абапіраючыся на тое, як шмат было зроблена выпраўленняў бітмапы карыстальнікам падчас мадэрацыі. Паглядзіце <a href="'.osu_url('user.kudosu').'">старонку</a>, каб даведацца больш.',

                'entry' => [
                    'amount' => ':amount кудосу',
                    'empty' => "Гэты карыстальнік наогул не атрымліваў кудосу!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Атрымана :amount за адказ у :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Пазбаўлена :amount за адказ у :post',
                        ],

                        'delete' => [
                            'reset' => 'Страчана :amount за выдаленне адказа ў допісе :post',
                        ],

                        'restore' => [
                            'give' => 'Атрымана :amount за аднаўленне адказа ў допісе :post',
                        ],

                        'vote' => [
                            'give' => 'Атрымана :amount за атрыманне галасоў у допісе :post',
                            'reset' => 'Страчана :amount за страчэнне галасоў у допісе :post',
                        ],

                        'recalculate' => [
                            'give' => 'Атрымана :amount за пералік галасоў у допісе :post',
                            'reset' => 'Страчана :amount за пералік галасоў у допісе :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':giver даў :amount за адказ у допісе :post',
                        'reset' => ':giver скінуў кудосу за адказ у допісе :post',
                        'revoke' => ':giver забраў кудосу за адказ у допісе :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'я!',
            ],
            'medals' => [
                'empty' => "Гэты карыстальнік яшчэ нічога не атрымаў. ;_;",
                'recent' => 'Апошнія',
                'title' => 'Медалі',
            ],
            'recent_activity' => [
                'title' => 'Нядаўняя актыўнасць',
            ],
            'top_ranks' => [
                'download_replay' => 'Спампаваць паўтор',
                'empty' => 'Яшчэ няма запісаў пра цудоўную прадукцыйнасць. :(',
                'not_ranked' => 'Адзінкі прадукцыйнасці даюцца толькі бітмапам, якія набылі ранг.',
                'pp_weight' => 'узважана :percentage',
                'title' => 'Рэйтынгі',

                'best' => [
                    'title' => 'Найлепшая прадукцыйнасць',
                ],
                'first' => [
                    'title' => 'Першыя месцы ў рэйтынгу',
                ],
            ],
            'account_standing' => [
                'title' => 'Стан уліковага запісу',
                'bad_standing' => "уліковы запіс <strong>:username</strong> не ў найлепшым стане :(",
                'remaining_silence' => 'карыстальнік <strong>:username</strong> зможа зноў гаварыць праз :duration.',

                'recent_infringements' => [
                    'title' => 'Нядаўнія парушэнні',
                    'date' => 'дата',
                    'action' => 'дзея',
                    'length' => 'працягласць',
                    'length_permanent' => 'Назаўсёды',
                    'description' => 'апісанне',
                    'actor' => ':username',

                    'actions' => [
                        'restriction' => 'Заблакіраваць',
                        'silence' => 'Зацішаны',
                        'note' => 'Нататка',
                    ],
                ],
            ],
        ],

        'header_title' => [
            '_' => 'Гулец :info',
            'info' => 'Інфармацыя',
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Цікаўнасці',
            'lastfm' => 'Last.fm',
            'location' => 'Бягучае месцазнаходжанне',
            'occupation' => 'Занятак',
            'skype' => '',
            'twitter' => '',
            'website' => 'Вэб-сайт',
        ],
        'not_found' => [
            'reason_1' => 'Вы маглі змяніць сваё імя карыстальніка.',
            'reason_2' => 'Уліковы запіс можа быць часова недаступны з-за скарг або праблем бяспечнасці.',
            'reason_3' => 'Магчыма, вы памыліліся!',
            'reason_header' => 'Ёсць некалькі магчымых прычын:',
            'title' => 'Карыстальнік не знойдзены! ;_;',
        ],
        'page' => [
            'button' => '',
            'description' => '<strong>я!</strong> гэта ваша ўласнае месца ў профілю, якое можна дастасаваць.',
            'edit_big' => 'Рэдагаваць мяне!',
            'placeholder' => 'Напішыце змесціва старонкі тут',
            'restriction_info' => "Вам трэба мець <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a>, каб разблакаваыь гэтую функцыю.",
        ],
        'post_count' => [
            '_' => 'Размясціў :link',
            'count' => ':count допіс|:count допісы|:count допісаў',
        ],
        'rank' => [
            'country' => 'Рэйтынг краін для :mode',
            'country_simple' => 'Рэйтынг краін',
            'global' => 'Глабальны рэйтынг для :mode',
            'global_simple' => 'Глабальны рэйтынг',
        ],
        'stats' => [
            'hit_accuracy' => 'Дакладнасць трапленняў',
            'level' => 'Узровень :level',
            'level_progress' => 'Прагрэс да новага ўзроўню',
            'maximum_combo' => 'Максімальнае комба',
            'medals' => 'Медалі',
            'play_count' => 'Колькасць гульняў',
            'play_time' => 'Агульны час гульні',
            'ranked_score' => 'Рэйтынгавыя ачкі',
            'replays_watched_by_others' => 'Праглядаў паўтораў іншымі',
            'score_ranks' => 'Рэйтынг па ачках',
            'total_hits' => 'Усяго патрапленняў',
            'total_score' => 'Усяго ачкоў',
        ],
    ],
    'status' => [
        'online' => 'У сетцы',
        'offline' => 'Не ў сетцы',
    ],
    'store' => [
        'saved' => 'Карыстальнік створаны',
    ],
    'verify' => [
        'title' => 'Пацверджанне ўліковага запісу',
    ],
];
